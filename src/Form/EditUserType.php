<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;


use App\Entity\User;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
    ->add('civilite', ChoiceType::class, [
        'choices' => [
            'Monsieur' => 'Monsieur',
            'Madame' => 'Madame',
            'Mx' => 'Mx',
        ],
        'label' => 'Civilité',
    ])
    ->add('prenom', TextType::class, [
        'constraints' => [
            new NotBlank(['message' => 'Veuillez entrer votre prénom.']),
        ]
    ])
    ->add('nom', TextType::class, [
        'constraints' => [
            new NotBlank(['message' => 'Veuillez entrer votre nom.']),
        ]
    ])
    ->add('email', EmailType::class, [
        'constraints' => [
            new NotBlank(['message' => 'Veuillez entrer une adresse email.']),
            new Email(['message' => 'Veuillez entrer une adresse email valide.']),
        ]
    ])
    ->add('telephone', TextType::class, [
        'constraints' => [
            new NotBlank(['message' => 'Veuillez entrer votre numéro de téléphone.']),
            new Regex([
                'pattern' => '/^[0-9]{10}$/',
                'message' => 'Le numéro doit contenir exactement 10 chiffres.',
            ]),
        ]
    ]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
