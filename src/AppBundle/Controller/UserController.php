<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\User\EditForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/user", name="user")
     */
    public function userAction(Request $request)
    {

        $form = $this->createForm(CreateForm::class, null, [
            'action' => $this->generateUrl('user')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            return $this->render('@App/User/edit.html.twig',
                ['firstName' => $formData['name'], 'editForm' => $form->createView()]);
        }

        return $this->render('@App/User/edit.html.twig', ['editForm' => $form->createView()]);
        
    }


    /**
     * @Route("/new", name="new")
     */
    public function newAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setName('Petar');
        $user->setLastname('Petrovic');       
        $datum = new \DateTime();
        $user->setDatum($datum);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new User with id ' . $user->getId());
    }


    /**
     * @Route("/formatd", name="formatd")
     */
    public function formatdAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setName('Ana');
        $user->setLastname('Anic');       

        $datetime = new \DateTime();
        $newDate = $datetime->createFromFormat('d/m/Y', '01/01/2001');
        $user->setDatum($newDate);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new User with id ' . $user->getId());
        
    }


    /**
     * akcija kojom cemo upisiviti Usera u bazu
     *
     * @Route("/update", name="update")
     */
    public function updateAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(CreateForm::class, null, [
            'action' => $this->generateUrl('update')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $user->setName($formData['name']);
            $user->setLastName($formData['lastname']);           
            $user->setDatum($formData['datum']);

            $entityManager->persist($user);
            $entityManager->flush();

            return new Response('Saved new User with id ' . $user->getId());

        }

        return $this->render('@App/User/edit.html.twig', ['editForm' => $form->createView()]);
        
    }


    /**
     * @Route("/create", name="app_user_create")
     */
    public function createAction(Request $request)           // akcija kojom cemo upisiviti Usera u bazu ( drugi nacin )
    {
        $user = new User();                                    //entitet User
        $form = $this->createForm(CreateForm::class, $user, [
            'action' => $this->generateUrl('app_user_create')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $formData = $form->getData();           
            $dat =['datum'=> $formData[datum]];
            
            $bday = $dat->getDatum(); // date of birth
            $today = new Datetime(date('m.d.y')); // mozda ('Y-m-d')
            $diff = $today->diff($bday);
             
            if ($diff<18)
                {                                                   
                    return $this->render('@App/User/edit.html.twig', ['editForm' => $form->createView()]);
                }                  
          
            else 
                {                 
                    $entityManager = $this->getDoctrine()->getManager();                          
                    $entityManager->persist($user);
                    $entityManager->flush();

                    return $this->redirect($this->generateUrl(
                           'app_user_create' ));   
                }

        }
      
       return $this->render('@App/User/edit.html.twig', ['editForm' => $form->createView()]);
       
    }
    
    
    /**
     * @Route("/list", name="app_user_list")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User'); // AppBundle\Entity\User;

        $users = $repository->findAll();

        return $this->render('@App/User/list.html.twig', ['users' => $users]);
        
    }
    

    /**
     * @Route("/delete-user", name="app_user_delete")
     */
    public function deleteAction(Request $request)
    {
            
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('app_user_list'); 
        
    }
    
    
    /**
     * @Route("/edit-user", name="app_user_edit")
     */
    public function editAction(Request $request)           // akcija kojom cemo editovati Usera iz baze ( samo ako je user logovan)
    {
      
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) { // proveramo da li je User logovan 
            throw $this->createAccessDeniedException();
        }      
            
      $em = $this->getDoctrine()->getManager();
      $user =  $this->getUser();                    // getUser(), f.ja koja u 'user' smesta trenutno logovanog Usera
      $form = $this->createForm(EditForm::class, $user, [                   
            'action'=> $this->generateUrl('app_user_edit')   // // public function generateUrl($route, $parameters = array())
            ]);    
                
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) {
          $entityManager = $this->getDoctrine()->getManager();
            
          $entityManager->persist($user);
          $entityManager->flush();

        return $this->redirectToRoute('app_user_list');
      }
      
      return $this->render('@App/User/edit.html.twig', ['editForm' => $form->createView()]);
    } 
    
    
     /**
     * @Route("/show/{id}", name="app_author_show")
     */
    public function showAuthorAction($id)
    {
      
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No author found for id '.$id
            );
        }
        
        $bookRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Book');
     
        $books = $bookRepository->findAuthorBooks($user);
        
        //Render view
        return $this->render('@App/Book/showauthor.html.twig', [
            'user' => $user,
            'books'=> $books  
        ]);
    }
}
