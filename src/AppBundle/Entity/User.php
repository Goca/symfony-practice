<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



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
     */ 
    private $id;

    
    /**
     * @ORM\Column(type="string", length=255, unique=true) 
     * @Assert\NotBlank()
     */
    private $username;
    
    
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    
    
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    
    
    /**
     * @ORM\Column(type="string", nullable=true) // jedan isti entitet koristimo za razlicite forme (u ovom slucaju forma za registraciju i forma za kreiranje novih usera
     */                                          // ovako dozvoljavamo da ta polja budu null, da ih ne popunimo. Potrebna su nam samo 3 polja, a imamo ih  8
    private $ime;


    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $prezime;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $maticni_broj;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datum;
        
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
      public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    
     public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }   
    
     public function getPlainPassword()
    {
       return $this->plainPassword;
    }

     public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
       
     public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIme()
    {
        return $this->ime;
    }

    public function setIme($ime)
    {
        $this->ime = $ime;
    }

    public function getPrezime()
    {
        return $this->prezime;
    }

    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
    }

    public function getMaticnibroj()
    {
        return $this->maticni_broj;
    }

    public function setMaticnibroj($maticni_broj)
    {
        $this->maticni_broj = $maticni_broj;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

}


