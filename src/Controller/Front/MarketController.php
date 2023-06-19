<?php

namespace App\Controller\Front;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

/**
 * Class MarketController
 * @package App\Controller\Front
 */
class MarketController extends BaseController
{
    /**
     * @Route("/sale", name="sale")
     *
     * @return Response
     * @throws Exception
     */
    public function sale(): Response
    {
        try {
            return $this->render('front/sale/list.html.twig');
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @Route("/purchase", name="purchase")
     *
     * @return Response
     */
    public function purchase(): Response
    {
        return $this->render('front/purchase/list.html.twig');
    }
}
