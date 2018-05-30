<?php

namespace AppBundle\Form\BookCategory;


use AppBundle\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Intl\DateFormatter\DateFormat\YearTransformer;


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
                'years' => range(date('Y') - 48, date('Y'))])
            ->add('publisher', EntityType::class, [
                'class' => 'AppBundle:Publisher',
                'label'=> 'Publisher'])
            ->add('category', EntityType::class, [
                'class'=> 'AppBundle:BookCategory',
                'label'=> 'Category']) 
            ->add('author', EntityType::class, [
                'required' => FALSE,
                'class'=> 'AppBundle:User',
                'label'=> 'Author'])              
            ->add('featured', CheckboxType::class, [
            'label'=> 'Featured']) ;   
        
         $builder->get('yearOfPublishing')
            ->addModelTransformer(new YearTransformer());
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }        

}
