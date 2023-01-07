<?php

namespace App\Controller;
use App\Entity\Categorie;
use App\Entity\Bien;
use App\Form\SearchsType;
// use App\Controller\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CritereController extends AbstractController
{
    /**
     * @Route("/critere", name="app_critere")
     */
    public function index(Request $request): Response
    {  
           $search = new Bien();
        $form = $this->createForm(SearchsType::class,);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT p.titre, c.nom
     FROM App:Bien p
     JOIN p.categorie c
     WHERE p.titre LIKE :titre
     AND c.nom LIKE :nom'
            )->setParameter('titre', '%'.$search->getTitre().'%')
            //  ->setParameter('prix', '%'.$search->getPrix().'%')
             ->setParameter('nom','%'. $search->getCategorie().'%');
                
            $products = $query->getResult();
            // dd($form->createView());
            return $this->render('critere/results.html.twig', array(
                'products' => $products,
                'form'=>$form,
            ));
        }   
        // dd($form->createView());
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('critere/index.html.twig', [
            'controller_name' => 'CritereController',
            'categorie'=>$categorie,
            'form'=>$form->createView(),
        ]);
    }
}
