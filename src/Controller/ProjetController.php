<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\ProjetFiles;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjetController extends AbstractController
{
    /**
     * @Route("/projets", name="projet")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $DateMort = "01-09-2015";
        $DateNaissance = "01-09-2065";

        $product = new Projet();
        $product->setDossier('DE468G');
        $product->setNomDefunt('Durand');
        $product->setPrenomDefunt('Denis');
        $product->setDateNaissance(\DateTime::createFromFormat('d-m-Y', $DateNaissance));
        $product->setDateMort(\DateTime::createFromFormat('d-m-Y', $DateMort));
        $product->setImageFile(VichImageType::class);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }


//    /**
//     * @Route("/admin/projet/{id}", name="projet_show")
//     */
//    public function show($id)
//    {
//        $projet = $this->getDoctrine()
//            ->getRepository(Projet::class)
//            ->find($id);
//
//
//        return $this->render('projet/show.html.twig', ['projet' => $projet]);
//
//        // or render a template
//        // in the template, print things with {{ product.name }}
//        // return $this->render('product/show.html.twig', ['product' => $product]);
//    }
//
//    /**
//     * @Route("/admin/projets", name="projets")
//     */
//    public function showProjets()
//    {
//        $projet = $this->getDoctrine()
//            ->getRepository(Projet::class)
//            ->findAll();
//
//
//
//        return $this->render('projet/projets.html.twig', ['projets' => $projet]);
//
//        // or render a template
//        // in the template, print things with {{ product.name }}
//        // return $this->render('product/show.html.twig', ['product' => $product]);
//    }
//
//    /**
//     * @Route("/admin/projets/{id}", name="projet_delete")
//     */
//
//    public function supprimerProjet($id)
//    {
//
//        $repository = $this->getDoctrine()->getRepository(Projet::class);
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $projet = $repository->find($id);
//
//        $entityManager->remove($projet);
//        $entityManager->flush();
//
//        return $this->redirectToRoute('projets');
//    }


//    /**
//     * @Route("/ajouter-un-projet", name="nouveau_projet_old")
//     * @param Request $request
//     * @return Response
//     */
//    public function ajoutProjet(Request $request)
//    {
//        $projet = new Projet();
//
//        $images = new ProjetFiles();
//        $projet->addProjetFile($images);
//
//        $form = $this->createForm(ProjetType::class, $projet);
//
//        $form->handleRequest($request);
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//
//
//
//            $em->persist($projet);
//            $em->persist($images);
//            $em->flush();
//        }else{
//                $this->redirectToRoute('contact');
//        }
//
//        return $this->render('votre-projet.html.twig', array(
//            'projet' => $projet,
//            'form' => $form->createView(),
//        ));
//    }




}
