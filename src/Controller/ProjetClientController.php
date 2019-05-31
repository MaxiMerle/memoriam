<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\ProjetClient;
use App\Entity\ProjetClientCategorie;
use App\Form\ProjetClientType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjetClientController extends AbstractController
{
    /**
     * @Route("/votre-projet", name="nouveau_projet")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $newProjet = new ProjetClient();


        $form = $this->createForm(ProjetClientType::class, $newProjet);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            // but, the original `$task` variable has also been updated
            $newProjet = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($newProjet);
             $entityManager->flush();

            return $this->redirectToRoute('nouveau_projet');
        }

        return $this->render('projet_client/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/admin/projet-clients/{id}", name="projetClient_show")
     */
    public function show($id)
    {
        $projet = $this->getDoctrine()
            ->getRepository(ProjetClient::class)
            ->find($id);


        return $this->render('projet/show.html.twig', ['projet' => $projet]);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }



    /**
     * @Route("/admin/projets-clients", name="projetsClients")
     */
    public function showProjets()
    {
        $projet = $this->getDoctrine()
            ->getRepository(ProjetClient::class)
            ->findAll();



        return $this->render('projet/projets.html.twig', ['projetsClients' => $projet]);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    private function getChoices()
    {
        $choix = ProjetClientCategorie::class;
        $outpout = [];
        foreach ($choix as $k => $v){
            $outpout[$v] = $k;
        }
        return $choix;
    }

    /**
     * @Route("/admin/projets/{id}", name="projet_delete")
     */

    public function supprimerProjet($id)
    {

        $repository = $this->getDoctrine()->getRepository(ProjetClient::class);
        $entityManager = $this->getDoctrine()->getManager();

        $projet = $repository->find($id);

        $entityManager->remove($projet);
        $entityManager->flush();

        return $this->redirectToRoute('projetsClients');
   }


}
