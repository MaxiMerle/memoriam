<?php

namespace App\Controller;

use App\Entity\ProjetClient;
use App\Entity\ProjetClientBerthelot;
use App\Form\ProjetClientBerthelotType;
use App\Form\ProjetClientType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\FormTypeInterface;


class ProjetClientBerthelotController extends AbstractController
{




    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */

    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {

        $em = $this->getDoctrine()->getRepository(ProjetClientBerthelot::class);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('projet_client_berthelot/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }


    /**
     * @Route("/votre-projet-berthelot", name="nouveau_projet_berthelot")
     * @param Request $request
     * @param $mailer
     * @return RedirectResponse|Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
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

            $message = (new \Swift_Message('NOUVEAU PROJET'))
                ->setFrom('maximerle@gmail.com')
                ->setTo('maximerle@gmail.com')
                ->setBody('Nouveau projet de ' )

            ;

            $mailer->send($message);

            $this->addFlash('success', 'Votre Projet a bien été enregistré ! Merci de votre confiance !');

            return $this->redirectToRoute('nouveau_projet');
        }
        elseif ($form->isSubmitted() && $form->isEmpty()){
            $this->addFlash('error', 'Votre Projet n\'a pu être enregistré ! Merci de recommencer');
            return $this->redirectToRoute('nouveau_projet');

        }

        return $this->render('projet_client_berthelot/index-berthelot.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/berthelot", name="berthelot")
     * @param $request
     * @return Response
     * @throws Exception
     */
    public function projetBerthelot( Request $request)
    {


        // just setup a fresh $task object (remove the dummy data)
        $newProjetBerthelot = new ProjetClientBerthelot();


        $form = $this->createForm(ProjetClientBerthelotType::class, $newProjetBerthelot);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $form->getData();

            // but, the original `$task` variable has also been updated
            $newProjetBerthelot = $form->getData();
            $newProjetBerthelot->setCode(random_int(10000,1000000).rand(300,1000));



            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newProjetBerthelot);
            $entityManager->flush();


            $this->addFlash('success', 'Client bien enregistré ! Merci de bien lui transmettre son code personnel unique');

            return $this->render('projet_client/berthelotShow.html.twig',[
                'infosBerthelot' => $newProjetBerthelot
            ]);
        }


        return $this->render('projet_client/berthelot.html.twig', [
            'formBerthelot' => $form->createView(),
        ]);






        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
