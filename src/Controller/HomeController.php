<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




class HomeController extends AbstractController



{

function __construct(EntityManagerInterface $em,UserRepository $repo){
 
	$this->repo=$repo;
	$this->em=$em;


}
 /**
     * @Route("/", name="home")
     */
 public function home(){
  return $this->render("platspecifique.html.twig");
 }




 /**
     * @Route("/inscription", name="inscription")
     */


  function show (Request $request,UserPasswordEncoderInterface $encoder)

  {

  $user= new User();

$form=$this->createForm(UserType::class, $user);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()){
  $hash=$encoder->encodePassword($user,$user->getPassword());
  $user->setPassword($hash);
  $this->em->persist($user);
  $this->em->flush();
  return $this->redirectToRoute("security_login");
}


  	return $this->render('inscription.html.twig',[
  		'form'=>$form->createView()]);

  }  


 /**
     * @Route("/login", name="security_login")
     */
  public function login(){
    return $this->render("security.html.twig");
  } 	

}





?>