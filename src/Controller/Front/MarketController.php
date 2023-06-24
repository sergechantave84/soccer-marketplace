<?php

namespace App\Controller\Front;

use App\Controller\BaseController;
use App\Entity\Sales;
use App\Form\Handler\SaleHandler;
use App\Form\Type\SaleType;
use App\Repository\PlayersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MarketController
 * @package App\Controller\Front
 */
class MarketController extends BaseController
{
    /**
     * @param Request $request
     * @param PlayersRepository $playersRepository
     *
     * @return Response
     */
    #[Route('/market/', name: 'market', methods: ["GET"])]
    public function market(Request $request, PlayersRepository $playersRepository): Response
    {
        $login = $request->getSession()->get('login');
        $playersToUpSale = $playersRepository->getPlayersForSale($login);
        $playersAvailable = $playersRepository->getPlayersAvailable($login)->getQuery()->getResult();
        $sale = new Sales();
        $form = $this->createForm(SaleType::class, $sale,
            [
                'action' => $this->generateUrl('sale'),
                'attr'   => ['id'=>'form-sale']
            ]
        );

        return $this->render('front/market.html.twig', [
            'playersToUpSale'     => $playersToUpSale,
            'form'                => $form->createView(),
            'nonePlayerAvailable' => count($playersAvailable) > 0,
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return JsonResponse
     */
    #[Route('/market/sale', name: 'sale', methods: ["POST"])]
    public function sale(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $sale = new Sales();
            $form = $this->createForm(SaleType::class, $sale,
                [
                    'action' => $this->generateUrl('sale'),
                    'attr'   => ['id'=>'form-sale']
                ]
            );
            $formHandler = new SaleHandler(
                $form,
                $request,
                $entityManager
            );
            $sale = $formHandler->process();
            if ($sale) {
                return new JsonResponse(
                    [
                        'message' => 'Sale created successfull',
                    ],
                    Response::HTTP_OK
                );
            }
            $data = [
                'message' => 'une erreur s\'est produite',
            ];

            return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse($e, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @return Response
     */
    #[Route('/market/purchase', name: 'purchase', methods: ["POST", "GET"])]
    public function purchase(): Response
    {
        return $this->render('front/purchase/purchase.html.twig');
    }
}
