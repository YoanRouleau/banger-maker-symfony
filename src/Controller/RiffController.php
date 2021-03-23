<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RiffController extends AbstractController
{
    /**
     * @Route("/riff", name="riff")
     */
    public function index(): Response
    {
        return $this->render('riff/index.html.twig', [
            'controller_name' => 'RiffController',
        ]);
    }
}
