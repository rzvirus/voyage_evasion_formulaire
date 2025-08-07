<?php

namespace App\Controller;

use App\Entity\HistoriqueConnexion;
use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/espace-admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_espace_admin')]
    public function index(EntityManagerInterface $em): Response
    {
        $connexions = $em->getRepository(HistoriqueConnexion::class)
            ->findBy([], ['dateConnexion' => 'DESC']);
        $messages = $em->getRepository(Message::class)
            ->findBy([], ['dateEnvoi' => 'DESC']);

        return $this->render('admin/espace_admin.html.twig', [
            'connexions' => $connexions,
            'messages' => $messages,
        ]);
    }

    #[Route('/message/{id}/validate', name: 'admin_message_validate', methods: ['POST'])]
    public function validateMessage(Message $message, EntityManagerInterface $em): RedirectResponse
    {
        $message->setStatut('validé');
        $em->flush();
        $this->addFlash('success', 'Message validé avec succès.');
        return $this->redirectToRoute('app_espace_admin');
    }

    #[Route('/message/{id}/refuse', name: 'admin_message_refuse', methods: ['POST'])]
    public function refuseMessage(Message $message, EntityManagerInterface $em): RedirectResponse
    {
        $message->setStatut('refusé');
        $em->flush();
        $this->addFlash('warning', 'Message refusé.');
        return $this->redirectToRoute('app_espace_admin');
    }

    #[Route('/message/{id}/delete', name: 'admin_message_delete', methods: ['POST'])]
    public function deleteMessage(Message $message, EntityManagerInterface $em): RedirectResponse
    {
        $em->remove($message);
        $em->flush();
        $this->addFlash('danger', 'Message supprimé.');
        return $this->redirectToRoute('app_espace_admin');
    }
}
