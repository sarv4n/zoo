<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route(
        path: '/shipping-price-calculator',
        name: 'shipping_price_calculator`',
    )]
    public function index(): Response
    {
        return $this->render('/shipping-price-calculator.html.twig');
    }
}