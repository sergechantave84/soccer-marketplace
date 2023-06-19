<?php

namespace App\Controller\Front;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

/**
 * Class TeamController
 * @package App\Controller\Front
 */
class TeamController extends BaseController
{
    /**
     * @Route("/home", name="home")
     *
     * @return Response
     * @throws Exception
     */
    public function home(): Response
    {
        try {
            //return $this->render('front/homepage.html.twig', $productManager->dataHomepage());
            return $this->render('front/homepage.html.twig');
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @Route("/", name="host")
     *
     * @return Response
     */
    public function host(): Response
    {
        return $this->redirectToRoute('home');
    }
}
