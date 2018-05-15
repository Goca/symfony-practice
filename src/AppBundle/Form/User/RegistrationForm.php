<?php

namespace AppBundle\Form\User;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegistrationForm  extends AbstractType 
{
  public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('username', TextType::class, [ 'label'=>'Your Username'])
        ->add('email', EmailType::class, [ 'label'=>'Your email adress'])        
        ->add('plainPassword', RepeatedType::class, 
          array('type' => PasswordType::class, 
                'first_options'  => array ('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
//        ->add('reg', SubmitType::class, array('label' => 'Registration'));        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
