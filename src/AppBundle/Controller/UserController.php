<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\WelcomeForm;
use Symfony\Component\Validator\Constraints\DateTime;



class UserController extends Controller
{
  /**
 * @Route("/create", name="create")
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
    
    $user->setIme('Marija');
    $user->setPrezime('Budic');
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
            'action' => $this->generateUrl('update')         //
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

        
      return $this->render('@App/Default/welcome.html.twig', ['welcomeForm'=>$form->createView()]);
                
  }
        
}   
    