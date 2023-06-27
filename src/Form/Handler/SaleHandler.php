<?php

namespace App\Form\Handler;

use App\Entity\Players;
use App\Entity\Sales;
use App\Entity\Teams;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class SaleHandler
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
     * @return mixed
     */
    public function process(): mixed
    {
        $this->form->handleRequest($this->request);
        $sale = $this->form->getData();
        if ($this->form->isSubmitted()) {
            if ($sale instanceof Sales) {
                $sale->getPlayer()->setUpForSale(true);
            }
            $this->entityManager->persist($sale);
            $this->entityManager->flush();
        }

        return $sale;
    }
}
