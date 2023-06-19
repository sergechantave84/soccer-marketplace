<?php

namespace App\Form\Handler;

use App\Entity\Teams;
use App\Utils\Tools;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class TeamHandler
{
    protected $form;
    protected $request;
    protected $entityManager;
    protected $container;
    protected $uploads;
    protected $mailerService;
    private $tokenFile;
    private $templating;

    /**
     * @param Form $form
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        Form $form,
        Request $request,
        EntityManagerInterface $entityManager
    ) {
        $this->form = $form;
        $this->request = $request;
        $this->entityManager = $entityManager;
    }

    /**
     * @return mixed
     */
    public function process(): mixed
    {
        $this->form->handleRequest($this->request);
        $team = $this->form->getData();
        if (!Tools::isNumberDecimal($this->request->get('moneyBalance'))) {
            $this->form->get('moneyBalance')->addError(new FormError('Format Solde d\'argent invalide'));

            return $this->form;
        }
        if ($this->form->isSubmitted()) {
            $team->setOwner(($this->request->getSession()->get('login')));
            $this->entityManager->persist($team);
            $this->entityManager->flush();
        }

        return $team;
    }
}
