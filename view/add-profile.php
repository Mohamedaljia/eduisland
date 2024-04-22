<?php
include '../config.php';
include '../controller/controllerprofile.php';

?>
<!DOCTYPE html>
<html lang="en">
<form class="formulaire_event" method="post">
        
       <!-- <label for="idprofile">ID Profile:</label>
        <input type="text" id="idprofile" name="idprofile" placeholder="ID Profile"><br><br>-->
        <label for="cv">CV:</label>
        <input type="file" id="cv" name="cv" ><br><br>
		
        <label for="date_creation">Date of Creation:</label>
        <input type="date" id="date_creation" name="date_creation"><br><br>
		
        <label for="disponibilite">Availability:</label><br>
        <select id="disponibilite" name="disponibilite">
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select><br><br>
    
    <div class="button-wrapper">
        <input type="submit" name="submit_Add" value="Add">
    </div>
</form>
</html>


    