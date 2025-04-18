<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbCouverts', ChoiceType::class, [
                'choices' => array_combine(range(1, 8), range(1, 8)),
                'label' => 'Nombre de couverts',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de réservation',
            ])
            ->add('horaire', ChoiceType::class, [
                'choices' => [
                    '11h30' => '11:30',
                    '13h30' => '13:30',
                    '18h30' => '18:30',
                    '20h30' => '20:30',
                ],
                'label' => 'Horaire',
            ])
            ->add('civilite', ChoiceType::class, [
                'choices' => ['Madame' => 'Madame', 'Monsieur' => 'Monsieur', 'Mx' => 'Mx'],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('prenom', TextType::class)
            ->add('nom', TextType::class)
            ->add('telephone', TelType::class)
            ->add('email', EmailType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
