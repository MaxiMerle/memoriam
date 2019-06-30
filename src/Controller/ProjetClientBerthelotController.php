<?php

namespace App\Controller;

use App\Entity\ProjetClient;
use App\Entity\ProjetClientBerthelot;
use App\Form\ProjetClientBerthelotType;
use App\Form\ProjetClientType;
use App\Form\SearchProjetType;
use App\Entity\ImageFiles;
use App\Repository\ProjetClientBerthelotRepository;
use App\Repository\ProjetClientRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use phpDocumentor\Reflection\Types\String_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\FormTypeInterface;


/**
 * @method findProjetIdByCodeClient(ProjetClientRepository $code)
 */
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
     * @param ProjetClientRepository $code
     * @return Response
     */

    public function searchProjetClient(Request $request, ProjetClientRepository $code){

        $form = $this->createForm(SearchProjetType::class);


        if($form->handleRequest($request)->isSubmitted() && $form->isValid()){

            $data =  $form->getData();

            $code = $data->getCode();
            $nomClient = $data->getNomClient();


            //--------VERIFIER SI INFOS MATCHENT AVEC BDD ------//




            //--------  RECUPERER ID DU PROJET DEJA CREE ------//

                $id_client = $this->repository->findProjetIdByCodeClient($code, $nomClient);

                if ($id_client == null ){
                    $this->addFlash('danger', 'Vos identifiants sont incorrets - Veuillez réessayer ou nous contacter en cas de problème ');

                    return $this->render('projet_client/search.html.twig',[
                        'search_form' => $form->createView(),
                    ]);

                }else{
                    //-------- REDIRIGER CLIENT VERS FORMULAIRE PERSO AVEC ID DU PROJET ------//
                    return $this->redirectToRoute('edit-projet',[
                        'code' =>  $id_client[0]['code'],

                    ]);

                }
        }

        return $this->render('projet_client/search.html.twig',[
            'search_form' => $form->createView(),
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


    }




    //---------------  AJOUT NOUVEAU CLIENT BERTHELOT --------------//

    /**
     * @Route("/berthelot", name="berthelot")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function projetBerthelot(Request $request)
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



            $data = $form->getData();
            $email = $data->getEmailClient();
            $Repo = $entityManager->getRepository(ProjetClient::class);

            if ($Repo->findOneBy(['emailClient' => $email])){
                $form->addError(new FormError('Cet email est déja utilisé'));
                return $this->render('projet_client/berthelot.html.twig', [
                    'formBerthelot' => $form->createView(),
                ]);

            }else{

                $entityManager->flush();

                $this->addFlash('success', 'Client bien enregistré ! Merci de bien lui transmettre son code personnel unique');

                return $this->render('projet_client/berthelotShow.html.twig',[
                    'infosBerthelot' => $newProjetBerthelot
                ]);
            }


        }
        return $this->render('projet_client/berthelot.html.twig', [
            'formBerthelot' => $form->createView(),
        ]);

    }


    //--------------- FORMULAIRE PROJET BERTHELOT DEJA PAYÉ --------------//


    /**
     * @Route("/edit-projet/{code}", name="edit-projet")
     * @param ProjetClient $projet
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */

    public function editProjet(ProjetClient $projet, Request $request, \Swift_Mailer $mailer){

        $form = $this->createForm(ProjetClientType::class, $projet);

        $form->handleRequest($request);

        $mediaEntity = new ImageFiles();

        $data = $form->getData();



        $categorie = $projet->getCategorie();

        $session = $request->getSession();
        $session->set(' idProjetClient', $projet->getId());
        $session->set(' categorie', $projet->getCategorie());
        if($session->has('nbPhotos') != true) {
            $session->set('nbPhotos', 0);
            $session->set('nbVideos', 0);
        }

        if ($form->isSubmitted() && $form->isValid()){

            $messageClient = (new \Swift_Message('Confirmation projet film hommage - In Memoriae'))
                ->setFrom('contact@in-memoriae.fr')
                ->setTo($projet->getEmailClient())
                ->setBody($this->renderView(
                    'contact/confirmation-admin.html.twig',
                    array('email' => $projet->getEmailClient() )
                ),
                    'text/html' )

            ;
            date_default_timezone_set('Europe/Paris');
            $date = date('d/m/Y'.' à '.'H:i', time());


            $messageVendeur = (new \Swift_Message('Projet CLient validé'))
                ->setFrom('contact@in-memoriae.fr')
                ->setTo($projet->getEmailVendeurBerthelot())
                ->setBody($this->renderView(
                    'contact/confirmation-vendeurs.html.twig',
                    array(
                        'email' => $projet->getEmailClient(),
                        'nomClient' => $projet->getNomClient(),
                        'prenomnomClient' => $projet->getPrenomClient(),
                        'date' => $date
                        )
                ),
                    'text/html' )

            ;
            $messageMonteurs = (new \Swift_Message('Nouveau projet In Memoriam'))
                ->setFrom('contact@in-memoriae.fr')
                ->setTo('maximerle@gmail.com')
                ->setBody($this->renderView(
                    'contact/confirmation-monteurs.html.twig',
                    array(
                        'email' => $projet->getEmailClient(),
                        'idProjet' => $projet->getId(),
                        'nomClient' => $projet->getNomClient(),
                        'prenomnomClient' => $projet->getPrenomClient(),
                        'date' => $date
                    )
                ),
                    'text/html' )

            ;

            $mailer->send($messageClient);
            $mailer->send($messageVendeur);
            $mailer->send($messageMonteurs);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->persist($mediaEntity);
            $entityManager->flush();

            $this->addFlash('success', 'Votre Projet a bien été enregistré ! Merci de votre confiance ! ');

            return $this->render('projet_client_berthelot/confirmation-projet.html.twig',[
                'infos' => $projet
            ]);

        }
        return $this->render('projet_client_berthelot/index-berthelot.html.twig',[
            'edit-projet' => $projet,
            'categorie' => $categorie,
            'form' => $form->createView()
        ]);
    }

}
