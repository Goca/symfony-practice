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
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;
  
    /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="category")
     */
    private $books;

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

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;        
        return $this;
    }
    

    public function addBook(Book $book)
    {
        $this->books[] = $book;
        return $this;
    }

    public function removeBook(Book $book)
    {
        $this->books->removeElement($book);
    }

    public function getBooks()
    {
        return $this->books;
    }
      
}
