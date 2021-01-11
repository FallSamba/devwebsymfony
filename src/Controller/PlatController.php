<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Plat;
use App\Form\ContactType;
use App\Form\PlatType;
use App\Form\PlatsearchType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlatController extends AbstractController
{

public function __construct(EntityManagerInterface $em,PlatRepository $repo){
	$this->em =$em;
	$this->repo=$repo;


}








    /**
     * @Route("/admin/create", name="plat")
     */
    public function create(Request $request)
    {
    $Plat = new Plat();
    $form =$this->createForm(PlatType::class,$Plat);
    $form->HandleRequest($request);
    if($form->isSubmitted() && $form->isValid()){

           if($Plat->getPicture() !== null){
        $file =$form->get('picture')->getData();


        $fileName =uniqid().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans le quel le fichier va etre charger
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $Plat->setPicture($fileName);
           












        }

     

    	$this->em->persist($Plat);
    	$this->em->flush();


    }
    return $this->render('plat.html.twig',['form'=>$form->createView()]);

        
    }





    /**
     * @Route("/admin/allplat", name="allplat")
     */
     public function all_articles(){

     	$data=$this->repo->findAll();

     	return $this->render('allplat.html.twig',['data'=>$data]);

     }

    /**
     * @Route("/delete/{id}", name="deleteplat", methods={"POST","GET"})
     */
     public function remove_plat(Plat $Plat){
        $this->em->remove($Plat);
        $this->em->flush();

        return $this->redirectToRoute("allplat");
      
     }
    /**
     * @Route("/update/{id}", name="updateplat", methods={"POST","GET"})
     */
    public function updateplat(Plat $Plat ,request $Request){
        $form = $this->createForm(PlatType::class ,$Plat);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute("allplat");
        }
        return $this->render('edit.html.twig',['form'=>$form->createView()]);

    }









    /**
     * @Route("/plats", name="plats_home")
     */
      public function plat_home(Request $request){
       $Contact = new Contact();
        $form =$this->createForm(ContactType::class, $Contact );
        $form->HandleRequest($request);

       




        $data=$this->repo->findAll();
      	return $this->render('platspecifique.html.twig',['data'=>$data,'form'=>$form->createView()]);



      }













    /**
     * @Route("/admin/allplat{id}", name="plat_index")
     */
      public function index(Plat $plat){
      $data = $this->repo->find($plat);
      return $this->render('platspecique.html.twig',['data'=>$data]);


      }

    /**
     * @Route("/admin/edit{id}", name="plat_index")
     */

    public function edit(Plat $plat,Request $request){
    	$form=$this->createForm(PlatType::class,$plat);

    	if($form->isSubmitted() && $form->isValid()){
    		$this->em->flush();
         
    	}
    	return $this->render('edit.html.twig',['form'=>$form->createView()]);

    }










    /**
     * @Route("/admin/allplat{id}", name="delete")
     */

         public function delete(Plat $plat){
         	$this->em->remove($plat);
         	$this->em->flush();
         	return $this->redirectToRoute('allplat');

         }








  


}
