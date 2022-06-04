<?php

namespace App\Controller;

use App\Entity\Alcool;
use App\Entity\ImageGalerie;
use App\Entity\Plat;
use App\Entity\SectionInfo;
use App\Entity\Soft;
use App\Form\AlcoolType;
use App\Form\GalerieFormType;
use App\Form\InfosFormType;
use App\Form\PlatType;
use App\Form\SoftType;
use App\Repository\AccueilRepository;
use App\Repository\AlcoolRepository;
use App\Repository\ImageGalerieRepository;
use App\Repository\PlatRepository;
use App\Repository\SectionInfoRepository;
use App\Repository\SoftRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\String\Slugger\SluggerInterface;
use Vich\UploaderBundle\Handler\DownloadHandler;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(AccueilRepository $ar, SectionInfoRepository $sir, AlcoolRepository $alcoolRepository, SoftRepository $softRepository, PlatRepository $platRepository, ImageGalerieRepository $imageGalerieRepository): Response
    {
        $accueil = $ar->find(array('id' => '1'));
        $infos = $sir->find(array('id' => '1'));

        $listeBiere = $alcoolRepository->findBy(array('typeBoisson' => '1'));
        $listeVin = $alcoolRepository->findBy(array('typeBoisson' => '2'));
        $listeSpiritueux = $alcoolRepository->findBy(array('typeBoisson' => '3'));
        $listeCidre = $alcoolRepository->findBy(array('typeBoisson' => '4'));
        $listeSoda = $softRepository->findBy(array('typeBoisson' => '5'));
        $listeJdf = $softRepository->findBy(array('typeBoisson' => '6'));
        $listeAutreSoft = $softRepository->findBy(array('typeBoisson' => '7'));
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'accueil' => $accueil,
            'infos' => $infos,
            'listeBiere' => $listeBiere,
            'listeVin' => $listeVin,
            'listeSpiritueux' => $listeSpiritueux,
            'listeCidre' => $listeCidre,
            'listeSoda' => $listeSoda,
            'listeJdf' => $listeJdf,
            'listeAutreSoft' => $listeAutreSoft,
            'listeImages' => $imageGalerieRepository->findAll(),


        ]);
    }

    /**
     * @Route("/rfadmin", name="app_adminPanel")
     */
    public function adminIndex(): Response
    {
        //TODO        GERER CONNEXION ADMIN
        return $this->redirectToRoute('app_adminPanel_accueil');
    }


    /**
     * @Route("/rfadmin/accueil", name="app_adminPanel_accueil")
     */
    public function adminAccueil(Request $request, AccueilRepository $ar, EntityManagerInterface $em, SectionInfoRepository $sir): Response
    {
        //Gestion des requêtes POST
        if (!empty($_POST)) {
            //On récupère l'entité accueil
            $accueil = $ar->find(array('id' => '1'));
            //On récupère les valeurs du formulaire
            $titre = $_POST["titreAccueil"];
            $description = $_POST["descAccueil"];

            //On applique le style au mot clé Rock & Foulk
            if (str_contains($titre, 'Rock & Foulk')) {
                $titleArray = explode("Rock & Foulk", $titre);
                $titleArray[0] .= "<span id='hero-title'>Rock & Foulk</span>";
                $titre = implode($titleArray);
            }
            //on hydrate les attributs d'accueil
            $accueil->setTitre($titre);
            $accueil->setDescription($description);
            //on update et flush
            $em->persist($accueil);
            $em->flush();
        }
        //On enlève les balises HTML à afficher dans le form
        $accueil = $ar->find(array('id' => '1'));
        $accueilTitre = str_replace("<span id='hero-title'>", "", $accueil->getTitre());
        $accueilTitre = str_replace("</span>", "", $accueilTitre);


        //on rend la vue
        return $this->render('admin/accueil.html.twig', [
            'accueil' => $accueil,
            'accueilTitre' => $accueilTitre
        ]);
    }

    /**
     * @Route("/rfadmin/infos", name="app_adminPanel_infos")
     */
    public function adminInfos(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, SectionInfoRepository $sir): Response
    {
        $infos = $sir->find(array('id' => '1'));
        $updateInfosForm = $this->createForm(InfosFormType::class, $infos);
        $updateInfosForm->handleRequest($request);

        if ($updateInfosForm->isSubmitted() && $updateInfosForm->isValid()) {
            $image = $updateInfosForm->get('image')->getData();
            if ($image) {
                //SUPPRESSION ANCIENNE IMAGE
                $this->deleteInfoImage($infos);
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('images'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $infos->setLienImage($newFilename);
            }

        }
        $em->persist($infos);
        $em->flush();
        return $this->render('admin/infos.html.twig', [
            "infosForm" => $updateInfosForm->createView(),
            "infos" => $infos,
        ]);
    }


    /**
     * @Route("/rfadmin/carte", name="app_adminPanel_carte")
     */
    public function adminCarte(Request $request, AlcoolRepository $alcoolRepository, SoftRepository $softRepository, PlatRepository $platRepository, EntityManagerInterface $em)
    {
        $alcoolPanelOpen = false;
        $softPanelOpen = false;
        $platPanelOpen = false;


        //---------INITIALISATION DU FORMULAIRE----------
        $alcool = new Alcool();
        $soft = new Soft();
        $plat = new Plat();

        $alcoolForm = $this->createForm(AlcoolType::class, $alcool);
        $alcoolForm->handleRequest($request);

        $softForm = $this->createForm(SoftType::class, $soft);
        $softForm->handleRequest($request);

        $platForm = $this->createForm(PlatType::class, $plat);
        $platForm->handleRequest($request);


        //--------GESTION DES FORMULAIRES----------
        if ($alcoolForm->isSubmitted() && $alcoolForm->isValid()) {
            $em->persist($alcool);
            $em->flush();
            $alcoolPanelOpen = true;
            return $this->redirectToRoute('app_adminPanel_carte', ['panel' => 'alcool']);
        }

        if ($softForm->isSubmitted() && $softForm->isValid()) {
            $em->persist($soft);
            $em->flush();
            $softPanelOpen = true;

            return $this->redirectToRoute('app_adminPanel_carte', ['panel' => 'soft']);
        }

        if ($platForm->isSubmitted() && $platForm->isValid()) {
            $em->persist($plat);
            $em->flush();
            $platPanelOpen = true;
            return $this->redirectToRoute('app_adminPanel_carte', ['panel' => 'plat']);
        }

        return $this->render('admin/carte.html.twig', [
            'listeAlcools' => $alcoolRepository->findAll(),
            'listeSofts' => $softRepository->findAll(),
            'listePlats' => $platRepository->findAll(),

            'alcoolForm' => $alcoolForm->createView(),
            'softForm' => $softForm->createView(),
            'platForm' => $platForm->createView(),
            'alcoolPanelOpen' => $alcoolPanelOpen,
            'softPanelOpen' => $softPanelOpen,
            'platPanelOpen' => $platPanelOpen

        ]);
    }

    public function deleteInfoImage(SectionInfo $info)
    {
        $fileName = $info->getLienImage();
        $fileSystem = new Filesystem();
        $fileSystem->remove(['symlink', $this->getParameter('images'), $fileName]);
    }

    /**
     * @Route("/rfadmin/carte/deleteAlcool/{id}", name="app_adminPanel_deleteAlcool")
     */
    public function deleteAlcool($id, EntityManagerInterface $em, AlcoolRepository $ar): Response
    {
        $alcool = $ar->find(array('id' => $id));
        $em->remove($alcool);
        $em->flush();
        return $this->redirectToRoute('app_adminPanel_carte');
    }

    /**
     * @Route("/rfadmin/carte/deleteSoft/{id}", name="app_adminPanel_deleteSoft")
     */
    public function deleteSoft($id, EntityManagerInterface $em, SoftRepository $softRepository): Response
    {
        $soft = $softRepository->find(array('id' => $id));
        $em->remove($soft);
        $em->flush();
        return $this->redirectToRoute('app_adminPanel_carte');
    }

    /**
     * @Route("/rfadmin/carte/deletePlat/{id}", name="app_adminPanel_deletePlat")
     */
    public function deletePlat($id, EntityManagerInterface $em, PlatRepository $platRepository): Response
    {
        $plat = $platRepository->find(array('id' => $id));
        $em->remove($plat);
        $em->flush();
        return $this->redirectToRoute('app_adminPanel_carte');
    }

    /**
     * @Route("/rfadmin/galerie", name="app_adminPanel_galerie")
     */
    public function adminGalerie(Request $request, SluggerInterface $slugger, EntityManagerInterface $em, ImageGalerieRepository $imageGalerieRepository): Response
    {
        $image = new ImageGalerie();
        $galerieForm = $this->createForm(GalerieFormType::class, $image);
        $galerieForm->handleRequest($request);


        if ($galerieForm->isSubmitted() && $galerieForm->isValid()) {
            $imageUploaded = $galerieForm->get('image')->getData();
            if ($imageUploaded) {

                $originalFilename = pathinfo($imageUploaded->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageUploaded->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageUploaded->move(
                        $this->getParameter('galerie'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $image->setLienImage($newFilename);
            }

            $em->persist($image);
            $em->flush();
        }


        return $this->render('/admin/galerie.html.twig', [
            'galerieForm' => $galerieForm->createView(),
            'listeImages' => $imageGalerieRepository->findAll(),
        ]);
    }
}
