<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\UserForm;
use AppBundle\Form\WelcomeForm;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        return $this->render('@App/Default/index.html.twig'); // , moze da ima i drugi argument ... array(), ne mora
        
        // return $this->render('default/index.html.twig'); // vraca difoltnu pocetnu stranicu
    }
    
    
    /**
     * @Route("/form", name="form")
     */
    public function formAction()
    {
        $form= $this->createFormBuilder()              // ovo se koristi samo jednom i nikada vise, bukvalno
                ->add('personName', TextType::class)  // ako bi nam trebalo jos koje polje, pisali bismo npr.-> add ('prezime', Texttype::class i tako onoliko puta koliko nam treba
                ->getForm();                         // $form = $this->createForm(UserForm::class); menja sve ovo,broj polja,dodajemo kroz klasu
        
        return $this->render('@App/Default/form.html.twig', ['userForm'=>$form->createView()]); 
    }
    
    
    /**
     * @Route("/form2", name="form2")
     */
    public function form2Action(Request $request)
    {
        $form = $this->createForm(UserForm::class, null, [      
            'action' => $this->generateUrl('form2')         
        ]);                                                   
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
          $formData = $form->getData(); 
          /* array sa poljima iz forme
           * array(3) { ["Ime"]=> string(6) "Marija" ["Prezime"]=> string(5) "Budic" ["description"]=> string(17) "O meni neki tekst" }
           */
          return $this->render('@App/Default/form3.html.twig', [
              'firstName'=> $formData['ime'],
              'lastName'=> $formData['prezime'],
              'description'=>$formData['opis'],
              
            ]); 
        }
       
        return $this->render('@App/Default/form2.html.twig', ['userForm'=>$form->createView()]); 
       
    }
    
    
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
          
          return $this->render('@App/Default/user.html.twig', ['firstName'=>$formData['ime'],'userForm'=>$form->createView()]); 
          
        }
        
//        $form = $this->createForm(UserForm::class, null, [      
//            'action' => $this->generateUrl('user')         
//        ]); 
        
        return $this->render('@App/Default/user.html.twig', ['userForm'=>$form->createView()]); // , moze da ima i drugi argument, sada ima view ... array(), ne mora
        
        // return $this->render('default/index.html.twig'); // vraca difoltnu pocetnu, index.html.twig
    }
    
    
    /**
     * @Route("/welcome", name="welcome")
     */
    public function welcomeAction(Request $request)
    {
        
       $form = $this->createForm(WelcomeForm::class, null, [      
            'action' => $this->generateUrl('welcome')         
        ]); 
       
       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {         
          
          $formData = $form->getData();
          
          $formnew = $this->createForm(WelcomeForm::class, null, [      // zelimo da zapamtimo praznu formu, kreiramo je jos jednom i pametimo u nekoj promenljivoj formnew
            'action' => $this->generateUrl('welcome')         
        ]); 
          
          return $this->render('@App/Default/welcome.html.twig', ['firstName'=>$formData['ime'],
                                                                  'matbr'=>$formData['maticnibroj'],
                                                                  'datrodj'=>$formData['datum'],
                                                                  'welcomeForm'=>$formnew->createView()]); // vratimo praznu, koju samo sacuvali u formnew
          
          
        }
        
//        $form = $this->createForm(UserForm::class, null, [      
//            'action' => $this->generateUrl('user')         
//        ]); 
        
        return $this->render('@App/Default/welcome.html.twig', ['welcomeForm'=>$form->createView()]); // , moze da ima i drugi argument, sada ima view ... array(), ne mora
        
        // return $this->render('default/index.html.twig'); // vraca difoltnu pocetnu, index.html.twig
    }
    
    
    /**
     * @Route("/form3", name="form3")
     */
    public function form3Action()
    {
        $form = $this->createForm(UserForm::class);
        return $this->render('@App/Default/form3.html.twig', ['userForm'=>$form->createView()]); // bilo je myForm,
    }                                                                                            // stavili smo user Form da prati klasu
        
}
        
    
    