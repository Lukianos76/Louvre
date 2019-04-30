<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ticketDate', DateType::class, [
                'label' => ' ',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepickerTicketDate', 'onkeydown' => "return false"],
                'format' => 'dd-MM-yyyy'

            ])
            ->add('type', ChoiceType::class, [
                'label' => ' ',
                'choices' => $this->getChoices()
            ])
            ->add('tickets', CollectionType::class, [
                'entry_type' => TicketType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ] )
            ->add('email', EmailType::class ,[
                'label' => ' ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Booking::TYPE;
        $output = [];
        foreach ($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
