<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $ime;


    /**
     * @ORM\Column(type="string")
     */
    private $prezime;


    /**
     * @ORM\Column(type="string")
     */
    private $maticni_broj;


    /**
     * @ORM\Column(type="datetime")
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


