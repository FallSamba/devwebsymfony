<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
private $username ;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $name;

    /**
     * @ORM\Column(name="email" ,type="string", length=255,unique=true)
     *@Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\Length(min="8",minMessage="votre mot de passe doit avoir {{ limit }}caracteres")
     *@Assert\EqualTo(propertyPath="confirm_password")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\Regex(pattern="/^[0-9]*$/", message="number_only")
     *@Assert\Length(min="9",max=9,minMessage="le numero doit etre egale a{{ limit }}", maxMessage="numero doit etre egale a {{ limit }}")
     */
    private $phone;

    /**
     * @Assert\EqualTo(propertyPath ="password")
     */
    public $confirm_password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

 public function getUsername(): ?string
    {
        return $this->name;
    }


  
   public function eraseCredentials(){

   }

   public function getSalt(){

   }
    public function getRoles(){
      return ['ROLE_USER'];
    }

}
