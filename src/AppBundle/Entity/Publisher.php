<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks() 
 * @ORM\Table(name="publisher")
 */
class Publisher 
{ 
    
    /**
     * @ORM\Column(type="integer") 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")          
     */
     
    private $id;
      
    /**
     * @ORM\Column(type="string", length=255, unique=true) 
     * @Assert\NotBlank()
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", length=255, unique=true) 
     * @Assert\NotBlank()
     */
    private $city;
      
    /**
     * @ORM\Column(type="datetime") 
     */                     
    private $createdAt ;    
          
    /**
     * @ORM\Column(type="datetime", nullable=true) 
     */                                          
    private $updatedAt ;
      
    
    /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="publisher") // mappedBy="publisher" pokazuje prekokog polja se ostvaruje relacija sa entitetom BooK )
     */
    private $books; // kako ce nam se zvati polje u ovom entitetu ( polje koje dobijamo iz relacije prema entitetu Book (targetEntity="Book"), 
    
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
            return$this->title = $title;
        }     
    
    public function getCity()
        {
            return $this->city;
        }
    
    public function setCity($city)
        {
            $this->city = $city;
        }
    
   public function getCreatedAt()
        {
            return $this->createdAt;
        }

    public function setCreatedAt($createdAt)
        {
            return $this->createdAt = $createdAt;         
        }   
        
    public function getUpdatedAt()
        {
            return $this->updatedAt;
        }

    public function setUpdatedAt($updatedAt)
        {
            return $this->updatedAt = $updatedAt;      
        } 
            
    /**
     * @ORM\PrePersist
     */        
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
        
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
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
