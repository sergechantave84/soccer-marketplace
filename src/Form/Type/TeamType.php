<?php

namespace App\Form\Type;

use App\Entity\Teams;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PriceComparison
 * @package App\Form\Type
 */
class TeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                TextType::class,
                [
                    'label' => "Nom: ",
                    'attr'  => [
                        "class"       => "form-control",
                        "placeholder" => "nom",
                ],
            ])
            ->add('country',
                TextType::class,
                [
                    'label' => "Pays: ",
                    'attr'  => [
                        "class"       => "form-control",
                        "placeholder" => "pays",
                ],
            ])
            ->add(
                'moneyBalance',
                NumberType::class,
                [
                    'label' => "Solde d'argent: ",
                    'attr'  => [
                        "class"       => "form-control",
                        "placeholder" => "Solde d'argent",
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Teams::class,
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
