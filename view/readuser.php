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
   
</head>
<body>
<div id="overlay"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="../index.html" class="brand">
    <img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
    </a>

		<ul class="side-menu top">
            <li>
                <a href="test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">User</span>
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
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Chat</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Conversation</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="test.php">Home</a>
						</li>
					</ul>
				</div>
                <ul class="breadcrumb">
                    <a href="pdf_chat.php" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                        <span class="text">Download PDF</span>
                    </a>
                    <br>
                    <a href="statistic_chat.php" class="btn-download">
                        
                        <span class="text">Statistic</span>
                    </a>
                    <br>
                    <a href="adduser.php" class="btn-download">
                        
                        <span class="text">ADD conversation</span>
                    </a>
                </ul>
			</div>



			<div class="table-data">
    <div class="table-data order">
        <div class="head">
            <h3>List of Conversations</h3>
        </div>
        <table class="table table-hover text-center">
            
        

            <tbody>    
                <table class="table" align="center">
                    <thead>
                        <tr>
                        <th>id student</th>
                            <th>to</th>
                            <th>name</th>
                            <th>message</th>
                            <th>answer</th>
                            <th>date</th>
                            <th>action</th>
                  
            
                  
                    

                            <th></th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $con = new mysqli('localhost', 'root', 'Rubyboubi2020', 'projectdba');
                        if (!$con) {
                            die(mysqli_error($con));
                        }
                        $sql = "Select * from `chat`";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_student = $row['id_student'];
                                $to_stud = $row['to_stud'];
                                $name = $row['name'];
                                $message = $row['message'];
                                $answer = $row['answer'];
                                $date = $row['date'];

                                echo '<tr>
                                        <td>' . $id_student . '</td>
                                        <td>' . $to_stud . '</td>
                                        <td>' . $name . '</td>
                                        <td>' . $message . '</td>
                                        <td>' . $answer . '</td>
                                        <td>' . $date . '</td>
                                        <td>
                                           <a href="deleteuser2.php?deletid=' . $id_student . '" >Delete</a>
                                            </td>
                                            <td>
                                         <a href="updateuser2.php?deletid=' . $id_student . '" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #FFFFFF; padding: 5px 10px; font-size: 1rem; border: none; border-radius: 3px;">Update</a>
                                            </td>
                                    </tr>';
                            }
                        }
                        ?>
                       

                    </tbody>
                </table>

            </tbody>
    </div>
    
     </div>
                                    
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="asset/java/script.js"></script>
    
</body>
</html>