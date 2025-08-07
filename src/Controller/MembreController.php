<?php

namespace App\Controller;

use App\Entity\HistoriqueConnexion;
use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MembreController extends AbstractController
{
    #[Route('/espace-membre', name: 'app_espace_membre')]
    #[IsGranted('ROLE_USER')] // ✅ Réactivez la protection
    public function index(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $user = $this->getUser();

        // ✅ Vérification supplémentaire (défense en profondeur)
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // 1. Historique de connexion
        $history = new HistoriqueConnexion();
        $history->setUtilisateur($user)
            ->setDateConnexion(new \DateTimeImmutable())
            ->setRoleAuMoment($user->getRoles()[0] ?? 'ROLE_USER');
        
        try {
            $em->persist($history);
            $em->flush();
        } catch (\Exception $e) {
            // ✅ Gérer les erreurs sans casser la page
            $this->addFlash('warning', 'Erreur lors de l\'enregistrement de l\'historique.');
        }

        // 2. Formulaire de message
        $message = new Message();
        $message->setDateEnvoi(new \DateTimeImmutable());
        $message->setStatut('en_attente');

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setAuteur($user);
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('app_espace_membre');
        }

        // 3. Messages de l'utilisateur
        $messages = $em->getRepository(Message::class)
            ->findBy(['auteur' => $user], ['dateEnvoi' => 'DESC']);

        return $this->render('membre/espace_membre.html.twig', [
            'user' => $user,
            'history' => $history,
            'form' => $form->createView(),
            'messages' => $messages,
        ]);
    }
}