<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
* @ORM\Entity()
* @ORM\Table(name="book_category")
*/
  class BookCategory 
  {
  
    /**
    * @ORM\Column(type="integer") 
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\OneToMany(targetEntity="Book", mappedBy="category")
    */ 
    private $id;
        
    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;
        
     public function __construct()
    {
        $this->books = new ArrayCollection();
    }
        
    public function __toString() 
    {
        return $this->title;
    }   
          
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }        
}
