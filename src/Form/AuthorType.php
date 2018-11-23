<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    // overwrite method buildForm to define wanted form fields
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('LastName', TextType::class, ['label' => 'Nom'])
            ->add('save', SubmitType::class, ['label' => 'Soumettre'])
        ;
    }
    
    // overwrite method configureOptions to define class concerned by the form
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Author::class]);
    }
}