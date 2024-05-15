<?php

class user
{
    private ?string $id_chat= null;
    private ?string $id_stud= null;
 
  

    public function __construct($id_chat, $id_stud)
    {   $this->id_chat = $id_chat;
        $this->id_stud = $id_stud;  
    }

    public function set_idchat($id_chat)
    {
        $this->id_chat = $id_chat;
        return $this;
    }
    
    public function get_idchat()
    {
        return $this->id_chat;
    }

    public function get_id_stud()
    {
        return $this->id_stud;
    }

    public function set_id_stud($id_stud)
    {
        $this->id_stud = $id_stud;
        return $this;
    }

   
   
}
