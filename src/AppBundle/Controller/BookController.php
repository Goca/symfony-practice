<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Book;
use AppBundle\Form\BookCategory\BookForm;
use AppBundle\Form\BookCategory\FilterForm;
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
                'app_book_add', ['id' => $book->getId()]
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
        
        $form = $this->createForm(BookForm::class, $book, [                                
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
    public function listAction(Request $request)
    {
        $bookRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Book'); // AppBundle\Entity\Book;
        $books = $bookRepository->orderByFeaturedBooks();
       
        $form = $this->createForm(FilterForm::class, null, [                                
            'action' => $this->generateUrl('app_book_list')   
        ]);
        
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
              
                $formData = $form->getData();                                                                  
                $books = $bookRepository->filterBooksByTitle($formData['title']);                             
            }
        

        return $this->render('@App/Book/listbook.html.twig', [
            'books' => $books, // prosledjumemo  promenljivu koja je niz ( niz knjiga)
            'filterForm' => $form->createView() // prosledjujemo formu
                ]);
    }
    
    /**
     * @Route("/featured", name="app_book_featured")
     */
    public function featuredBooksAction()     
    {        
       
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Book');
        
        $books = $repository->findAllFeaturedBooks(); 
        
        return $this->render('@App/Book/listbook.html.twig', ['books' => $books]);

    }
    
    /**
     * @Route("/show/{id}", name="app_book_show")
     */
    public function showBookAction($id)                 // i ovo je na neki nacin upit, ali obzirom da je rezultat samo jedan slog tabele, ne mora se pisati kao poseban query
    {
      
        $book = $this->getDoctrine()
        ->getRepository(Book::class)
        ->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }
        
        return $this->render('@App/Book/showbook.html.twig', ['book' => $book]);
    }
         
}