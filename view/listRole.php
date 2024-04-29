<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List of Roles</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand h2 {
            margin: 0;
            color: #007bff;
        }

        .navbar-brand i {
            font-size: 24px;
            margin-right: 10px;
        }

        .add-reclam-link {
            font-size: 24px;
            margin-top: 20px;
            display: block;
            text-align: center;
        }
    </style>
</head>

<body>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>EDUISLAND</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="../index.html" class="nav-item nav-link active">Home</a>
            <a href="../about.html" class="nav-item nav-link">About</a>

            <div class="nav-item dropdown">
                <div class="dropdown-menu fade-down m-0">
                    <a href="../team.html" class="dropdown-item">Our Team</a>
                    <a href="../testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="../404.html" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="../contact.html" class="nav-item nav-link">Contact</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->

<table class="table" align="center">
    <tbody>
    <?php
include "../controller/Role.php";

$c = new Role();
$tab = $c->listRoleC();

?>

<center>
    <h1>List of Role</h1>
    <h2>
        <a href="addRole.php">Add Role</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id Role</th>
        <th>Type</th>
        <th></th>
    </tr>

    <?php
    foreach ($tab as $Role) {
    ?>

        <tr>
            <td><?= $Role['id_role']; ?></td>
            <td><?= $Role['type']; ?></td>
            <td align="center">
                <form method="POST" action="updateRole.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?php echo $Role['id_role']; ?>" name="id_role">
                </form>
                <a href="deleteRole.php?id_role=<?php echo $Role['id_role']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>