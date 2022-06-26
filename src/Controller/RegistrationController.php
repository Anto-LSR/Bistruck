<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register_verif")
     */
    public function verifRegister(): Response
    {
        if (!empty($_POST)) {
            $pw = $_POST["pw"];
            return $this->redirectToRoute('app_register', ['pw' => $pw]);
        }

        return $this->render('registration/verif.html.twig');
    }


    /**
     * @Route("/inscription/{pw}", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, $pw): Response
    {
        if($pw !== "hugovieillot"){
            return $this->redirectToRoute("app_register_verif");
        }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_ADMIN']);

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash("success", "L'utilisateur a bien été créé");

            return $this->redirectToRoute('app_register', ['pw' => $pw]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
