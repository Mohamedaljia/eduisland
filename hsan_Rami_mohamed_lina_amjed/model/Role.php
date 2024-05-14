<?php

class RoleC
{
    private ?int $id_role = null;
    private ?string $type = null;

    public function __construct($id_role,$type)
    {
        $this->id_role = $id_role;
        $this->type = $type;
    }

    public function getIdRole() :?int
    {
        return $this->id_role;
    }

    public function setIdRole($id_role)
    {
        $this->id_role = $id_role;
    }

    public function getType() :?string
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
      
    }
}

?>
