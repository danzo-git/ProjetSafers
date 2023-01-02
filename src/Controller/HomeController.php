<?php

namespace App\Controller;
use App\Entity\Bien;
use App\Entity\Categorie;
use App\Form\SearchType;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\QueryBuilder;
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    protected $BienRepository;
    private $session;
    public function __construct(BienRepository $BienRepository,SessionInterface $session)
    {
       $this->BienRepository=$BienRepository;
       $this->session = $session;
    }
    public function index(Request $request): Response
    {
        


        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        
        $cart = $this->session->get('cart');
        $safers = $this->getDoctrine()->getRepository(Bien::class)->findAll();
        // var_dump($safers);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'HomeController',"safers" => $safers,
            "find5Biens"=>$this->BienRepository->find5Biens(),
            "find2Biens"=> $this->BienRepository->find2Biens(),
            'session'=>$cart,
            'categorie'=>$categorie,
           
            // 'biens'=>$biens,
            // 'form' => $form->createView(),
        ]);
    }

/**
     * @Route("/wish/{id}", name="app_home")
     */
    public function addAction($id)
    {
        //    dd($id); 
        $safers = $this->getDoctrine()->getRepository(Bien::class)->findBy(['id'=>$id]);
         
        $cart = $this->session->get('cart', []);
        // if (array_key_exists($id ,$cart)){
           
        // }
       
        // Si le bien existe déjà dans le panier, on le supprime
    if (isset($cart[$id])) {
        unset($cart[$id]);
       $message= $this->addFlash('success', 'Le bien a été supprimé des favoris');
    }
     else {
            $cart[$id] = $safers[0];
            $message=$this->addFlash('success', 'Le bien a été mis en favoris');
        }
       $this->session->set('cart', $cart); 
       
      
      

      return $this->redirectToRoute('index',[
        'session'=>$cart,
        'message'=>$message,
      ]);
        
    }

    /**
     * @Route("/remove/{id}", name="app_home")
     */
    // public function remove($id)
    // {
    //     $cart = $this->get('session')->remove($id);
    //     $message = $this->addFlash('success', 'Le bien a été supprimé des favoris');
    
    //     return $this->redirectToRoute('index', [
    //         'session' => $cart,
    //         'message' => $message,
    //     ]);
    // }
/**
     * @Route("/categorie/{id}", name="app_home")
     */
    public function categorie($id){

        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findBy(['id'=>$id]);
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
        ->select('u')
        ->from('App:Bien', 'u')
        ->where('u.categorie ='.$categorie[0]->getId())
        ->getQuery();
        $categories = $query->getResult();
        //  dd($categories[0]);
        // $safers = $this->getDoctrine()->getRepository(Bien::class)->findBy(['id'=>$categorie[0]->getId()]);
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('categorie/index.html.twig',[
           'controller_name'=> "HomeController",
             'categories'=>$categories ,
                 'categorie'=>$categorie    
        ]);
    }


   
   

       
    
    }