<?php
namespace App\Controller;
use App\Entity\Projet;
use App\Entity\ProjetClient;
use App\Entity\ProjetClientCategorie;
use App\Entity\ProjetClientQualite;
use App\Entity\ImageFiles;
use App\Form\ProjetClientType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
class UploadController extends AbstractController
{
    /**
     * @Route("/fileuploadhandler", name="fileuploadhandler")
     */
    public function fileUploadHandler(Request $request)
    {
        $output = array('uploaded' => false);
        // get the file from the request object
        $file = $request->files->get('file');
        $commentaire=$request->get('commentaire');
        $projet_id=$request->get('projetId');
        $fileName = $file->getClientOriginalName();//$file->guessExtension()
        $uploadDir = $this->getParameter('kernel.project_dir') . '/../web/uploads/';
        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }
        if ($file->move($uploadDir, $fileName)) {
            $em = $this->getDoctrine()->getManager();
            $mediaEntity = new ImageFiles();
            $mediaEntity->setNomFichier($fileName);
            $mediaEntity->setCommentaire($commentaire);
            //$mediaEntity->setProjet($em->find("ProjetClient"), $projet_id);
            // sauvegarde
            $em->persist($mediaEntity);

//            $output['uploaded'] = true;
//            $output['fileName'] = $fileName;
        }
//        return new JsonResponse($output);
    }
}