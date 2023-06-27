<?php

namespace App\Controller\Front;

use App\Controller\BaseController;
use App\Entity\Players;
use App\Entity\Sales;
use App\Form\Handler\PurchaseHandler;
use App\Form\Handler\SaleHandler;
use App\Form\Type\PurchaseType;
use App\Form\Type\SaleType;
use App\Manager\MarketManager;
use App\Repository\PlayersRepository;
use App\Repository\SalesRepository;
use App\Repository\TeamsRepository;
use App\Utils\SerializerStandard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class MarketController
 * @package App\Controller\Front
 */
class MarketController extends BaseController
{
    /**
     * @param Request $request
     * @param MarketManager $marketManager
     *
     * @return Response
     */
    #[Route('/market/', name: 'market', methods: ["GET"])]
    public function market(Request $request, MarketManager $marketManager): Response
    {
        $login = $request->getSession()->get('login');
        if (is_null($login)) {
            return new Response(
                'Vous devez être connecté pour accéder à ce menu',
                Response::HTTP_BAD_REQUEST
            );
        }
        $data = $marketManager->dataMarketPages($login);
        $formSale = $this->createForm(SaleType::class, null,
            [
                'action' => $this->generateUrl('sale'),
                'attr'   => ['id'=>'form-sale']
            ]
        );
        $formPurchase = $this->createForm(PurchaseType::class, null,
            [
                'action' => $this->generateUrl('purchase'),
                'attr'   => ['id'=>'form-purchase']
            ]
        );

        return $this->render('front/market.html.twig', [
            'playersToUpSale'     => $data['playersToUpSale'],
            'playersToPurchase'   => $data['playersToPurchase'],
            'myPlayers'           => $data['myPlayers'],
            'formSale'            => $formSale->createView(),
            'formPurchase'        => $formPurchase->createView(),
            'nonePlayerAvailable' => count($data['playersAvailable']) > 0,
            'buyerTeam'           => $data['buyerTeam']
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
                'message' => 'An error has occurred',
            ];

            return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse($e, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @param PlayersRepository $playersRepository
     * @param EntityManagerInterface $entityManager
     *
     * @return JsonResponse
     */
    #[Route('/market/purchase', name: 'purchase', methods: ["POST"])]
    public function purchase(Request $request,
        PlayersRepository $playersRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        try {
            $login = $request->getSession()->get('login');
            if (is_null($login)) {
                return new JsonResponse(
                    'Vous devez être connecté pour accéder à ce menu',
                    Response::HTTP_BAD_REQUEST
                );
            }
            $playerJSON = json_decode($request->getContent());
            $teamSolde = $playerJSON->teamSolde;
            if ($teamSolde < $playerJSON->playerSale) {
                return new JsonResponse(
                    [
                        'message' => 'Vous ne disposez pas de solde suffisant pour acheter ce joueur. Votre solde actuel est de '
                                     . $teamSolde . $this->getParameter('euro_symbol'),
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }
            $handler = new PurchaseHandler($playerJSON, $playersRepository, $entityManager, $login);
            $player = $handler->process();
            if ($player) {
                return new JsonResponse(
                    [
                        'player'  => $player,
                        'message' => 'Player successfully sold',
                    ],
                    Response::HTTP_OK
                );
            }
            $data = [
                'message' => 'An error has occurred',
            ];

            return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse($e, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @param PlayersRepository $playersRepository
     *
     * @return JsonResponse
     */
    #[Route('/market/players-by-team', name: 'players_by_team', methods: ["GET"])]
    public function getPlayersToPurchase(
        Request $request,
        PlayersRepository $playersRepository,
        SalesRepository $salesRepository
    ): JsonResponse {
        try {
            $teamId = $request->get('teamId');
            $players = $playersRepository->getPlayersToPurchase(
                $request->get('login'),
                (is_null($teamId) || $teamId === $this->getParameter('valueOptionALL'))
                    ?
                    null
                    :
                    (int)$teamId
            );
            $serializer = SerializerStandard::getJsonSerializer();
            foreach ($players as $player) {
                if ($player instanceof Players) {
                    $sales = $salesRepository->findBy(['player' => $player->getId()]);
                    $player->setSalesJson(
                        $serializer->normalize(
                            $sales,
                            'json',
                            SerializerStandard::setContext(['sale_read'])
                        )
                    );
                }
            }

            return new JsonResponse(
                $serializer->normalize(
                    $players,
                    'json',
                    SerializerStandard::setContext(['player_read'])
                ),
                Response::HTTP_OK
            );
        } catch (\Exception | ExceptionInterface $e) {
            return new JsonResponse($e, Response::HTTP_BAD_REQUEST);
        }
    }
}
