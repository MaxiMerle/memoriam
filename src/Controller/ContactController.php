<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


               if ($form->isSubmitted() && $form->isValid()) {

                   $contactFormData = $form->getData();

                   $message = (new \Swift_Message('MESSAGE CLIENT MÉMORIAM'))
                           ->setFrom($contactFormData['email'])
                           ->setTo('maximerle@gmail.com')
                           ->setBody(
                               '<html>' .
                               ' <body>' .
                                '<h1>' .'  NOM : ' . $contactFormData['name'] .'</h1>' .
                               '  EMAIL : ' .  $contactFormData['email'] .
                               '  MESSAGE : ' .  $contactFormData['message'] .

                               ' </body>' .
                               '</html>', 'text/html'
                           );

                   $mailer->send($message);
                   $this->addFlash('success', 'Votre message a bien été envoyé ! Merci');
      return $this->redirectToRoute('contact');
                   // do something interesting here
               }

        return $this->render('contact.html.twig', [
            'controller_name' => 'ContactController',
            'contact_form' => $form->createView(),
        ]);
    }
}
