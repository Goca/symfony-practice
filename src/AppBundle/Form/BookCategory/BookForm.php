<?php

namespace AppBundle\Form\BookCategory;


use AppBundle\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;


class BookForm extends AbstractType   
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
            'label'=> 'Title'])
            ->add('isbn', TextType::class, [
            'label'=> 'ISBN'])
            ->add('yearOfPublishing', DateType::class, [
                'label'=> 'YearOfPublishing',
                'years' => range(date('Y') - 48, date('Y') + 50),
//                'months' => range (null),
//                'days' => range (null)])  
                ])
            ->add('publisher', TextType::class, [
            'label'=> 'Publisher'])
            ->add('category', TextType::class, [
            'label'=> 'Category']) 
            ->add('author', TextType::class, [
            'label'=> 'Author']) 
            ->add('featured', CheckboxType::class, [
            'label'=> 'Featured']) ;                                    
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }        

}
