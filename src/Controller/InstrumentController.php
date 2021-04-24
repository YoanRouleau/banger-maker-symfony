<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Instrument;
use App\Entity\Riff;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstrumentController extends AbstractController
{
    /**
     * @Route("/instrument", name="instrument")
     */
    public function index(): Response
    {
        return $this->render('instrument/index.html.twig', [
            'controller_name' => 'InstrumentController',
        ]);
    }

    /**
     * @Route("/instrument/{id}", name="instrument_show")
     */
    public function show(EntityManagerInterface $entityManager, $id): Response
    {
        $instrument = $entityManager->getRepository(Instrument::class)->findOneBy(['id'=> $id]);
        $riffs = $entityManager->getRepository(Riff::class)->findBy( ['instrument'=> $id ]);
        return $this->render('instrument/show.html.twig', ['controller_name' => 'InstrumentController',"riffs"=>$riffs,"instrument"=>$instrument]);

    }
}
