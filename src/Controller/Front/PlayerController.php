<?php

namespace App\Controller\Front;

use App\Controller\BaseController;
use App\Entity\Players;
use App\Form\Handler\PlayerHandler;
use App\Form\Type\PlayerType;
use App\Repository\PlayersRepository;
use App\Repository\SalesRepository;
use App\Utils\SerializerStandard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class PlayerController
 * @package App\Controller\Front
 */
class PlayerController extends BaseController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     * @throws Exception
     */
    #[Route('/create-player/{teamId}', name: 'create_player', methods: ["POST", "GET"])]
    public function createPlayer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $player = new Players();
        $form = $this->createForm(PlayerType::class, $player,
            [
                'action' => $this->generateUrl('create_player', [
                    'teamId' => $request->get('teamId')
                ]),
                'attr' => ['id'=>'form-player']
            ]
        );
        if (Request::METHOD_POST == $request->getMethod()) {
            $formHandler = new PlayerHandler(
                $form,
                $request,
                $entityManager
            );
            $team = $formHandler->process();
            if ($team) {
                return $this->redirectToRoute('get_team', [
                    'id' => $team->getId(),
                ]);
            }
        }

        return $this->render('front/team/form/form_player.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param PlayersRepository $playerRepository
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    #[Route('/get-player/{id}', name: 'get_player', methods: ["GET"])]
    public function getPlayer(Request $request, PlayersRepository $playerRepository, SalesRepository $salesRepository): JsonResponse
    {
        $serializer = SerializerStandard::getJsonSerializer();
        $player = $playerRepository->find($request->get('id'));
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

        return new JsonResponse(
            $serializer->normalize(
                $player,
                'json',
                SerializerStandard::setContext(['player_read'])
            ),
            Response::HTTP_OK
        );
    }
}
