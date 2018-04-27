<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class WelcomeForm extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
            
    {
       $builder
          ->add('ime', TextType::class, array(
              'label' => 'Ime',
              'constraints' => array(
                new NotBlank(['message' => 'Ime je obavezno'] ),
                new Length(array('min' => 2,'minMessage' => 'Ime je obavezno'))),                      
              'attr' => array(
                'placeholder' => 'Upisi ime',
                )))
          ->add('prezime', TextType::class, array(
              'label' => 'Prezime',
              'constraints' => array(
                new NotBlank(['message' => 'Prezime je obavezno'] ),
                new Length(array('min' => 2,'minMessage' => 'Prezime je obavezno'))),  
              'attr' => array(
                'placeholder' => 'Upisi prezime',
                )))
          ->add('maticnibroj', TextType::class, array(
              'label' => 'Maticni broj',
              'constraints' => array(
                new NotBlank(['message' => 'Vas maticni broj je obavezan'] ),
                new Length(array('min' => 13,'minMessage' => 'nevazeci maticni broj'))), 
              'attr' => array(
                  'placeholder' => 'Upisi maticni broj',                
                ))) 
          ->add('datum', DateType::class, array(
              'label' => 'Datum rodjenja',
              'attr' => array(
                  'placeholder' => 'Upisi datum rodjenja',
                )))       
          ->add('save', SubmitType::class, array('label' => 'Submit'))                                         
        ;                                                                                                         
    }   
}
  

