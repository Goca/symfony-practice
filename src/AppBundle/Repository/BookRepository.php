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
    
    
}
