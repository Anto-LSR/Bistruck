<?php

namespace App\Controller;

use App\Repository\AccueilRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(AccueilRepository $ar): Response
    {
        $accueil = $ar->find(array('id' => '1'));

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'accueil' => $accueil
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
    public function adminAccueil(Request $request, AccueilRepository $ar, EntityManagerInterface $em): Response {
        //Gestion des requêtes POST
        if(!empty($_POST)){
            //On récupère l'entité accueil
            $accueil = $ar->find(array('id' => '1'));
            //On récupère les valeurs du formulaire
            $titre = $_POST["titreAccueil"];
            $description = $_POST["descAccueil"];

            //On applique le style au mot clé Rock & Foulk
            if (str_contains($titre, 'Rock & Foulk')){
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
        $accueilTitre = str_replace("<span id='hero-title'>", "",$accueil->getTitre());
        $accueilTitre = str_replace("</span>", "",$accueilTitre);


        //on rend la vue
        return $this->render('admin/accueil.html.twig', [
            'accueil' => $accueil,
            'accueilTitre' => $accueilTitre
        ]);
    }
}
