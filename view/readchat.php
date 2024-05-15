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
                    <span class="text">course</span>
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
                    <a href="readuser.php" class="btn-download">
                        
                        <span class="text">Liste Useres</span>
                    </a>
                    <br>
                    <a href="addchat.php" class="btn-download">
                        
                        <span class="text"> ADD Chat</span>
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
                        <th>id chat</th>
                    <th>id student</th>
                    <th>message</th>
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
                        $sql = "SELECT conversation.id_chat, conversation.id_stud, chat.message, chat.date
FROM conversation
INNER JOIN chat ON conversation.id_stud = chat.id_student";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_chat = $row['id_chat'];
                                $id_stud = $row['id_stud'];
                                $message = $row['message'];
                                $date = $row['date'];
                        
                                echo '<tr>
                                        <td>'.$id_chat.'</td>
                                        <td>'.$id_stud.'</td>
                                        <td>'.$message.'</td>
                                        <td>'.$date.'</td>
                                        <td>
                                           <a href="deletechat.php?deletid=' .$id_chat. '" >Delete</a>
                                            </td>
                                            <td>
                                         <a href="updatechat.php?deletid=' .$id_chat.'" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #FFFFFF; padding: 5px 10px; font-size: 1rem; border: none; border-radius: 3px;">Update</a>
                                            </td>
                                    </tr>';
                            }
                        }
                        ?>
                        <?php
$con = new mysqli('localhost', 'root', 'Rubyboubi2020', 'projectdba');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT COUNT(DISTINCT id_chat) AS num_chats FROM conversation";

$result = $con->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    $num_chats = $row['num_chats'];

} 
$con->close();
?>

                    </tbody>
                </table>

            </tbody>
              <a href="chat.php" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 5px 10px; font-size: 1rem; border: none; border-radius: 3px;">Chat</a>
    </div>
    
     </div>
                                    
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="asset/script/add-collab.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JavaScript code here -->
   

	<script src="asset/java/script.js"></script>
    
</body>
</html>