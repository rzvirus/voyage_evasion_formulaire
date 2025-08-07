<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/alaune', name: 'alaune')]
    public function alaune(): Response
    {
        return $this->render('pages/alaune.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

    #[Route('/quisommesnous', name: 'about')]
    public function about(): Response
    {
        return $this->render('pages/about.html.twig');
    }

    #[Route('/connexion', name: 'login')]
    public function login(): Response
    {
        return $this->render('pages/login.html.twig');
    }

    #[Route('/inscription', name: 'register')]
    public function register(): Response
    {
        return $this->render('pages/register.html.twig');
    }

    #[Route('/destinations', name: 'destinations')]
    public function destinations(): Response
    {
        return $this->render('pages/destinations.html.twig');
    }

    // Continents
    #[Route('/europe', name: 'europe')]
    public function europe(): Response
    {
        return $this->render('pages/europe.html.twig');
    }

    #[Route('/asie', name: 'asie')]
    public function asie(): Response
    {
        return $this->render('pages/asie.html.twig');
    }

    #[Route('/amerique', name: 'amerique')]
    public function amerique(): Response
    {
        return $this->render('pages/amerique.html.twig');
    }

    #[Route('/afrique', name: 'afrique')]
    public function afrique(): Response
    {
        return $this->render('pages/afrique.html.twig');
    }

    #[Route('/iles', name: 'iles')]
    public function iles(): Response
    {
        return $this->render('pages/iles.html.twig');
    }

    // Pays (fichiers tous dans templates/pays/)
    #[Route('/france', name: 'france')]
    public function france(): Response
    {
        return $this->render('pays/france.html.twig');
    }

    #[Route('/espagne', name: 'espagne')]
    public function espagne(): Response
    {
        return $this->render('pays/espagne.html.twig');
    }

    #[Route('/italie', name: 'italie')]
    public function italie(): Response
    {
        return $this->render('pays/italie.html.twig');
    }

    #[Route('/japon', name: 'japon')]
    public function japon(): Response
    {
        return $this->render('pays/japon.html.twig');
    }

    #[Route('/thailande', name: 'thailande')]
    public function thailande(): Response
    {
        return $this->render('pays/thailande.html.twig');
    }

    #[Route('/vietnam', name: 'vietnam')]
    public function vietnam(): Response
    {
        return $this->render('pays/vietnam.html.twig');
    }

    #[Route('/usa', name: 'usa')]
    public function usa(): Response
    {
        return $this->render('pays/usa.html.twig');
    }

    #[Route('/bresil', name: 'bresil')]
    public function bresil(): Response
    {
        return $this->render('pays/bresil.html.twig');
    }

    #[Route('/argentine', name: 'argentine')]
    public function argentine(): Response
    {
        return $this->render('pays/argentine.html.twig');
    }

    #[Route('/maroc', name: 'maroc')]
    public function maroc(): Response
    {
        return $this->render('pays/maroc.html.twig');
    }

    #[Route('/afriquedusud', name: 'afriquedusud')]
    public function afriqueDuSud(): Response
    {
        return $this->render('pays/afriquedusud.html.twig');
    }

    #[Route('/egypte', name: 'egypte')]
    public function egypte(): Response
    {
        return $this->render('pays/egypte.html.twig');
    }

    #[Route('/tahiti', name: 'tahiti')]
    public function tahiti(): Response
    {
        return $this->render('pays/tahiti.html.twig');
    }

    #[Route('/maldives', name: 'maldives')]
    public function maldives(): Response
    {
        return $this->render('pays/maldives.html.twig');
    }

    #[Route('/reunion', name: 'reunion')]
    public function reunion(): Response
    {
        return $this->render('pays/reunion.html.twig');
    }
}
