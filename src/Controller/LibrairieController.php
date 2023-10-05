<?php

namespace App\Controller;

use App\Entity\Librairie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibrairieController extends AbstractController
{
    #[Route('/librairie', name: 'app_Librairie')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $librairies = $doctrine->getRepository(Librairie::class)->findAll();

        return $this->render('librairie/index.html.twig', ['librairies' => $librairies]);

    }


    #[Route('/librairie/{id}', name: 'librairie_show', requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $librairie = $doctrine->getRepository(Librairie::class)->find($id);
        if (!$librairie) {
            throw $this->createNotFoundException('The librairie does not exist');
        }

        $livres = $librairie->getLivres();

        return $this->render('librairie/show.html.twig', ['librairie' => $librairie, 'livres' => $livres]);

    }
}