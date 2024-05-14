<?php

class UserC
{
    private ?int $id= null;
    private ?string $nom = null;
    private ?string $prenom= null;
    private ?string $email = null;
    private ?int $mdp = null;
    private ?int $occupation  = null;



    public function __construct($id, $nom, $prenom, $email,$mdp,$occupation)
    {   $this->id     = $id;
        $this->nom    = $nom;
        $this->prenom = $prenom;
        $this->email  = $email;
        $this->mdp    = (int)$mdp;
        $this->occupation    = $occupation;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string 
    {
        return $this->nom;
    }

    public function setNom($nom) :void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string 
    {
        return $this->prenom;
    }
    public function setPrenom($prenom) :void
    {
        $this->prenom = $prenom;
    }
    public function getEmail(): ?string 
    {
        return $this->email;
    }

    public function setEmail($email) :void
    {
        $this->email = $email;
    }
    public function getMdp(): ?int
    {
        return $this->mdp;
    }

    public function setMdp($mdp) :void 
    {
        $this->mdp = $mdp;
    }
    public function getOccupation(): ?int
    {
        return $this->occupation;
    }
    public function setOccupation($occupation) :void
    {
        $this->occupation = $occupation;
        
    }
}
?>