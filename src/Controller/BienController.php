<?php

namespace App\Controller;
use App\Entity\Bien;
Use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class BienController extends AbstractController
{
    
    /**
     * @Route("/bien", name="app_bien")
     */
    
    // protected $mailer;
    public function index(Mailer $mailer): Response
    {
      
        return $this->render('bien/index.html.twig', [
            
            'controller_name' => 'BienController',
            'mailer'=>  $mailer->sendEmail(),
        ]);
    }

   }
