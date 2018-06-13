<?php


namespace AppBundle\Form\BookCategory;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class FilterForm  extends AbstractType
{
  
    public function buildForm(FormBuilderInterface $builder, array $options)
        {

            $builder
                ->add('title', TextType::class, [
                    'attr' => [
                    'placeholder' => 'Filter by Title'],
                    'required' => FALSE
                    ])
                ->add('isbn', TextType::class, [
                    'attr' => [
                    'placeholder' => 'Filter by ISBN'],
                    'required' => FALSE
                    ])
                ->add('fromDate', DateType::class, array(
                    'required' => FALSE,
                    'attr' => [
                        'placeholder' => 'From Year '],   
                    'widget' => 'single_text',
                    'format' => 'yyyy',
                ))  
                ->add('toDate', DateType::class, array(
                    'required' => FALSE,
                    'attr' => [
                    'placeholder' => 'To Year'],   
                    'widget' => 'single_text',
                    'format' => 'yyyy',
                ))   
                ->add('filter', SubmitType::class, 
                    array('label' => 'Filter'));
    }    
}
                
                

