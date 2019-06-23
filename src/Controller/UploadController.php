<?php
namespace App\Controller;
use App\Entity\ProjetClient;
use App\Entity\ProjetClientCategorie;
use App\Entity\ProjetClientQualite;
use App\Entity\ImageFiles;
use App\Form\ProjetClientType;
use App\Repository\ProjetClientRepository;
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
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Session\Session;
class UploadController extends AbstractController
{
    /**
     * @Route("/fileuploadhandler", name="fileuploadhandler")
     * @param Request $request
     * @return JsonResponse
     */
    public function fileUploadHandler(Request $request)
    {
        $output = array('uploaded' => false);
        // get the file from the request object
        $file = $request->files->get('file');
        $commentaire=$request->get('commentaire');
        $session = $request->getSession();


        $projet_id=$session->get(' idProjetClient');
        $request->get('projetId');
        $fileName = $file->getClientOriginalName();//$file->guessExtension()


        $uploadDir = $this->getParameter('kernel.project_dir') . '/./public/uploads/'.$projet_id;
        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }
        if ($file->move($uploadDir, $fileName)) {
            $em = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(ProjetClient::class);
            $projetClient=$repository->find($projet_id);
            $mediaEntity = new ImageFiles();
            $mediaEntity->setNomFichier($fileName);
            $mediaEntity->setCommentaire($commentaire);
            $mediaEntity->setProjet($projetClient);
            // sauvegarde
            $em->persist($mediaEntity);
            $em->flush();
//            $output['uploaded'] = true;
//            $output['fileName'] = $fileName;
        }
        return new JsonResponse($output);
    }

    /**
     * @Route("/filedownloadhandler/{idProjetClient}", name="telecharger")
     * @param $idProjetClient
     * @return Response
     */
    public function zipDownloadDocumentsAction($idProjetClient)
    {
        $files = [];
        $finder = new  Finder();
        foreach($finder->in($this->getParameter('kernel.project_dir') . '/public/uploads/'.$idProjetClient) AS $file) {
            array_push($files, $file->getRealpath());
        }
        $zip = new \ZipArchive();
        $zipName = 'Projet'.$idProjetClient.'.zip';
        $zip->open($zipName,  \ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFromString(basename($file),  file_get_contents($file));
        }
        $zip->close();
        $response = new Response(file_get_contents($zipName));
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $zipName . '"');
        $response->headers->set('Content-length', filesize($zipName));
        @unlink($zipName);
        return $response;
    }
}