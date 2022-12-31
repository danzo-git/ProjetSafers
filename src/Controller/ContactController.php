<?php

namespace App\Controller;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(): Response
    {
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'categorie'=>$categorie,
        ]);
    }
}
