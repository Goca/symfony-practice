<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Publisher;
use AppBundle\Form\BookCategory\PublisherForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/publisher") 
 */       
class PublisherController extends Controller
{  

    /**
     * @Route("/add", name="app_publisher_add")
     */
    public function addAction(Request $request)           
    {
        $publisher = new Publisher();                                   
        $form = $this->createForm(PublisherForm::class, $publisher, [
            'action' => $this->generateUrl('app_publisher_add')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($publisher);
            $entityManager->flush();

            return $this->redirect($this->generateUrl(
                'app_publisher_add'
            ));
        }

        return $this->render('@App/Book/addpublisher.html.twig', ['pubForm' => $form->createView()]);

    } 
         
    
    /**
     * @Route("/edit/{id}", name="app_publisher_edit")
     */
    public function editAction(Request $request, $id)          
    {
      
        $em = $this->getDoctrine()->getManager();
        $publisher = $em->getRepository('AppBundle:Publisher')->find($id);
        
        $form = $this->createForm(PublisherForm::class, $publisher, [                                
            'action' => $this->generateUrl('app_publisher_edit', array('id'=> $publisher->getId()))   
        ]);
        
        $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              $entityManager = $this->getDoctrine()->getManager();
            
              $entityManager->persist($publisher);
              $entityManager->flush();

              return $this->redirectToRoute('app_publisher_add');
          }

          return $this->render('@App/Book/addpublisher.html.twig', ['pubForm' => $form->createView()]);

    }
    
    
    /**
     * @Route("/delete/{id}", name="app_publisher_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $publisher = $em->getRepository('AppBundle:Publisher')->find($id);

        if (!$publisher) {
            throw $this->createNotFoundException('No User found for id ' . $id);
        } else 
          {          
              $em->remove($publisher);
              $em->flush();

              return $this->redirectToRoute('app_publisher_list');
          }
    }
    
    
     /**
     * @Route("/list-publisher", name="app_publisher_list")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Publisher'); // AppBundle\Entity\User;

        $publishers = $repository->findAll();

        return $this->render('@App/Book/listpublisher.html.twig', ['publishers' => $publishers]);
    }
    
    
     /**
     * @Route("/show/{id}", name="app_book_publisher")
     */
    public function showPublisher($id)
    {
      
        $publisher = $this->getDoctrine()
        ->getRepository(Publisher::class)
        ->find($id);

        if (!$publisher) {
            throw $this->createNotFoundException(
                'No publisher found for id '.$id
            );
        }
        
        return $this->render('@App/Book/showpublisher.html.twig', ['publisher' => $publisher]);
    }
    
}
