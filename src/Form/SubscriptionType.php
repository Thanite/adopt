<?php

namespace App\Form;

use App\DTO\SubscriptionDTO;
use App\Entity\Subscription;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_id', EntityType::class, [
                'class' =>User::class,
                'choice_label' => 'id'
            ])
            ->add('title', EntityType::class, [
                'class' => Subscription::class,
                'choice_label' => 'title'
            ])
            ->add ('card_number', TextType::class, [
                'label' => "N° de carte"
            ])
            ->add ('cvv', TextType::class, [
                'label' => "CVV"
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubscriptionDTO::class,
        ]);
    }
}
