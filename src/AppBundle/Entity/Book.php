<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks() 
 * @ORM\Table(name="book")
 */
class Book
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
    * @Assert\Isbn(
    *     type = "isbn10",
    *     message = "This value is not valid."
    * )
    */
    
    private $isbn;
    
    /**
    * @ORM\Column(type="datetime", nullable=true)
    */
    
    private $yearOfPublishing;
          
    /**    
    * @ORM\ManyToOne(targetEntity="Publisher", inversedBy="books")
    * @ORM\JoinColumn(name="publisher_id", referencedColumnName="id") // name="publisher_id", odnosi se na entitet u kom se nalazimo, referencedColumnName="id" se odnosi na Publisher-a, target entitet
    */
    private $publisher;
        
    /**
    * @ORM\ManyToOne(targetEntity="BookCategory", inversedBy="books")
    * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
    */
    private $category;
        
    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="books")
    * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
    */
    private $author;     
    
    /**
     * @ORM\Column(type="boolean")   // the book marked as featured and that book will appears in special sections (flegovi)
     * @Assert\NotBlank()            // u formi ne kao boolean type nego kao checkbox type
     */
    private $featured;       
    
    /**
     * @ORM\Column(type="datetime") //createAt ne moze biti null
     */                        
    private $createdAt ;    
          
    /**
     * @ORM\Column(type="datetime", nullable=true) 
     */                                          
    private $updatedAt ;
    
    
     public function __construct()   
     {
        $this->featured = FALSE;
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
    
    public function getIsbn()
        {
            return $this->isbn;
        }

    public function setIsbn($isbn)
        {
            $this->isbn = $isbn;
        }
    
    public function getYearOfPublishing()
        {
            return $this->yearOfPublishing;
        }
    
    public function setYearOfPublishing($yearOfPublishing)
        {
      
            $this->yearOfPublishing = $yearOfPublishing;
        }
            
    public function getPublisher()
        {
            return $this->publisher;
        }

    public function setPublisher($publisher)
        {
            $this->publisher = $publisher;
         }
    
    public function getCategory()
        {
            return $this->category;
        }

    public function setCategory($category)
        {
            $this->category = $category;
        }
    
    public function Author()
        {
            return $this->author;
        }
      
    public function setAuthor($author)
        {
            $this->author = $author;
        }
    
    public function getFeatured()
        {
            return $this->featured;
        }

    public function setFeatured($featured)
        {
            $this->featured =$featured;
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
        
}
