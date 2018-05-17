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


class CreateForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ime', TextType::class, [
                'label'=> 'Ime',
                'constraints' => [
                new NotBlank(['message' => 'Ime je obavezno']),
                new Length(['min' => 2, 'minMessage' => 'Ime je obavezno']),
                ],
                'attr' => [
                'placeholder' => 'Upisi ime',
                ],
              ])
            ->add('prezime', TextType::class, [
                'label'=> 'Prezime',
                'constraints' => [
                new NotBlank(['message' => 'Prezime je obavezno']),
                new Length(['min' => 2, 'minMessage' => 'Prezime je obavezno']),
              ],
                'attr'=> [
                'placeholder' => 'Upisi prezime',
                ],
              ])
             ->add('maticni_broj', TextType::class, [
                  'label'       => 'Maticni broj',
                  'constraints' => [
                  new NotBlank(['message' => 'Vas maticni broj je obavezan']),
                  new Length(['min' => 13, 'minMessage' => 'nevazeci maticni broj']),
                  ],
                  'attr'        => [
                  'placeholder' => 'Upisi maticni broj',
                ],
              ])
              ->add('datum', DateType::class, [
                  'label' => 'Datum rodjenja',
                  'years' => range(date('Y') - 48, date('Y') + 50),
                  'attr'  => [
                  'placeholder' => 'Upisi datum rodjenja',
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