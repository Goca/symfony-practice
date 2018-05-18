<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Book;
use AppBundle\Form\BookCategory\BookForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/book") 
 */
class BookController extends Controller
{
    
    /**
     * @Route("/add", name="app_book_add")
     */
    public function addAction(Request $request)           
    {
        $book = new Book();                                    
        $form = $this->createForm(BookForm::class, $book, [
            'action' => $this->generateUrl('app_book_add')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {                                
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirect($this->generateUrl(
                'app_book_add'
            ));
        }

        return $this->render('@App/Book/addbook.html.twig', ['addForm' => $form->createView()]);

    }          
      
    
    /**
     * @Route("/edit-book/{id}", name="app_book_edit")
     */
    public function editAction(Request $request, $id)          
    {
      
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AppBundle:Book')->find($id);
        
        $form = $this->createForm(CategoryForm::class, $book, [                                
            'action' => $this->generateUrl('app_book_edit', array('id'=> $book->getId()))   
        ]);                                                                                 
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
            
                $entityManager->persist($book);
                $entityManager->flush();

                return $this->redirectToRoute('app_book_list');
            }

          return $this->render('@App/Book/addbook.html.twig', ['addForm' => $form->createView()]);

    }
        
    
    /**
     * @Route("/delete-book/{id}", name="app_book_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AppBundle:Book')->find($id);

        if (!$book) { 
            throw $this->createNotFoundException('No Book  found for id ' . $id);
        } else {
            $em->remove($book);
            $em->flush();

            return $this->redirectToRoute('app_book_list');
        }
    }
       
    
    /**
     * @Route("/list-book", name="app_book_list")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Book'); // AppBundle\Entity\User;

        $categorys = $repository->findAll();

        return $this->render('@App/Book/listbook.html.twig', ['books' => $books]);
    }
    
}
