<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;


class BookRepository extends EntityRepository 
{
    public function findAllfeaturedBooks()        
    {
        return $this->createQueryBuilder('book')
            ->where('book.featured = :featured')
            ->setParameter('featured', true)
            ->getQuery()
            ->getResult()           
        ;
    }
}
