<?php

namespace App\Form\Handler;

use App\Entity\Teams;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class PlayerHandler
{
    protected Form $form;
    protected Request $request;
    protected EntityManagerInterface $entityManager;

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
     * @return Teams|null
     */
    public function process(): ?Teams
    {
        $this->form->handleRequest($this->request);
        $player = $this->form->getData();
        $team = $this->entityManager->getRepository(Teams::class)->find($this->request->get('teamId'));
        if ($team instanceof Teams) {
            if ($this->form->isSubmitted()) {
                $team->addPlayers($player);
                $this->entityManager->flush();
            }

            return $team;
        }

        return null;
    }
}
