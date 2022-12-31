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
        // $form = $this->createForm(SearchType::class);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $search = $form->getData()['search'];

        //     $results = $this->getDoctrine()
        //         ->getRepository(Bien::class)
        //         ->findBySearch($search);
        //         return $this->render('search/results.html.twig', [
        //             'results' => $results,
        //         ]);
        // }
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
        
        if (isset($cart[$id])) {
            $cart[$id] = $safers[0];
        } else {
            $cart[$id] = $safers[0];
        }
       $this->session->set('cart', $cart); 
       
      
       
      return $this->redirectToRoute('index',[
        'session'=>$cart,
      ]);
        
    }
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