<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\User\RegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends Controller
{
    /**
    * @Route("/register", name="user_registration")
    */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(RegistrationForm::class, $user, []);  // $form = $this->createForm(RegistrationForm::class, new User()), isto. prethodni red ne treba onda
     
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

      
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
      
            return $this->redirectToRoute('app_user_list');                 
        }
        
        return $this->render ('@App/User/register.html.twig', ['form' => $form->createView()]);      
    }
}