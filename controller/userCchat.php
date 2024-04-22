<?php
include '../config.php';
include '../Model/userchat.php';

class userC
{
    public function adduser($user)
{
    $sql = "INSERT INTO conversation (id_chat, id_stud) 
            VALUES (:id_chat, :id_stud)";
    $db = Config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id_chat' => $user->get_idchat(),
            'id_stud' => $user->get_id_stud()
        ]);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


    public function updateuser($user, $username)
    {
        $sql = "UPDATE conversation SET 
                id_chat = :id_chat, 
                id_stud = :id_stud
                WHERE id_chat = :username";
        
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                
                'id_chat' => $user->get_idchat(),
                'id_stud' => $user->get_id_stud()
            ]);
            echo $query->rowCount() . " record updated successfully<br>";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listuser()
    {
        $sql = "SELECT * FROM conversation";
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
        $sql = "DELETE FROM conversation WHERE id_chat = :username";
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
        $sql = "SELECT * FROM conversation WHERE id_chat = :username";
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
