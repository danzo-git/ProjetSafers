<?php

namespace App\Controller;
use App\Entity\Categorie;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType; 
use DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request): Response
    {
        
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        $date = new DateTime();
        $dateFormatee = $date->format('d/m/Y');
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
           
           
             $em=$this->getDoctrine()->getManager();
            $contact=new Contact();
            $contact->setName($data->getName());
            $contact->setEmail($data->getEmail());
            $contact->setContact($data->getContact());
            $contact->setDescription($data->getDescription());
            $contact->setDate( $dateFormatee);
            $em->persist($contact);
            $em->flush();
            $message=$this->addFlash('success', 'Le message a ete envoyé avec success');
            // Traitez les données du formulaire ici...
        }
       $message="";
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'categorie'=>$categorie,
            'form' => $form->createView(),
            'message'=>$message,
            
        ]);
    }


//     public function Message(Request $request)
// {
//     $form = $this->createForm(ContactType::class);

//     $form->handleRequest($request);
//     dd($form);

//     // if ($form->isSubmitted() && $form->isValid()) {
//         $data = $form->getData();
//         dd($data);
//         // Traitez les données du formulaire ici...
//     // }

//     return $this->redirectToRoute( 'contact',
      
//     [
//          'controller_name'=>'ContactController',
//         'form' => $form->createView(),
//     ]
//     ) 
//     ;
// }
}
