<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Comment;
use App\Entity\Instrument;
use App\Entity\Note;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Riff;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RiffController extends AbstractController
{
    /**
     * @Route("/", name="riff")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $riffs = $entityManager->getRepository(Riff::class)->findAll();
        return $this->render('riff/index.html.twig', [
            'controller_name' => 'RiffController',"riffs"=>$riffs
        ]);
    }

    /**
     * @Route("/riff/add", name="riff_add")
     */
    public function add(Request $request): Response
    {
        if($request -> isMethod('post')){

        }
        $form = $this->createFormBuilder()->setAction($this
            ->generateUrl('riff_new'))
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('customsongfile', TextType::class)
            ->add('categorie',EntityType::class,['class'=>Categorie::class])
            ->add('instrument',EntityType::class,['class'=>Instrument::class])
            ->getForm();

        return $this->render('riff/add.html.twig', [
            'controller_name' => 'RiffController',
            'form' => $form->createView()
        ]);


    }

    /**
     * @Route("/riff/delete/{id}", name="riff_delete")
     */
    public function delete(EntityManagerInterface $entityManager,Request $request,$id): Response
    {

        $riff = $entityManager->getRepository(Riff::class)->findOneBy(['id'=> $id]);
        $entityManager->remove($riff);
        $entityManager->flush();
        return $this->redirectToRoute('riff');


    }

    /**
     * @Route("/riff/new", name="riff_new")
     */
    public function new(EntityManagerInterface $entityManager, Request $request){

        $user = $this->getUser();
        if($request->isMethod('POST')){

            $data = $request->get('form');

            $categorie = $entityManager->getRepository(Categorie::class)->findOneBy(['id'=>$data['categorie']]);
            $instrument = $entityManager->getRepository(Instrument::class)->findOneBy(['id'=>$data['instrument']]);
            $riff = new Riff();
            $riff->setAuthor($user);
            $riff->setCategorie($categorie);
            $riff->setCustomsongfile($data['customsongfile']);
            $riff->setInstrument($instrument);
            $riff->setDecription($data['description']);
            $riff->setName($data['name']);
            $this->getDoctrine()->getManager()->persist($riff);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('riff');
        }
        #return $this->redirectToRoute('riff',['error' => "Votre commentaire est giga chelou du coup ça marche pas"]);

    }

        /**
     * @Route("/riff/{id}", name="riff_show")
     */
    public function show(EntityManagerInterface $entityManager, $id): Response
    {
        $riff = $entityManager->getRepository(Riff::class)->findOneBy( ['id'=> $id] );
        $notes = $entityManager->getRepository(Note::class)->findBy( ['riff'=> $id] );
        $form = $this->createFormBuilder()->setAction($this
            ->generateUrl('note_new'))
            ->add('commentaire', TextType::class)
            ->add('note', RangeType::class)
            ->getForm();
        //dd($commentaires);
        return $this->render('riff/show.html.twig', [
            'controller_name' => 'RiffController',"riff"=>$riff,"form"=>$form->createView(),"notes"=>$notes
        ]);
    }


}
