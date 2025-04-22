<?php

namespace App\Controller;

use App\Entity\Requete;
use App\Form\RequeteType;
use DateTime;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
final class RequeteController extends AbstractController{
    #[Route(name: 'app_requete_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $requetes = $entityManager
            ->getRepository(Requete::class)
            ->findAll();

        return $this->render('requete/index.html.twig', [
            'requetes' => $requetes,
        ]);
    }

    #[Route('/new', name: 'app_requete_new', methods: ['GET', 'POST'])]
    public function new(
            Request $request, 
            EntityManagerInterface $entityManager,
            MailerInterface $mailer
    ): Response
    {
        $requete = new Requete();
        $form = $this->createForm(RequeteType::class, $requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $requete->setCreatedAt(new DateTime()); 

            $entityManager->persist($requete);
            $entityManager->flush();

            $email = (new Email())
                ->from('hello@example.com')
                ->to('you@example.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($requete->getTitle())
                ->text('Sending emails is fun again!')
                ->html('<p>Bonjour Aude !!!</p>');



            $mailer->send($email);

            return $this->redirectToRoute('app_requete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('requete/new.html.twig', [
            'requete' => $requete,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_requete_show', methods: ['GET'])]
    public function show(Requete $requete): Response
    {
        return $this->render('requete/show.html.twig', [
            'requete' => $requete,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_requete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Requete $requete, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RequeteType::class, $requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_requete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('requete/edit.html.twig', [
            'requete' => $requete,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_requete_delete', methods: ['POST'])]
    public function delete(
            Request $request, 
            Requete $requete, 
            EntityManagerInterface $entityManager
    ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$requete->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($requete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_requete_index', [], Response::HTTP_SEE_OTHER);
    }
}
