<?php

namespace App\Controller\Front;

use App\Controller\BaseController;
use App\Entity\Teams;
use App\Form\Handler\TeamHandler;
use App\Form\Type\TeamType;
use App\Repository\TeamsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Exception;

/**
 * Class TeamController
 * @package App\Controller\Front
 */
class TeamController extends BaseController
{
    /**
     * @param TeamsRepository $teamsRepository
     *
     * @return Response
     * @throws Exception
     */
    #[Route('/home', name: 'home', methods: ["POST", "GET"])]
    public function home(TeamsRepository $teamsRepository): Response
    {
        try {
            return $this->render('front/homepage.html.twig',
                [
                    'teams' => $teamsRepository->findAll(),
                ]
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return Response
     */
    #[Route('/', name: 'host', methods: ["GET"])]
    public function host(): Response
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     * @throws Exception
     */
    #[Route('/create-team', name: 'create_team', methods: ["POST", "GET"])]
    public function createTeam(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Teams();
        $form = $this->createForm(TeamType::class, $team,
            [
                'action' => $this->generateUrl('create_team'),
                'attr' => ['id'=>'form-team']
            ]
        );
        if (Request::METHOD_POST == $request->getMethod()) {
            $formHandler = new TeamHandler(
                $form,
                $request,
                $entityManager
            );
            $team = $formHandler->process();
            if ($team instanceof Teams) {
                return $this->redirectToRoute('get_team', [
                    'id' => $team->getId(),
                ]);
            }
        }

        return $this->render('front/team/form/form_team.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param TeamsRepository $teamsRepository
     *
     * @return Response
     * @throws Exception
     */
    #[Route('/get-team/{id}', name: 'get_team', methods: ["GET"])]
    public function getTeam(Request $request, TeamsRepository $teamsRepository): Response
    {
        return $this->render('front/team/team.html.twig',
            [
                'team' => $teamsRepository->find($request->get('id')),
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    #[Route('/set-email', name: 'set_email', methods: ["POST"])]
    public function setEmail(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());
        $request->getSession()->set('login', $data->login);
        $data = [
            'email' => $request->getSession()->get('login')
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    #[Route('/clear-email', name: 'clear_email')]
    public function clearEmail(Request $request): Response
    {
        $request->getSession()->set('login', null);

        return $this->redirectToRoute('home');
    }
}
