<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Plate;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;



class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'EUR', // ou false si tu ne veux pas d'icône €
            ])
            
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description',
            ])

            ->add('entrees', EntityType::class, [
                'class' => Plate::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Entrées'
            ])

            ->add('plats', EntityType::class, [
                'class' => Plate::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Plats'
            ])

            ->add('desserts', EntityType::class, [
                'class' => Plate::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Desserts'
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
