<?php

namespace App\Form\Type;

use App\Entity\Players;
use App\Entity\Teams;
use App\Repository\PlayersRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductUserRepository;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Session\Session;
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
                    'attr' => [
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

    /**
     * @return string
     */
    private function labelMinPrice()
    {
        return $this->translator
            ->trans('price_comparison.min_price', [], 'label');
    }
}
