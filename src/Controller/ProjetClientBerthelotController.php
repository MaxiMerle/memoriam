<?php

namespace App\Controller;

use App\Entity\ProjetClient;
use App\Entity\ProjetClientBerthelot;
use App\Form\ProjetClientBerthelotType;
use App\Form\ProjetClientType;
use App\Form\SearchProjetType;
use App\Repository\ProjetClientBerthelotRepository;
use App\Repository\ProjetClientRepository;
use Doctrine\Common\Persistence\ObjectManager;
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

    /*
     * @var
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ProjetClientRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    //--------------- VERIFICATION CLIENT BERTHELOT --------------//

    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @param ProjetClientRepository $ProjetClientRepository
     * @return Response
     */

    public function searchProjetClient(Request $request, ProjetClientRepository $ProjetClientRepository){

        $form = $this->createForm(SearchProjetType::class);

        if($form->handleRequest($request)->isSubmitted() && $form->isValid()){

            //--------VERIFIER SI INFOS MATCHENT AVEC BDD ------//




            //--------  RECUPERER ID DU PROJET DEJA CREE ------//


//         $idProjet = $this->getDoctrine()->getManager()->getRepository('id');



            $this->addFlash('success', 'VOUS ETES BIEN IDENTIFIÉ ! VOTRE PROJET COMMENCE ICI');

            //-------- REDIRIGER CLIENT VERS FORMULAIRE PERSO AVEC ID DU PROJET ------//
            return $this->redirectToRoute('edit-projet',[
//                'id' => $idProjet
            ]);
        }
        return $this->render('projet_client/search.html.twig',[
            'search_form' => $form->createView(),
        ]);
    }






    //--------------- FORMULAIRE PROJET BERTHELOT DEJA PAYÉ --------------//

    /**
     * @Route("/edit-projet/{id}", name="edit-projet")
     * @param ProjetClient $projet
     * @param Request $request
     * @return Response
     */

    public function editProjet(ProjetClient $projet, Request $request){

        $form = $this->createForm(ProjetClientType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();

            $this->addFlash('success', 'Votre Projet a bien été enregistré ! Merci de votre confiance ! ');


        }
        return $this->render('projet_client_berthelot/index-berthelot.html.twig',[
            'edit-projet' => $projet,
            'form' => $form->createView()
        ]);
    }







    //--------------- FORMULAIRE LOGIN VENDEURS BERTHELOT --------------//

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

        return $this->redirectToRoute('berthelot');
    }



//
////--------------- FORMULAIRE PROJET BERTHELOT DEJA PAYÉ --------------//
//
//    /**
//     * @Route("/votre-projet-berthelot", name="nouveau_projet_berthelot")
//     * @param Request $request
//     * @param $mailer
//     * @return RedirectResponse|Response
//     */
//    public function index(Request $request, \Swift_Mailer $mailer)
//    {
//        // just setup a fresh $task object (remove the dummy data)
//        $newProjet = new ProjetClient();
//
//        $form = $this->createForm(ProjetClientType::class, $newProjet);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $form->getData();
//
//            $newProjet = $form->getData();
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($newProjet);
//            $entityManager->flush();
//
//            $message = (new \Swift_Message('NOUVEAU PROJET'))
//                ->setFrom('maximerle@gmail.com')
//                ->setTo('maximerle@gmail.com')
//                ->setBody('Nouveau projet de ' )
//            ;
//
//            $mailer->send($message);
//
//            $this->addFlash('success', 'Votre Projet a bien été enregistré ! Merci de votre confiance !');
//
//            return $this->redirectToRoute('nouveau_projet');
//        }
//        elseif ($form->isSubmitted() && $form->isEmpty()){
//            $this->addFlash('error', 'Votre Projet n\'a pu être enregistré ! Merci de recommencer');
//            return $this->redirectToRoute('nouveau_projet');
//
//        }
//
//        return $this->render('projet_client_berthelot/index-berthelot.html.twig', [
//            'form' => $form->createView(),
//        ]);
//    }



    //---------------  AJOUT NOUVEAU CLIENT BERTHELOT --------------//

    /**
     * @Route("/berthelot", name="berthelot")
     * @param $request
     * @return Response
     * @throws Exception
     */
    public function projetBerthelot( Request $request)
    {

        $newProjetBerthelot = new ProjetClient();

        $form = $this->createForm(ProjetClientBerthelotType::class, $newProjetBerthelot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form->getData();

            $newProjetBerthelot = $form->getData();
            $newProjetBerthelot->setCode(random_int(10000,1000000).rand(300,1000));

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

    }
}
