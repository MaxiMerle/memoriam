<?php
/**
 * Created by PhpStorm.
 * User: maximemerle
 * Date: 13/05/2019
 * Time: 14:11
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends  AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function homePageController()
    {


        return $this->render('home.html.twig', [

        ]);
    }


    /**
     * @Route("/mentions-legales", name="mentions-legales")
     */
    public function mentionLegalesController()
    {


        return $this->render('mentions_legales.html.twig', [

        ]);
    }


    /**
     * @Route("/conditions-generales-de-vente", name="cgv")
     */
    public function cgvController()
    {


        return $this->render('cgv.html.twig', [

        ]);
    }

    /**
     * @Route("/qui-sommes-nous", name="qui-sommes-nous")
     */
    public function aboutUsController()
    {


        return $this->render('about.html.twig', [

        ]);
    }


}
