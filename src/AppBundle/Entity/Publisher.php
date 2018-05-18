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
     * @ORM\OneToMany(targetEntity="Book", mappedBy="publisher")
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
     * @ORM\Column(type="datetime", nullable=true) 
     */                     
    private $createdAt ;    
          
    /**
     * @ORM\Column(type="datetime", nullable=true) 
     */                                          
    private $updatedAt ;
      
    
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
   
    /**
    * @ORM\PrePersist
    */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
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
    * @ORM\PreUpdate
    */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
           
}
