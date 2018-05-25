<?php

namespace AppBundle\Form\User;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\LessThan;


class RegistrationForm extends AbstractType
{
  
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $today = new \DateTime();
        $today->modify("-18 years");
      
        $builder
            ->add('firstName', TextType::class, [ 'label'=>'Your Name'])
            ->add('lastName', TextType::class, [ 'label'=>'Your Last Name'])                   
            ->add('username', TextType::class, [ 'label'=>'Your Username'])
            ->add('email', EmailType::class, [ 'label'=>'Your email adress'])             
            ->add('plainPassword', RepeatedType::class, 
                array('type' => PasswordType::class, 
                    'first_options'  => array ('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                 ))         
            ->add('birthday', DateType::class, [
                'label' => 'Your date of birth',               
                'years' => range(date('Y') - 48, date('Y')),
                'attr'  => [
                ],
                'constraints' => [
                new LessThan([
                    'value' => $today,
                    'message' => 'You must be 18 or older to register'])                  
                ],
            ])
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}