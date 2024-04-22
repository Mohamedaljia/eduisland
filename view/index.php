<?php include '../controller/controllerprofile.php'; ?>
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
    <title>AdminHub</title>
</head>
<body>
<div id="overlay"></div>
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <img src="asset/img/logo.png" alt="eduiland" class="logo" weidth=100px height=100px  >
        <span class="text">Eduiland</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="indexprofile.php">
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
            <a href="add-profile.php">
                <i class='bx bxs-group'></i>
                <span class="text">Profiles</span>
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
            <img src="asset/img/ena.jpg">
        </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
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
        <div class="table-data">
            <div class="table-data order">
                <div class="head">
                    <h3>List of Profiles</h3>
                </div>
                <table class="table table-hover text-center">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">CV</th>
                        <th scope="col">Date of Creation</th>
                        <th scope="col">Availability</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($profiles as $profile): ?>
                        <tr>
                            <td><?php echo $profile['cv']; ?></td>
                            <td><?php echo $profile['date_creation']; ?></td>
                            <td><?php echo ($profile['disponibilite'] == 1) ? 'Available' : 'Not Available'; ?></td>
                            <td>
                                <button onclick="openModal('<?php echo $profile['idprofile']; ?>')" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Form for updating profile -->
                                <div id="myModal_<?php echo $profile['idprofile']; ?>" class="modal" style="display: none;">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('<?php echo $profile['idprofile']; ?>')">&times;</span>
                                        <form action="" method="POST">
                                            <input type="hidden" name="idprofile" value="<?php echo $profile['idprofile']; ?>">
                                            <label for="cv">CV:</label>
                                            <input type="file" name="cv" accept=".pdf, .doc, .docx" value="<?php echo $profile['cv']; ?>"><br>
                                            <label for="date_creation">Date of Creation:</label>
                                            <input type="date" name="date_creation" value="<?php echo $profile['date_creation']; ?>"><br>
                                            <label for="disponibilite">Availability:</label><br>
                                            <select name="disponibilite">
                                                <option value="1" <?php if($profile['disponibilite'] == 1) echo 'selected'; ?>>Available</option>
                                                <option value="0" <?php if($profile['disponibilite'] == 0) echo 'selected'; ?>>Not Available</option>
                                            </select><br>
                                            <button type="submit" name="submit_update" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                                <form action="" method="POST">
                                    <input type="hidden" name="idprofile" value="<?php echo $profile['idprofile']; ?>">
                                    <button type="submit" name="submit_delete" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>

<script src="asset/java/script.js"></script>

</body>
</html>
