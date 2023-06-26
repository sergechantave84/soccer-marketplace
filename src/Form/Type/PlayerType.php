<?php

namespace App\Form\Type;

use App\Entity\Players;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    "class"       => "form-control",
                    "placeholder" => "nom",
                ],
            ])
            ->add('surname', TextType::class, [
                'attr' => [
                    "class"       => "form-control",
                    "placeholder" => "prénom",
                ],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Players::class,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}
