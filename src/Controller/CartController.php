<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier/cart", name="panier")
     */
    public function index(SessionInterface $session,PlatRepository $repo): Response
    {
    	$panier=$session->get('panier',[]);
    	$panierwithdata=[];

    	foreach ($panier as $id => $quantity) {
    		$panierwithdata[]=[
              'plat'=>$repo->find($id),
              'quantite'=>$quantity

    		];
    	}
    	$total=0;
    

    	foreach ($panierwithdata as $item ) {
    		$totalitems=$item['plat']->getPrix()*$item['quantite'];
    		$total+=$totalitems;

    	}
    	

        return $this->render('cart.html.twig', ['items'=>$panierwithdata,'total'=>$total]);
    }




    /**
     * @Route("/panier/add/{id}", name="cart")
     */
     public function add($id , SessionInterface $session,Request $request){
     	$session =$request->getSession();
     	$panier=$session->get('panier',[]);
     	if(!empty($panier[$id])){
     		$panier[$id] ++;

     	}
     	else{
            $panier[$id]=1;
     	}
     	

     	$session->set('panier',$panier);

     


      return $this->redirectToRoute('panier');

     }





     /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */

     public function remove($id, SessionInterface $session){
     	$panier =$session->get('panier',[]);
     	if(!(empty($panier[$id]))){
          unset($panier[$id]);

     	}
     	$session->set('panier',$panier);

     	return $this->redirectToRoute("panier");

     }




}
