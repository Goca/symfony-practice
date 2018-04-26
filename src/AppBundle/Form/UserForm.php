<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ime', TextType::class)
            ->add('prezime', TextType::class, array('required' => false))
           ->add('opis', TextareaType::class, array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Submit'))
        ;
    }   
}

