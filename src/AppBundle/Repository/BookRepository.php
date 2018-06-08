<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;


class BookRepository extends EntityRepository 
{
    public function findAllFeaturedBooks()        
    {
        return $this->createQueryBuilder('book')
            ->where('book.featured = :featured')
            ->setParameter('featured', true)
            ->getQuery()
            ->getResult()           
        ;
    }
        
    public function orderByFeaturedBooks()        
    {
        return $this->createQueryBuilder('book')             
            ->orderBy('book.featured', "DESC")                  
            ->getQuery()
            ->getResult()           
        ;
    }
    
    public function findAuthorBooks($user) // user, oznacava jednu vrstu (row), jedan slog entiteta User (prosledjujemo sva polja eniteta)
    {
        return $this->createQueryBuilder('book')              
            ->where('book.author = :author') // :author je promenljiva (moze se zvati kako god zelimo). Prihvata podatke koji ispunjavaju uslove iz upita
                
            ->setParameter('author', $user)   // setParametar se obicno pise pre order-a ('author' je promenljiva kojoj moramo da dodelimo vrednost
                                                // vrednost promenljive autor je  user, znaci citava vrsta, sva polja iz entiteta User
            ->orderBy('book.featured', "DESC") 
            ->getQuery()
            ->getResult()
       ;       
    }
        
    public function findPublisherBooks($publisher) // prosledjujemo  celu jednu vrstu (row) eniteta Publisher
    {
      
        return $this->createQueryBuilder('book')     // book, jedna vrsta entiteta Book         
            ->where('book.publisher = :publisher') //  :publisher, promenljiva koja se moze zvati bilo kako, tu je prihvati podatke iz entiteta Publisher
            ->setParameter('publisher', $publisher) 
            ->orderBy('book.featured', "DESC")
            ->getQuery()
            ->getResult()
       ;       
    }
    
    public function filterBooksByTitle($title)       
    {
        return $this->createQueryBuilder('book')
            ->where('book.title = :title')
            ->setParameter('title', $title)
            ->getQuery()
            ->getResult()           
        ;
    }
    
    
}
