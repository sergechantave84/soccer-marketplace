<?php

namespace App\Form\Type;

use App\Entity\Teams;
use App\Repository\TeamsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PurchaseType extends AbstractType
{
    /**
     * @var User|UserInterface|null
     */
    private User|null|UserInterface $currentSeller;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->currentSeller = $tokenStorage->getToken()->getUser();
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'team',
                EntityType::class,
                [
                    'class'         => Teams::class,
                    'label'         => "Equipes",
                    'expanded'      => false,
                    'multiple'      => false,
                    'required'      => true,
                    'attr'          => [
                        "class" => "form-control",
                    ],
                    'query_builder' => function (TeamsRepository $teamsRepository) {
                        return $teamsRepository->getTeamsWithPlayerForSale($this->currentSeller);
                    },
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
                'data_class' => 'App\Entity\Players',
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
