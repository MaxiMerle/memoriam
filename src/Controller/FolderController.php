<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Form\FolderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class FolderController extends AbstractController
{
    protected $entityManager;
    protected $repository;

    // Set up all necessary variable
    protected function initialise()
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        $this->repository = $this->entityManager->getRepository(Folder::class);
    }



    /**
     * @Route("/fichiers", name="nouveau_fichier")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        // Set up required variables
        $this->initialise();

        // New object
        $folder = new Folder();

        // Build the form
        $form = $this->createForm(FolderType::class, $folder);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            // Check form data is valid
            if ($form->isValid())
            {
                // Save data to database
                $this->entityManager->persist($folder);
                $this->entityManager->flush();



                // Redirect to view page
                return $this->redirectToRoute('nouveau_projet', array(
                    'id'	=>	$folder->getId(),
                ));
            }
        }
        // If we are here it means that either
        //	- request is GET (user has just landed on the page and has not filled the form)
        //	- request is POST (form has invalid data)
        return $this->render(
            'fichiers.html.twig',
            array (
                'form'	=>	$form->createView(),
            )
        );
    }

    public function editAction(Request $request, Folder $folder)
    {
        // Set up required variables
        $this->initialise();

        // Build the form
        $form = $this->get('form.factory')->create(FolderType::class, $folder);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            // Check form data is valid
            if ($form->isValid())
            {
                // Save data to database
                $this->entityManager->persist($folder);
                $this->entityManager->flush();


                // Redirect to view page
                return $this->redirectToRoute('nouveau_fichier', array(
                    'id'	=>	$folder->getId(),
                ));
            }
        }
        // If we are here it means that either
        //	- request is GET (user has just landed on the page and has not filled the form)
        //	- request is POST (form has invalid data)
        return $this->render(
            'fichiers.html.twig',
            array (
                'form'		=>	$form->createView(),
                'folder'	=>	$folder
            )
        );
    }
}