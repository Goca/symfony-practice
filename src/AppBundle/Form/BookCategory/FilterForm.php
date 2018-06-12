<?php


namespace AppBundle\Form\BookCategory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class FilterForm  extends AbstractType
{
  
    public function buildForm(FormBuilderInterface $builder, array $options)
        {

            $builder
                ->add('title', TextType::class, [
                    'attr' => [
                    'placeholder' => 'Filter by Title'],
                    ])
                ->add('isbn', TextType::class, [
                    'attr' => [
                    'placeholder' => 'Filter by ISBN'],
                    ])    
                ->add('filter', SubmitType::class, 
                    array('label' => 'Filter'));
    }    
}
                
                

