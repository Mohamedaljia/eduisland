<?php

class user
{
    private ?string $id_student= null;
    private ?string $to_stud= null;
    private ?string $name = null;
    private ?string $message= null;
    private ?string $answer = null;
    private ?string $date = null;
  

    public function __construct($id_student, $to_stud, $name, $message,$answer,$date)
    {   $this->id_student = $id_student;
        $this->to_stud = $to_stud;
        $this->name = $name;
        $this->message = $message;
        $this->answer = $answer;
        $this->date = $date;
 
        
    }

    public function set_id_student($id_student)
    {
        $this->id_student = $id_student;
        return $this;
    }
    
    public function get_id_student()
    {
        return $this->id_student;
    }

    public function get_to()
    {
        return $this->to_stud;
    }

    public function set_to($to)
    {
        $this->to = $to_stud;
        return $this;
    }

    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name = $name;
        return $this;
    }
    public function getmessage()
    {
        return $this->message;
    }

    public function setmessage($message)
    {
        $this->message = $message;
        return $this;
    }
    public function getanswer()
    {
        return $this->answer;
    }

    public function setanswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }
    public function getdate()
    {
        return $this->date;
    }

    public function setdate($date)
    {
        $this->date = $date;
        return $this;
    }
   
}
