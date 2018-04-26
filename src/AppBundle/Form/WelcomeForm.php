<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class WelcomeForm extends AbstractType


 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
            ->add('ime', TextType::class, array('label' => 'Ime','attr' => array('placeholder' => 'Upisi ime'))) //moze array da se pise, ali i ne mora
            ->add('save', SubmitType::class, array('label' => 'Submit'))                                          //obzirom da mi ovde imamo samo placeholder 'placeholder' => 'Type your message...'
        ;                                                                                                         //atrr je niz koji moze da sadrzi i 'cols'=>66,'rows'=>6,'class'='biggest'
    }   
}
  

