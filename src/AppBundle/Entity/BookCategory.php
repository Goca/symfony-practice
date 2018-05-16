<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
    */ 
    private $id;
    
    
    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;
    
    
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
