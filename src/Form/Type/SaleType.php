<?php

namespace App\Form\Type;

use App\Entity\Players;
use App\Repository\PlayersRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\RequestStack;

class SaleType extends AbstractType
{
    private string $owner;

    public function __construct(RequestStack $requestStack)
    {
        $this->owner = $requestStack->getCurrentRequest()->getSession()->get('login');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'player',
                EntityType::class,
                [
                    'class'         => Players::class,
                    'label'         => 'Joueur',
                    'choice_label'  => function ($player) {
                        return $player->getName() . ' ' . $player->getSurName();
                    },
                    'expanded'      => false,
                    'multiple'      => false,
                    'required'      => true,
                    'attr'          => [
                        "class" => "form-control",
                    ],
                    'query_builder' => function (PlayersRepository $playersRepository) {
                        return $playersRepository->getPlayersAvailable($this->owner);
                    },
                ]
            )
            ->add(
                'amount',
                NumberType::class,
                [
                    'label' => "Montant : ",
                    'attr'  => [
                        "class"       => "form-control",
                        "placeholder" => "Montant",
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
                'data_class' => 'App\Entity\Sales',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
