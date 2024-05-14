<?php

class reponseC
{
    private ?int $idRP = null;
    private ?string $descP = null;

    public function __construct($idRP, $descP)
    {
        $this->idRP = $idRP;
        $this->descP = $descP;
    }

    public function getIdRP(): ?int
    {
        return $this->idRP;
    }

    public function setIdRP(?int $idRP): void
    {
        $this->idRP = $idRP;
    }
    public function getDescP(): ?string
    {
        return $this->descP;
    }

    public function setDescP(?string $descP): void
    {
        $this->descP= $descP;
    }
}

?>
