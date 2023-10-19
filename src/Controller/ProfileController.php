<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/editProfile', name: 'app_editProfile')]
    public function editProfileController(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $oldPassword = $form->get('oldPassword')->getData();

          if ($userPasswordHasher->isPasswordValid($user, $oldPassword))
          {

              $user->setPassword(
                  $userPasswordHasher->hashPassword(
                      $user,
                      $form->get('plainPassword')->getData()
                  ));
              $entityManager->persist($user);
              $entityManager->flush();
              $this->addFlash('success','Dane zostaly zaktualizowane!');
              return $this->redirectToRoute('app_homepage');
          }else {
              $this->addFlash('fail','Podane dane są błędne, spróbuj ponownie.');
              return $this->redirectToRoute('app_editProfile');
          }
        }

        return $this->render('project/editProfileData.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    #[Route('/profile', name: 'app_profile')]
    public function profileController(): Response
    {
        $userFirstName = $this->getUser()->getFirstName();
        $userEmail = $this->getUser()->getEmail();

        return $this->render('project/profileData.html.twig', [
            'firstName' => $userFirstName,
            'email' => $userEmail
        ]);
    }

}
