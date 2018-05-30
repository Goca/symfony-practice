<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Column(type="integer") 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")    
     */ 
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */                                         
    private $firstName;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName;
       
    /**
     * @ORM\Column(type="datetime", nullable=true)     
     */
    private $birthday;
        
    /**
     * @Assert\Regex(
     *  pattern="/(?=.*[0-9]).{8,}/",
     *  message="Password must be 8 characters long and contain at least one number"
     * )
     */
    protected $plainPassword;
    
    /**
    * @ORM\OneToMany(targetEntity="Book", mappedBy="author")
    */
    private $books;  // kako ce nam se zvati polje u ovom entitetu ( polje koje dobijamo iz relacije prema entitetu Book, (targetEntity="Book"))
                   
    public function getFullName()  // f.ja koja ce nam vratiti ime i prezime
    {        
     $fullname = $this->firstName . ' ' . $this->lastName; 
     return $fullname;
    }
            
    public function __toString() 
    {
        return $this->getFullName();        
    } 
    
    public function __construct()
    {
        parent::__construct(); 
        $this->books = new ArrayCollection();
    }    
         
    
    public function getId()
    {
        return $this->id;        
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
   
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
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


