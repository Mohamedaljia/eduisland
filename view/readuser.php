<?php
include '../Controller/userC.php';

// Create an instance of the UserController
$userC = new userC();

// Retrieve list of users
$list = $userC->listuser();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            padding: 20px;
            background-image: url('media/bg.png'); 
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

        table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            text-decoration: none;
            color: blue;
        }

        td a:hover {
            text-decoration: underline;
        }

        .center {
            text-align: center;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
    <title>User List</title>
</head>

<body>
    <header>
        <img src="media\logobil3orth.png" alt="Logo" class="logo"> 
       
    </header>

    <?php if (empty($list)): ?>
        <p class="error">No users found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>id student</th>
                    <th>to</th>
                    <th>name</th>
                    <th>message</th>
                    <th>answer</th>
                    <th>date</th>
            
                    <th>action</th>
                    
                    
                </tr>
            </thead>
            <tbody>
            <?php
            $con=new mysqli('localhost','root','','webproject_2a27');
            if(!$con){
                die(mysqli_error($con));
            }
                        $sql="Select * from `chat`";
                        $result=mysqli_query($con,$sql);
                        if($result)
                        {
                         while($row=mysqli_fetch_assoc($result)){
                                $id_student=$row['id_student'];
                                $to_stud=$row['to_stud'];
                                $name=$row['name'];
                                $message=$row['message'];
                                $answer=$row['answer'];
                                $date=$row['date'];
                               
                                echo '<tr><th scope="row">'.$id_student.'</th>
                                    <td>'.$to_stud.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$message.'</td>
                                    <td>'.$answer.'</td>
                                    <td>'.$date.'</td>
                                   
                                    
                                    <td>
                                    <button class="btn btn-danger btn-sm"><a href="deleteuser.php?deletid='.$id_student.'">delete</a></button>
                                    <button class="btn btn-success btn-sm"><a href="updateuser.php?deletid='.$id_student.'">update</a></button>

                                    </tr>';
                              }
                        }
                        ?>
                         
                        
   
</td>
<td class="center">
                            
                        </td>
                       
                    </tr>
                       
                        
                    </tr>
                
            </tbody>
        </table>
    <?php endif; ?>

    <div class="center">
        <button><a href="adduser.php">Add User</a></button>
    </div>
</body>

</html>
