<?php

namespace App\Form;

use App\Entity\Plate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class PlateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name')
        ->add('description')
        ->add('imageSpine', FileType::class, [
            'label' => 'Image tranche (15x190px)',
            'required' => false,
            'mapped' => false,
        ])
        ->add('imageFront', FileType::class, [
            'label' => 'Image face (135x190px)',
            'required' => false,
            'mapped' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plate::class,
        ]);
    }
}
