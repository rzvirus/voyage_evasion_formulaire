<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d’utilisateur',
                'attr' => ['placeholder' => 'Entrez votre nom d’utilisateur'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un nom d’utilisateur']),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom d’utilisateur doit faire au moins {{ limit }} caractères.',
                        'max' => 180,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr' => ['placeholder' => 'Entrez votre adresse e-mail'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une adresse e-mail']),
                    new Length(['max' => 180]),
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false, // ne mape pas directement dans l’entité
                'attr' => ['placeholder' => 'Choisissez un mot de passe sécurisé'],
                'constraints' => [
                    new NotBlank(['message' => 'Merci de saisir un mot de passe']),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
