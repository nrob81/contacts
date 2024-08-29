<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $opt = function (string $placeholder): array {
            return [
                'label' => false,
                'attr' => [
                    'placeholder' => $placeholder,
                ],
            ];
        };

        $builder
            ->add('first_name', null, $opt('Keresztnév'))
            ->add('last_name', null, $opt('Vezetéknév'))
            ->add('phone', TelType::class, $opt('Telefonszám'))
            ->add('email', EmailType::class, $opt('Email cím'))
            ->add('save', SubmitType::class, ['label' => 'Hozzáadás']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
