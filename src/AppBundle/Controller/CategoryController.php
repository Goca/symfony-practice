<?php

namespace AppBundle\Controller;


use AppBundle\Entity\BookCategory;
use AppBundle\Form\BookCategory\CategoryForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/book-category") // obzirom da u dva kontrolera imamo new, kao rutu, resava se sve time sto se stavi anotacija ispred cele klase
 */                         // (ovde ispred celog UserControllera)
class CategoryController extends Controller
{
    
    /**
     * @Route("/new", name="app_category_new")
     */
    public function newAction(Request $request)           
    {
        $category = new BookCategory();                                    
        $form = $this->createForm(CategoryForm::class, $category, [
            'action' => $this->generateUrl('app_category_new')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirect($this->generateUrl(
                'app_category_new'
            ));
        }

        return $this->render('@App/BookCategory/new.html.twig', ['newForm' => $form->createView()]);

    }
    
    
    /**
     * @Route("/edit-category/{id}", name="app_category_edit")
     */
    public function editAction(Request $request, $id)          
    {
      
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:BookCategory')->find($id);
        
        $form = $this->createForm(CategoryForm::class, $category, [                                
            'action' => $this->generateUrl('app_category_edit', array('id'=> $category->getId()))   
        ]);                                                                                 
        $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              $entityManager = $this->getDoctrine()->getManager();
            
              $entityManager->persist($category);
              $entityManager->flush();

              return $this->redirectToRoute('app_category_list');
          }

          return $this->render('@App/BookCategory/new.html.twig', ['newForm' => $form->createView()]);

    }
    
    
    /**
     * @Route("/delete-category/{id}", name="app_category_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:BookCategory')->find($id);

        if (!$category) { 
            throw $this->createNotFoundException('No Book Category found for id ' . $id);
        } else {
            $em->remove($category);
            $em->flush();

            return $this->redirectToRoute('app_category_list');
        }
    }
    
    
    /**
     * @Route("/list-category", name="app_category_list")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:BookCategory'); // AppBundle\Entity\User;

        $categorys = $repository->findAll();

        return $this->render('@App/BookCategory/listcategory.html.twig', ['categorys' => $categorys]);
    }
    
}
