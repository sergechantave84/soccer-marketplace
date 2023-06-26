<?php

namespace App\Form\Type;

use App\Entity\Players;
use App\Entity\Teams;
use App\Repository\TeamsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PurchaseType extends AbstractType
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
                'team',
                EntityType::class,
                [
                    'class'         => Teams::class,
                    'label'         => "Equipes",
                    'choice_label'  => 'name',
                    'expanded'      => false,
                    'multiple'      => false,
                    'required'      => true,
                    'attr'          => [
                        "class" => "form-control",
                    ],
                    'query_builder' => function (TeamsRepository $teamsRepository) {
                        return $teamsRepository->getTeamsWithPlayerForSale($this->owner);
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
                //'data_class' => Players::class,
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
