<?php

class reclamC
{
    private ?int $idR = null;
    private ?int $idU = null;
    private ?string $subjectt = null;
    private ?string $descriptionn = null;
    private ?string $feedback = null;

    public function __construct($idR, $idU, $subjectt, $descriptionn, $feedback)
    {
        $this->idR = $idR;
        $this->idU = $idU;
        $this->subjectt = $subjectt;
        $this->descriptionn = $descriptionn;
        $this->feedback = $feedback;
    }

    public function getIdR(): ?int
    {
        return $this->idR;
    }

    public function setIdR(?int $idR): void
    {
        $this->idR = $idR;
    }

    public function getIdU(): ?string
    {
        return $this->idU;
    }

    public function setIdU(?string $idU): void
    {
        $this->idU = $idU;
    }

    public function getSubject(): ?string
    {
        return $this->subjectt;
    }

    public function setSubject(?string $subjectt): void
    {
        $this->subject = $subject;
    }

    public function getDescriptionn(): ?string
    {
        return $this->descriptionn;
    }

    public function setDescriptionn(?string $description): void
    {
        $this->description = $description;
    }

    public function getFeedback(): ?string
    {
        return $this->feedback;
    }

    public function setFeedback(?string $feedback): void
    {
        $this->feedback = $feedback;
    }
}

?>
