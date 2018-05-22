<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Column(type="integer") // umesto type obicno pisemo name, jer je to ime kolone 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Book", mappedBy="author")
     */ 
    private $id;
    
    /**
     * @ORM\Column(type="string", nullable=true) // jedan isti entitet koristimo za razlicite forme (u ovom slucaju forma za registraciju i forma za kreiranje novih usera
     */                                          // ovako dozvoljavamo da ta polja budu null, da ne moramo da ih popunimo. Potrebna su nam samo 3 polja, a imamo ih  8
    private $ime;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $prezime;
    
     /**
     * @ORM\Column(type="string", length=255, nullable=true) 
     
     */
    private $username;
         
    /**
     * @ORM\Column(type="string", length=255, nullable=true)    
     */
    private $email;
    
     /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
         
   /**          
     * @ORM\Column(type="string", length=64)
     */
    private $password;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datum ;
    
        
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }    
        
    public function getFullName()  // f.ja koja ce nam vratiti ime i prezime
    {        
     $fullname = $this->ime . ' ' . $this->prezime; 
     return $fullname;
    }
            
    public function __toString() 
    {
        return $this->getFullName();
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
    
      public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
     public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    } 
    
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
       
     public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
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


