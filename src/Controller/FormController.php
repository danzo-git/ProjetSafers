<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType; 
class FormController extends AbstractController
{
    /**
     * @Route("/bien", name="app_form")
     */
    // public function index(): Response
    // {
    //     $form = $this->createForm(UserType::class);
    //     return $this->render('bien/index.html.twig', [
    //         'controller_name' => 'FormController',
    //         'form' => $form->createView(),
    //     ]);
    // }
}
