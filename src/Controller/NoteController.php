<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Instrument;
use App\Entity\Note;
use App\Entity\Riff;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index(): Response
    {
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }

    /**
     * @Route("/note/new", name="note_new")
     */
    public function new(EntityManagerInterface $entityManager, Request $request){

        $user = $this->getUser();
        if($request->isMethod('POST')){
            $splitted_params =  explode("/",$request->headers->get('referer'));
            $riffid =$splitted_params[count($splitted_params)-1];
            $riff = $entityManager->getRepository(Riff::class)->findOneBy( ['id'=> $riffid] );
            $data = $request->get('form');
            $note = new Note();
            $note->setAuthor($user);
            $note->setRiff($riff);
            $note->setNote($data['note']);
            $note->setCommentaire($data['commentaire']);
            $this->getDoctrine()->getManager()->persist($note);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('riff_show',["id"=>$riffid]);
        }
        #return $this->redirectToRoute('riff',['error' => "Votre commentaire est giga chelou du coup ça marche pas"]);

    }
}
