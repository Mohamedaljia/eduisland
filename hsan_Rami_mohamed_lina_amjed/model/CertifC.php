<?php

class Certif
{
    private ?int $id_certif= null;
    private ?int $id_exam= null;

    private ?string $datee = null;
    private ?string $specialite = null;
    private ?string $id_etudiant = null;
    



    public function __construct($id_certif, $id_exam, $datee, $specialie,$id_etudiant)
    {    $this->id_certif    = $id_certif;
        $this->id_exam = $id_exam;
        $this->datee = $datee;
        $this->specialite= $specialie;
        $this->id_etudiant = $id_etudiant;
        
    }
    public function getId_certif()
    {
        return $this->id_certif;
    }
    
    public function getId_exam()
    {
        return $this->id_exam;
    }


    public function getspecialite()
    {
        return $this->specialite;
    }

    public function setspecialite($specialite)
    {
        $this->specialite = $specialite;
        return $this;
    }

    public function getid_etudiant()
    {
        return $this->id_etudiant;
    }
    public function setid_etudiant($etudiant)
    {
        $this->etù= $etudiant;
        return $this;
    }
    public function getdate()
    {
        return $this->datee;
    }
    public function setdate($datee)
    {
        $this->datee= $datee;
        return $this;
    }
    
    
}

?>