<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;


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
                   
    public function getFullName()  // f.ja koja ce nam vratiti ime i prezime
    {        
     $fullname = $this->name . ' ' . $this->lastname; 
     return $fullname;
    }
            
    public function __toString() 
    {
        return $this->getFullName();        
    } 
    
    public function __construct()
    {
        parent::__construct(); 
        // your own logic
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
}


