<?php
include '../../controller/coursC.php';
include '../../config/connexion.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="img/4.png" type="image/x-icon">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/4.png" alt="Logo" width="30" height="30" class="d-inline-block align-top me-2"> EduIsland
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cours.php">Courses</a>
                    </li>
                    <a href="../gestion.html" class="nav-item nav-link ">Exams</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../team.html">Our Team</a></li>
                            <a href="../testimonial.html" class="dropdown-item">Testimonial</a>
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.html">Contact</a>
                    </li>
                </ul>
                <button class="btn btn-primary d-none d-lg-block">Join Now <i class="fas fa-arrow-right ms-3"></i></button>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="container-fluid bg-primary py-5 mb-5" style="max-height: 300px;">
        <!-- Ajout de la propriété style pour définir une hauteur maximale -->
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 text-center">
                    
                    <h1 class="display-3 text-white">Courses</h1>
                    <!-- Ajout de la classe text-center pour centrer le titre -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item active text-white" aria-current="page"class="text-white">Home</a></li>
                            
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                    <h1 class="mb-5">Our Popular Courses</h1>
                </div>
        <!-- cours Section -->
<!-- cours Section -->
<div class="cours-section">
    <div class="cours">
        
        <div class="row">
            <!-- PHP loop to display cours items -->
            <?php foreach ($cours as $Cours): ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <?php
                        // Determine the image path based on the "matiere" attribute
                        $image_path = 'img/default.png'; // Default image path if no specific image found
                        switch ($Cours['matiere']) {
                            case 'Mathématiques':
                                $image_path = 'img/maths.jfif';
                                break;
                            case 'Spanish':
                                $image_path = 'img/spanish.jfif';
                                break;
                                case 'Portuguese':
                                    $image_path = 'img/portoguese.jfif';
                                    break;
                                    case 'Italian':
                                        $image_path = 'img/italian.jfif';
                                        break;
                                        case 'French':
                                            $image_path = 'img/French.jfif';
                                            break;
                        }
                        ?>
                        <img class="img-fluid" src="<?php echo $image_path; ?>" alt="<?php echo $Cours['matiere']; ?>">
                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            <button class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;" onclick="viewCoursDetails(<?php echo $Cours['idlesson']; ?>)">View Details</button>
                            <button class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;"onclick="viewCoursDetails(<?php echo $Cours['idlesson']; ?>)">Join Now</button>
                        </div>
                    </div>
                    <div class="text-center p-4 pb-0 ">
                        <h3 class="mb-0 "><?php echo $Cours['matiere']; ?></h3>
                        <div class="mb-3 ">
                            <small class="fa fa-star text-primary "></small>
                            <small class="fa fa-star text-primary "></small>
                            <small class="fa fa-star text-primary "></small>
                            <small class="fa fa-star text-primary "></small>
                            <small class="fa fa-star text-primary "></small>
                            <small>Quality</small>
                        </div>
                        <h5 class="mb-4 "><?php echo $Cours['niveau']; ?></h5>
                    </div>
                    <div class="d-flex border-top ">
                        <small class="flex-fill text-center border-end py-2 "><i class="fa fa-user-tie text-primary me-2 "></i><?php echo $Cours['idt']; ?></small>
                        <small class="flex-fill text-center border-end py-2 "><i class="fa fa-clock text-primary me-2 "></i><?php echo $Cours['nbheure']; ?> Hrs</small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- End PHP loop -->
        </div>
    </div>
</div>


<script>
  function viewCoursDetails(idlesson) {
    // Redirect to forum.php with the collaboration ID as a parameter
    window.location.href = 'forum.php?id=' + idlesson;
  }
</script>


        <script src="js/new.js "></script>


    <!-- Testimonial -->
    <!-- Insérez ici le contenu de la section "Testimonial " de la template -->

    <!-- Footer -->
    <!-- Insérez ici le contenu de la section "Footer " de la template -->
    <footer class="container-fluid bg-dark text-light pt-5 mt-5 wow fadeIn " data-wow-delay="0.1s ">
       
        <!-- Back to Top -->
        <a href="# " class="btn btn-lg btn-primary btn-lg-square back-to-top "><i class="bi bi-arrow-up "></i></a>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js "></script>
    <script src="lib/wow/wow.min.js "></script>
    <script src="lib/easing/easing.min.js "></script>
    <script src="lib/waypoints/waypoints.min.js "></script>
    <script src="lib/owlcarousel/owl.carousel.min.js "></script>

    <!-- Template Javascript -->
    <script src="js/main.js "></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>