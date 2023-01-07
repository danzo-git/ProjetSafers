<?php

namespace App\Controller;
use App\Form\EnvoiType;
use App\Entity\Categorie;
Use App\Service\Mailer;
use App\Entity\Favoris;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class EnvoiListeController extends AbstractController
{
    private $session;
public function __construct(SessionInterface $session)
{
   
   $this->session = $session;
}
    /**
     * @Route("/envoi/liste", name="app_envoi_liste")
     */
   
    
        public function index(Request $request,Mailer $mailer): Response
        { 
            $cart = $this->session->get('cart', []);
           
        // if (array_key_exists($id ,$cart)){
           
        // }
       
        // Si le bien existe déjà dans le panier, on le supprime
   
            $form = $this->createForm(EnvoiType::class);
            $form->handleRequest($request);
            $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
          
           
            if ($form->isSubmitted() && $form->isValid()) {
                $name=$form->get('name')->getData();
                $email=$form->get('email')->getData();
                
                // Traitez les données du formulaire ici (enregistrement en base de données, envoi d'email, etc.)
             
                

            //     $mailer->sendEmail(
            //      "testutoriel@gmail.com",
            //             $email ,
            //     "nouveau message"
            //     ,"info sur la safer",
            //     "Mail/index.html.twig ",
            //     [   
            //         'name'=> $name,
            //         'email'=>$email,
            //         'cart'=>$cart,
            //         'categorie'=>$categorie
            //     ],
                
            //  );
            $em = $this->getDoctrine()->getManager();
             foreach ($cart as $car) {
                foreach ($categorie as $categori) {
                    if ($categori->getId() == $car->getCategorie()->getId()) {
                        $nomCat = $categori->getNom();
                       
                    }
                    
                }
                 
        
             // Création de l'entité favoris
             $date = new DateTime();
             $dateFormatee = $date->format('d/m/Y');
             $favoris = new Favoris();
             $favoris->setNomClient($name);
             $favoris->setEmail($email);
             $favoris->setSafer($car->getId());
             $favoris->setTitreSafer($car->getTitre());
             $favoris->setCategorie($nomCat);
            $favoris->setDate($dateFormatee);
            
            // Enregistrement de l'entité en base de données
             $em->persist($favoris);
             $em->flush();
                
            }
   
       
          

    
        
      
       


          
             $message=$this->addFlash('success', 'Le mail a ete envoyé avec success');
                // Redirigez vers une autre page ou affichez un message de succès
                return $this->redirectToRoute('envoi');
            }
    
            return $this->render('envoi_liste/index.html.twig', [
                'controller_name' => 'EnvoiListeController',
                'form' => $form->createView(),
                'categorie'=>$categorie,
                'cart'=>$cart,
            ]);
       
    }
    

    
    
      


    
}
