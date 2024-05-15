<?php
include '../Controller/userCchat.php';

$error = "";

// Initialize user object
$user = null;

// Instantiate the controller
$userC = new userC();

// Process form submission
if (
    
    isset($_POST["id_chat"]) &&
    isset($_POST["id_stud"]) 
) {
    // Check for required fields
    if (
   
        !empty($_POST["id_chat"]) &&
        !empty($_POST["id_stud"])
    ) {
        // Create new User object
        $user = new User(
            $_POST['id_chat'],
            $_POST['id_stud']
           
        );

        // Add user us
        $userC->adduser($user);

        // Redirect to list page after successful addition
        header('Location: readchat.php');
        exit();
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            padding-top: 20px;
            background-image: url('media/bg.png'); 
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logo {
            width: 150px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
        }

        h1 {
            position: absolute;
            top : 30px ; 
            left: 650px;
            size: 55px;
            font-family: 'Hurson', serif;
            text-align: center;
            color: #1144B4;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #545b62;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
    <div class="container">
       
        <div id="error" class="error">
            <?php echo $error; ?>
        </div>
        <form action="" method="POST">
            <div class="mb-3">
            <input type="text" id="id_chat" class="id_label" name="id_chat">
            <label class="id_label" id="id_chat_label">id chat</label>
            </div>
            <div class="mb-3">
            <label for="id_student">Select Student ID:</label>
<select name="id_stud" id="id_stud">
    <?php
    // Connect to the database
    $con = new mysqli('localhost', 'root', 'Rubyboubi2020', 'projectdba');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch all id_student values from the chat table
    $sql = "SELECT id_student FROM chat";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Loop through the results and create options for the select input
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id_student'].'">'.$row['id_student'].'</option>';
    }

    // Close the database connection
    mysqli_close($con);
    ?>
</select>

            </div>
            <button type="submit" class="btn btn-primary" id="confirm_butt">Save</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <br>
        </form>
        
    </div>
    <a href="readchat.php" class="btn btn-secondary mb-3" style="position: absolute;left: 1300px;" >Back to User List</a>

</body>

</html>