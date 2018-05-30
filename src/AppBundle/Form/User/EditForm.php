<?php

namespace AppBundle\Form\User;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\LessThan;


class EditForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $today = new \DateTime();
        $today->modify("-18 years");
        
        $builder
            ->add('firstName', TextType::class, [
                'label'=> 'FirstName',
                'constraints' => [
                new NotBlank(['message' => 'Ime je obavezno']),
                new Length(['min' => 2, 'minMessage' => 'Ime je obavezno']),
                ],
                'attr' => [
                    'placeholder' => 'Upisi ime'],
            ])
            ->add('lastName', TextType::class, [
                'label'=> 'LastName',
                'constraints' => [
                new NotBlank(['message' => 'Prezime je obavezno']),
                new Length(['min' => 2, 'minMessage' => 'Prezime je obavezno']),
                ],
                'attr'=> [
                    'placeholder' => 'Upisi prezime'],
            ])            
            ->add('birthday', DateType::class, [
                'label' => 'Your date of birth',               
                'years' => range(date('Y') - 48, date('Y')),                
                'attr'  => [
                    'placeholder' => 'Upisi datum rodjenja'],
                'constraints' => [
                new LessThan([
                    'value' => $today,
                    'message' => 'You must be 18 or older'])                    
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}