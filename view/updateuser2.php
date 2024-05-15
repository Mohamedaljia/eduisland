<?php 
include '../Controller/userC.php';

$error = "";
$userC = new userC();

// Process form submission
if (
    isset($_POST["id_student"]) &&
    isset($_POST["to_stud"]) &&
    isset($_POST["name"]) &&
    isset($_POST["message"]) &&
    isset($_POST["answer"]) &&
    isset($_POST["date"])
) {
    // Check for non-empty required fields
    if (
        !empty($_POST["id_student"]) &&
        !empty($_POST["to_stud"]) &&
        !empty($_POST["name"]) &&
        !empty($_POST["message"]) &&
        !empty($_POST["answer"]) &&
        !empty($_POST["date"]) 
    ) {
        // Create a new User object
       $user = new User(
        $_POST['id_student'],
        $_POST['to_stud'],
        $_POST['name'],
        $_POST['message'],
        $_POST['answer'],
        $_POST['date']
        );

        // Update user using UserController
        $userC->updateuser($user, $_POST["id_student"]);

        // Redirect to user list page after successful update
        header('Location: readuser.php');
        exit();
    } else {
        $error = "Please fill out all required fields.";
    }
}

// Retrieve user data for the form
$user = null;
if (isset($_POST['id_student'])) {
    $user = $userC->showUser($_POST['id_student']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    
	<!-- My CSS -->
	<link rel="stylesheet" href="asset/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <style>
    /* Custom Styles */
    .footer-links {
        margin-top: 50px;
    }

    .footer-links a {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .error {
        color: red;
    }
</style>
</head>
<body>
<div id="overlay"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="../index.html" class="brand">
      <!-- <img src="asset/img/icon.png" alt="AzulTunes Logo" class="logo">-->
      <span class="text"><i class="fa fa-book me-3"></i>EDUISLAND</span>
    </a>

		<ul class="side-menu top">
        <li>
                <a href="test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li  >
                <a href="listUser.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
                <a href="listExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">EXAMS</span>
                </a>
            </li>
            <li class="active">
                <a href="readchat.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">Chat</span>
                </a>
            </li>
           
            <li>
                <a href="backoff/index.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">cours</span>
                </a>
            </li>
            <li>
                <a href="listreclam.php">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Reclamation</span>
                </a>
            </li>
            <li>
                <a href="backoff/index1.php">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Partenaire</span>
                </a>
            </li>
        </ul>
<ul class="side-menu">
    <li>
        <a href="login.php" class="logout">
            <i class='bx bxs-log-out-circle'></i>
            <span class="text">Logout</span>
        </a>
    </li>
</ul>


	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
		</nav>
		<!-- NAVBAR -->

	<!-- MAIN -->
<main style="text-align: center;">
    <div class="head-title">
        <div class="left">
            <h1>Users</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Update of Users</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
            <a href="listUser.php" class="btn-download">
                <span class="text">Back to list</span>
            </a>
      
    </div>

<div class="table-data" style="margin: auto; width: 50%; text-align: left;"> <!-- Centering the table and adjusting width -->
    <div class="order">
        <div class="head">
            <h3>Chat Update</h3>
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    <!-- Navbar End -->

    <div class="container">
    <?php
        include 'connexion.php';
        $id_student= $_GET["deletid"];
        $sql="Select * from chat where id_student=$id_student";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $id_student=$row['id_student'];
        $to_stud=$row['to_stud'];
        $name=$row['name'];
        $message=$row['message'];
        $answer=$row['answer'];
        $date=$row['date'];
        ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="id_label" id="id_student_label">id student</label>

                <input type="text" id="id_student" class="id_label" name="id_student" readonly value=<?= $row['id_student']; ?> style="margin-left: auto; margin-right: auto; display: block;">
            </div>
            <div class="mb-3">
                 <label class="to_stud_label" id="stud_id_label">to</label>
                <input type="text" id="stud_id_inp" class="id_label" name="to_stud" readonly value=<?= $row['to_stud']; ?> style="margin-left: auto; margin-right: auto; display: block;">
            </div>
            <div class="mb-3">
                <label class="id_label" id="name_label">name</label>

                <input type="text" id="name" class="id_label" name="name" value=<?= $row['name']; ?> style="margin-left: auto; margin-right: auto; display: block;">
            </div>
            <div class="mb-3">
                <label class="id_label" id="message_label">message</label>

                <input type="text" id="message_inp" class="id_label" name="message" value=<?= $row['message']; ?> style="margin-left: auto; margin-right: auto; display: block;">
            </div>
            <div class="mb-3">
                <label class="id_label" id="answer_label">answer</label>

                <input type="text" id="answer_inp" class="id_label" name="answer" value=<?= $row['answer']; ?> style="margin-left: auto; margin-right: auto; display: block;">
            </div>
            <div class="mb-3">
            <label class="date" id="date">Date</label>

                <input type="date" id="date_inp" class="id_label" name="date" value=<?= $row['date']; ?> style="margin-left: auto; margin-right: auto; display: block;">
  
            </div>
            <input type="submit" value="Save" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
            <input type="reset" value="Reset" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
            <br>
        </form>
        
    </div>

</body>
<script >
        function applyColorToElements(className,color) {
    var elements = document.getElementById('' + className);

        elements.style.borderBottomColor = color;
        elements.style.color=color;
}
var id_report=document.getElementById('stud_id_inp');
var id_report_label=document.getElementById("id_student_label")
var id_stud=document.getElementById('id_message');
var id_stud_label=document.getElementById('id_message_label');
var description=document.getElementById('name');

var date=document.getElementById('date_inp');


var submit_button=document.getElementById('confirm_butt');
id_report.addEventListener('keydown', function(event) {
    // Allow only numeric digits (0-9) and Backspace key
    if (!/[0-9\b]/.test(event.key) && !['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown','Delete','Del'].includes(event.key)) {
        event.preventDefault(); // Prevent the character from being entered
    }
});
id_stud.addEventListener('keydown', function(event) {
    // Allow only numeric digits (0-9) and Backspace key
    if (!/[0-9\b]/.test(event.key) && !['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown','Delete','Del'].includes(event.key)) {
        event.preventDefault(); // Prevent the character from being entered
    }
});
description.addEventListener('input', function(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/[^a-zA-Z]/g, '');
    event.target.value = inputValue;
});
priority.addEventListener('input', function(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/[^a-zA-Z]/g, '');
    event.target.value = inputValue;
});
feedback.addEventListener('input', function(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/[^a-zA-Z]/g, '');
    event.target.value = inputValue;
});
resolution.addEventListener('input', function(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/[^a-zA-Z]/g, '');
    event.target.value = inputValue;
});
const minDate = '2020-01-01';
date.setAttribute('min', minDate);

submit_button.addEventListener('click',function (){
    const isAllNumbers = /^\d+$/.test(id_report.value);
    if((!id_report.value.trim() || !isAllNumbers || id_report.value.length>6))
    {
        alert('Please enter the report id');
        id_report.style.borderBottomColor="red";
        id_report_label.style.color="red";
        id_report.value='';
    }
    else{
        id_report.style.borderBottomColor="green";
        id_report_label.style.color="green";
        id_report_label.style.display="none";
    }
    if((!id_stud.value.trim() || !isAllNumbers || id_stud.value.length>6))
    {
        alert('Please enter the student id');
        id_stud.style.borderBottomColor="red";
        id_stud_label.style.color="red";
        id_stud.value='';
    }
    else{
        id_stud.style.borderBottomColor="green";
        id_stud_label.style.color="green";
        id_stud_label.style.display="none";
    }
    if(description.value.length<4)
    {
        alert('Please type something in the description');
        description.style.borderBottomColor="red";
        description_label.style.color="red";
        description.value='';
    }
    else{
        description.style.borderBottomColor="green";
        description_label.style.color="green";
        description_label.style.display="none";
    }
    if(priority.value.length<4)
    {
        alert('Please enter the priority');
        priority.style.borderBottomColor="red";
        priority_label.style.color="red";
        priority.value='';
    }
    else{
        priority.style.borderBottomColor="green";
        priority_label.style.color="green";
        priority_label.style.display="none";
    }
    if(feedback.value.length<4)
    {
        alert('Please enter the feedback');
        feedback.style.borderBottomColor="red";
        feed_label.style.color="red";
        feedback.value='';
    }
    else{
        feedback.style.borderBottomColor="green";
        feed_label.style.color="green";
        feed_label.style.display="none";
    }
    if(resolution.value.length<4)
    {
        alert('Please enter the resolution');
        resolution.style.borderBottomColor="red";
        reso_label.style.color="red";
        resolution.value='';
    }
    else{
        resolution.style.borderBottomColor="green";
        reso_label.style.color="green";
        reso_label.style.display="none";
    }

})
if (date.value === "0000-00-00") {
    alert("Please select a valid date");

}
    </script>

</body>

</html>