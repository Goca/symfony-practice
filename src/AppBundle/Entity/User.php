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
    private $ime;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $prezime;
       
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datum ;
        
    /**
     * @Assert\Regex(
     *  pattern="/(?=.*[0-9]).{8,}/",
     *  message="Password must be 8 characters long and contain at least one number"
     * )
     */
    protected $plainPassword;
                   
    public function getFullName()  // f.ja koja ce nam vratiti ime i prezime
    {        
     $fullname = $this->ime . ' ' . $this->prezime; 
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
   
    public function getIme()
    {
        return $this->ime;
    }

    public function setIme($ime)
    {
        $this->ime = $ime;
        return $this;
    }

    public function getPrezime()
    {
        return $this->prezime;
    }

    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
        return $this;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function setDatum($datum)
    {
        $this->datum = $datum;
        return $this;
    }       
}


