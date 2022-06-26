<?php

namespace App\Controller;

use App\Entity\Accueil;
use App\Entity\Alcool;
use App\Entity\Horaires;
use App\Entity\ImageGalerie;
use App\Entity\Plat;
use App\Entity\SectionInfo;
use App\Entity\Soft;
use App\Form\AlcoolType;
use App\Form\GalerieFormType;
use App\Form\HorairesFormType;
use App\Form\InfosFormType;
use App\Form\PlatType;
use App\Form\SoftType;
use App\Repository\AccueilRepository;
use App\Repository\AlcoolRepository;
use App\Repository\HorairesRepository;
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
    public function index(AccueilRepository $ar, SectionInfoRepository $sir, AlcoolRepository $alcoolRepository, SoftRepository $softRepository, PlatRepository $platRepository, ImageGalerieRepository $imageGalerieRepository, HorairesRepository $horairesRepository): Response
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
        $listePlat = $platRepository->findAll();
        $horaires = $horairesRepository->findOneBy(array('id' => 1));

        //------------------------------------


        $tt = new \DateTime();
        $tt = date_add($tt, date_interval_create_from_date_string('2 hours'));
        $today = $tt->format(('H:i:s'));


        //---VERIFICATION OUVERTURE---
        $isClosed = true;
        //------DIMANCHE
        if (date('w') == 0) {
            $dateOuv = $horaires->getDimanche();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getDimancheFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }
        //-------LUNDI
        if (date('w') == 1) {
            $dateOuv = $horaires->getLundi();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getLundiFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }
        //-------MARDI
        if (date('w') == 2) {
            $dateOuv = $horaires->getMardi();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getMardiFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }
        //-------MERCREDI
        if (date('w') == 3) {
            $dateOuv = $horaires->getMercredi();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getMercrediFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }
        //-------JEUDI
        if (date('w') == 4) {
            $dateOuv = $horaires->getJeudi();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getJeudiFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }
        //-------VENDREDI
        if (date('w') == 5) {
            $dateOuv = $horaires->getVendredi();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getVendrediFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }
        //-------SAMEDI
        if (date('w') == 6) {
            $dateOuv = $horaires->getSamedi();
            $dateOuv = $dateOuv->format('H:i:s');
            $dateFerm = $horaires->getSamediFermeture();
            $dateFerm = $dateFerm->format('H:i:s');

            if ($today > $dateOuv && $today < $dateFerm) {
                $isClosed = false;
            }
        }


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
            'listePlat' => $listePlat,
            'horaires' => $horaires,
            'isClosed' => $isClosed,


        ]);
    }



}
