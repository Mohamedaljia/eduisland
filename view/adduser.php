<?php
include '../Controller/userC.php';

$error = "";

// Initialize user object
$user = null;

// Instantiate the controller
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
    // Check for required fields
    if (
   
        !empty($_POST["id_student"]) &&
        !empty($_POST["to_stud"]) &&
        !empty($_POST["name"]) &&
        !empty($_POST["message"]) &&
        !empty($_POST["answer"]) &&
        !empty($_POST["date"]) 
    ) {
        // Create new User object
        $user = new User(
            $_POST['id_student'],
            $_POST['to_stud'],
            $_POST['name'],
            $_POST['message'],
            $_POST['answer'],
            $_POST['date']
           
        );

        // Add user using the controller
        $userC->adduser($user);

        // Redirect to list page after successful addition
        header('Location: readuser.php');
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

    <div class="container">
       
        <div id="error" class="error">
            <?php echo $error; ?>
        </div>
        <form action="" method="POST">
            <div class="mb-3">
            <input type="text" id="id_student" class="id_label" name="id_student">
            <label class="id_label" id="id_student_label">id student</label>
            </div>
            <div class="mb-3">
            <input type="text" id="id_message" class="id_label" name="to_stud">
            <label class="id_label" id="id_message_label">to</label>
            </div>
            <div class="mb-3">
            <input type="text" id="name" class="id_label" name="name">
            <label class="name" id="priority_label">name</label>
            </div>
            <div class="mb-3">
            <input type="text" id="message" class="id_label" name="message">
            <label class="id_label" id="message">message</label>
            </div>
            <div class="mb-3">
            <input type="text" id="answer" class="id_label" name="answer">
            <label class="id_label" id="answer">answer</label>
            </div>
            <div class="mb-3">
            <input type="date" id="date_inp" class="id_label" name="date">
            </div>
            
        
            
            <button type="submit" class="btn btn-primary" id="confirm_butt">Save</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <br>
        </form>
        
    </div>
    <a href="readuser.php" class="btn btn-secondary mb-3" style="position: absolute;left: 1300px;" >Back to User List</a>
    <script >
        function applyColorToElements(className,color) {
    var elements = document.getElementById('' + className);

        elements.style.borderBottomColor = color;
        elements.style.color=color;
}
var id_report=document.getElementById('id_student');
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

