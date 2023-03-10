<?php

namespace App\Controller;
use App\Entity\Bien;
use App\Entity\Categorie;
use App\Entity\Favoris;
Use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
// use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Config\Framework\RequestConfig;
use Doctrine\ORM\EntityManager;
use App\Form\UserType; 
use DateTime;
class BienController extends AbstractController
{
    
    /**
     * @Route("/bien", name="app_bien")
     */
    
    // protected $mailer;
    public function index( Request $request,Mailer $mailer): Response
    {
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $form = $this->createForm(UserType::class);
        $params = $request->query->all(); 
       // $string = implode(', ', $params);
        // dd($string);
        
        $safers = $this->getDoctrine()->getRepository(Bien::class)->findBy(['id'=>$params[1]]);
        $form = $this->createForm(UserType::class);
    $form->handleRequest($request);
   
    foreach ($safers as $entity) {
        $id = $entity->getId();
        // dd($entity);
        // Faites quelque chose avec l'identifiant ici
    }

 
 $categories = $this->getDoctrine()->getRepository(Categorie::class)->findBy(['id'=>$entity->getCategorie()->getId()]);
        
    foreach ($categories as $categorie) {
        $idc = $categorie->getId();
        // Faites quelque chose avec l'identifiant ici
    }
   

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
            'categorie'=>$categorie->getNom(),
            'categorie_slug'=>$categorie->getSlug(),
            'descriptif'=>$entity->getDescriptif(),
        ],
        
    );
     $em = $this->getDoctrine()->getManager();

     // Cr??ation de l'entit?? favoris
     $date = new DateTime();
     $dateFormatee = $date->format('d/m/Y');
     $favoris = new Favoris();
     $favoris->setNomClient($data['name']);
     $favoris->setEmail($data['email']);
     $favoris->setSafer($id);
     $favoris->setTitreSafer($entity->getTitre());
     $favoris->setCategorie($categorie->getNom());
    $favoris->setDate($dateFormatee);
    
    // // Enregistrement de l'entit?? en base de donn??es
     $em->persist($favoris);
     $em->flush();
     $message=$this->addFlash('success', 'Le mail a ete envoy?? avec success');

        return $this->render('bien/index.html.twig', [
            
            'controller_name' => 'BienController',
            //'mailer'=>  $mailer->sendEmail(),
            'safer'=>$safers,
            'form' => $form->createView(),
            'categorie'=>$categorie,
            'message'=>$message,
        ]);
       
    }
    $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
    return $this->render('bien/index.html.twig', [
            
        'controller_name' => 'BienController',
        //'mailer'=>  $mailer->sendEmail(),
        'safer'=>$safers,
        'form' => $form->createView(),
        'categorie'=>$categorie,
        
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