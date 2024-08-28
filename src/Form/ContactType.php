<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $fields = [
            'first_name' => 'Keresztnév',
            'last_name' => 'Vezetéknév',
            'phone' => 'Telefonszám',
            'email' => 'Email cím'
        ];

        foreach ($fields as $fieldName => $label) {
            $builder->add($fieldName, null, [
                'label' => false, 
                'attr' => [
                    'placeholder'=>$label
                ]
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
