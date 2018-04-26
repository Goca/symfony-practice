<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;





class WelcomeForm extends AbstractType


 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
            
    {
       $builder
            ->add('ime', TextType::class, array('label' => 'Ime','attr' => array('placeholder' => 'Upisi ime')))
            ->add('prezime', TextType::class, array('label' => 'Prezime','attr' => array('placeholder' => 'Upisi prezime')))
            ->add ('maticnibroj', TextType::class, array('label' => 'Maticni broj','attr' => array('placeholder' => 'Upisi maticni broj')))
            ->add('datum', DateType::class, array('label' => 'Datum rodjenja','attr' => array('placeholder' => 'Upisi datum rodjenja')))
            
               
//           ->add('izbor', ChoiceType::class, array(
//                  'choices'  => array(
//                    'Maybe' => null,
//                    'Yes' => true,
//                    'No' => false,
//                      )))
               
            ->add('save', SubmitType::class, array('label' => 'Submit'))                                         
        ;                                                                                                         
    }   
}
  

