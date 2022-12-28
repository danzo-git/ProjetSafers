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
use App\Form\UserType; 
class BienController extends AbstractController
{
    
    /**
     * @Route("/bien", name="app_bien")
     */
    
    // protected $mailer;
    public function index( Request $request,Mailer $mailer): Response
    {
       
        $form = $this->createForm(UserType::class);
        $params = $request->query->all(); 
       // $string = implode(', ', $params);
        // dd($string);
        $safers = $this->getDoctrine()->getRepository(Bien::class)->findBy(['id'=>$params[1]]);
        $form = $this->createForm(UserType::class);
    $form->handleRequest($request);
   
    foreach ($safers as $entity) {
        $id = $entity->getId();
        // Faites quelque chose avec l'identifiant ici
    }
    
    // dd($entity->getPostal());

     if ($form->isSubmitted() && $form->isValid()) {
       
        $data = $form->getData();
        // dd($data);
        $mailer->sendEmail(
        "testutoriel@gmail.com",
       $data["email"] ,
        "nouveau message"
        ,"info sur la safer",
        "Mail/index.html.twig ",
        [   'id'=>$id,
            'name'=> $data['name'],
            'email'=>$data['email'],
            'image'=>$entity->getImage(),
            'surface'=>$entity->getSurface(),
            'code_ville'=>$entity->getPostal(),
            'titre'=>$entity->getTitre(),
            'disponibilite'=>$entity->isStatus(),
            'ville'=>$entity->getVille(),

        ],
        
    );
        return $this->render('bien/index.html.twig', [
            
            'controller_name' => 'BienController',
            //'mailer'=>  $mailer->sendEmail(),
            'safer'=>$safers,
            'form' => $form->createView(),
        ]);
       
    }
    return $this->render('bien/index.html.twig', [
            
        'controller_name' => 'BienController',
        //'mailer'=>  $mailer->sendEmail(),
        'safer'=>$safers,
        'form' => $form->createView(),
    ]);

    }
/**
     * @Route("/bien/form", name="app_bien")
     */
//     public function myAction(Request $request,Mailer $mailer)
// {
    
//         $id = $data['id'];
        
       
//     }
//     dd('ok');
//     return $this->render('bien/index.html.twig', [
//         'form' => $form->createView(),
//     ]);

    
//    }
    
}