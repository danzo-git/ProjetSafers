<?php

namespace App\Controller;
use App\Entity\Bien;
Use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Config\Framework\RequestConfig;

class BienController extends AbstractController
{
    
    /**
     * @Route("/bien", name="app_bien")
     */
    
    // protected $mailer;
    public function index(Mailer $mailer, Request $request): Response
    {
        
        $params = $request->query->all(); 
       // $string = implode(', ', $params);
        // dd($string);
        $safers = $this->getDoctrine()->getRepository(Bien::class)->findBy(['id'=>$params[1]]);
        // dd($safers);
        return $this->render('bien/index.html.twig', [
            
            'controller_name' => 'BienController',
            //'mailer'=>  $mailer->sendEmail(),
            'safer'=>$safers
        ]);
    }

   }
   