<?php
include '../config1.php';
include '../Model/user2.php';

class userC
{
    public function adduser($user)
    {
        $sql = "INSERT INTO chat (id_student,to_stud,name,message,answer,date) 
                VALUES (:id_student,:to_stud,:name,:message,:answer,:date)";
        $db = Config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_student' => $user->get_id_student(),
                'to_stud' => $user->get_to(),
                'name' => $user->getname(),
                'message' => $user->getmessage(),
                'answer' => $user->getanswer(),
                'date' => $user->getdate(),
                
            ]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateuser($user, $username)
    {
        $sql = "UPDATE chat SET 
                id_student = :id_student, 
                to_stud = :to_stud, 
                name = :name, 
                message = :message,
                answer = :answer,
                date = :date
                WHERE id_student = :username";
        
        $db = Config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_student' => $user->get_id_student(),
                'to_stud' => $user->get_to(),
                'name' => $user->getname(),
                'message' => $user->getmessage(),
                'answer' => $user->getanswer(),
                'date' => $user->getdate(),
                'username' => $username
            ]);
            echo $query->rowCount() . " record updated successfully<br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    public function listuser()
    {
        $sql = "SELECT * FROM chat";
        $db = Config::getConnexion();
        
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteuser($username)
    {
        $sql = "DELETE FROM chat WHERE id_student = :username";
        $db = Config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':username', $username);
            $query->execute();
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function showuser($username)
    {
        $sql = "SELECT * FROM chat WHERE id_student = :username";
        $db = Config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':username', $username);
            $query->execute();

            $user = $query->fetch(PDO::FETCH_ASSOC);
            return $user;
            
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
