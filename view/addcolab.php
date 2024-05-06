
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="asset/css/add.css">

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="#" class="brand">
        <img src="asset/img/icon.png" alt="AzulTunes Logo" class="logo">
        <span class="text">AzulTunes</span>
    </a>

		<ul class="side-menu top">
            <li class="active">
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">Forum</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Collaborators</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Deals</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Events</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Claims</span>
                </a>
            </li>
        </ul>
<ul class="side-menu">
    <li>
        <a href="#">
            <i class='bx bxs-cog'></i>
            <span class="text">Settings</span>
        </a>
    </li>
    <li>
        <a href="#" class="logout">
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
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="asset/img/ena">
        </a>
    </nav>
    <!-- NAVBAR -->
<!-- MAIN -->
<main style="text-align: center;">
    <div class="head-title">
        <div class="left">
            <h1>Collaborators</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
        <a href="#" class="btn-download">
            <i class='bx bxs-cloud-download' ></i>
            <span class="text">Download PDF</span>
        </a>
    </div>

    <div class="table-data" style="margin: auto; width: 50%; text-align: left;"> <!-- Centering the table and adjusting width -->
        <div class="order">
            <div class="head">
                <h3>Reclamation Form</h3>
                <i class='bx bx-search' ></i>
                <i class='bx bx-filter' ></i>
            </div>
            <form id="reclamationForm" method="POST"> <!-- Ensure you specify the method as POST -->
                <div class="mb-3">
                    <label for="reclamationId" class="form-label">Reclamation ID</label>
                    <input type="text" class="form-control" id="reclamationId" name="idR" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                </div>
                <div class="mb-3">
                    <label for="userId" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="userId" name="idU" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                </div>
                <div class="mb-3">
                    <label for="sub" class="form-label">Subject</label>
                    <select class="form-select" id="sub" name="sub" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                        <option value="cours">Cours</option>
                        <option value="prof">Prof</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" id="desc" name="typee" rows="3" style="margin-left: auto; margin-right: auto; display: block; "></textarea> <!-- Modified here -->
                </div>
                <div class="mb-3">
                    <label for="fed" class="form-label">Feedback</label>
                    <textarea class="form-control" id="fed" name="fed" rows="3" style="margin-left: auto; margin-right: auto; display: block;"></textarea> <!-- Modified here -->
                </div>
                <button type="submit" class="btn-save" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">Save</button> <!-- Modified here -->
            </form>
        </div>
       
    </div>
</main>
<!-- MAIN -->



</section>
<!-- CONTENT -->

	

	<script src="asset/java/add.js"></script>
</body>
</html>