<?php

class reponseC
{
    private ?int $idRP = null;
    private ?string $descP = null;

    public function __construct($idRP, $descP)
    {
        $this->idR = $idRP;
        $this->descP = $descP;
    }

    public function getIdRP(): ?int
    {
        return $this->idRP;
    }

    public function setIdR(?int $idRP): void
    {
        $this->idRP = $idRP;
    }
    public function getDescP(): ?string
    {
        return $this->descrP;
    }

    public function setDescP(?string $descP): void
    {
        $this->descP= $descP;
    }
}

?>
