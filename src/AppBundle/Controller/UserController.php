<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\WelcomeForm;
use AppBundle\Form\UserEditForm;
use Symfony\Component\Validator\Constraints\DateTime;


class UserController extends Controller
{
 
  
  /**
   * @Route("/user", name="user")
   */
  public function userAction(Request $request)          
  { 
    
    $form = $this->createForm(WelcomeForm::class, null, [      
        'action' => $this->generateUrl('user')         
      ]); 
       
    $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {         
          
        $formData = $form->getData();
          
        return $this->render('@App/User/create.html.twig', ['firstName'=>$formData['ime'],'userForm'=>$form->createView()]); 
         
      }
        
      return $this->render('@App/User/create.html.twig', ['userForm'=>$form->createView()]);        
  }
    
    
  /**
   * @Route("/new", name="new")
   */
  public function createAction()          
  {
  
    $entityManager = $this->getDoctrine()->getManager();
    $user = new User();
    
    $user->setIme('Petar');
    $user->setPrezime('Petrovic');
    $user->setMaticnibroj(1234567890222);
    $datum = new \DateTime();
    $user->setDatum($datum);
    
    $entityManager->persist($user);
    $entityManager->flush();

    return new Response('Saved new User with id '.$user->getId());
  }

  
  /**
   * @Route("/formatd", name="formatd")
   */
  public function formatdAction()          
  {
    
    $entityManager = $this->getDoctrine()->getManager();
    $user = new User();
    
    $user->setIme('Ana');
    $user->setPrezime('Anic');
    $user->setMaticnibroj(1234567890123);
   
    $datetime = new \DateTime();
    $newDate = $datetime->createFromFormat('d/m/Y', '01/01/2001');
    $user->setDatum($newDate);
    
    
    $entityManager->persist($user);
    $entityManager->flush();

    return new Response('Saved new User with id '.$user->getId());
  }
  

  /**
   * @Route("/update", name="update") // akcija kojom cemo upisiviti Usera u bazu
   */
  public function updateAction(Request $request)          
  {
    
    $entityManager = $this->getDoctrine()->getManager();
    
    $user = new User();
    
    $form = $this->createForm(WelcomeForm::class, null, [      
            'action' => $this->generateUrl('update')         
        ]); 
       
    $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {                
      $formData = $form->getData();                 
          
      $user->setIme($formData['ime']);             
      $user->setPrezime($formData['prezime']);
      $user->setMaticnibroj($formData['maticnibroj']);   
      $user->setDatum($formData['datum']);
                    
        $entityManager->persist($user);   
        $entityManager->flush();

          return new Response('Saved new User with id '.$user->getId());
        
      }
        
        return $this->render('@App/User/create.html.twig', ['welcomeForm'=>$form->createView()]);
                
  }

    /**
     * @Route("/create", name="app_user_create")
     */
    public function newAction(Request $request)           // akcija kojom cemo upisiviti Usera u bazu ( drugi nacin )
    {
        $user = new User();                                   //entitet User
        $form = $this->createForm(UserEditForm::class, $user, [
            'action' => $this->generateUrl('app_user_create')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirect($this->generateUrl(
                'app_user_create'
            ));
        }

        return $this->render('@App/User/create.html.twig', ['welcomeForm' => $form->createView()]);

    }
}
