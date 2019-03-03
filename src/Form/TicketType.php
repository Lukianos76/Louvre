<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays :',
                'choice_translation_locale' => 'fr',
                'preferred_choices' => [
                    'FR']
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Date de naissance :',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepickerBirthDate'],
                'format' => 'dd-MM-yyyy'
            ])
            ->add('reduction', CheckboxType::class, [
                'label' => 'Tarif réduit',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
