document.addEventListener("DOMContentLoaded", function() {
    const coursesSection = document.getElementById("coursesSection");
    const addCourseForm = document.getElementById("addCourseForm");

    addCourseForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const courseTitle = document.getElementById("courseTitle").value;
        const courseImage = document.getElementById("courseImage").value;
        const courseHours = document.getElementById("courseHours").value;

        // Créer un élément de cours
        const newCourseItem = document.createElement('div');
        newCourseItem.classList.add('col-lg-4', 'col-md-6', 'wow', 'fadeInUp');
        newCourseItem.setAttribute('data-wow-delay', '0.1s');

        newCourseItem.innerHTML = `
            <div class="course-item bg-light">
                <div class="position-relative overflow-hidden">
                    <img class="img-fluid" src="${courseImage}" alt="${courseTitle}">
                    <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                        <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                        <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;" data-bs-toggle="modal" data-bs-target="#joinCourseModal">Join Now</a>
                    </div>
                </div>
                <div class="text-center p-4 pb-0">
                    <h3 class="mb-0">$89.00</h3>
                    <div class="mb-3">
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small>Quality</small>
                    </div>
                    <h5 class="mb-4">${courseTitle}</h5>
                </div>
                <div class="d-flex border-top">
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>${courseHours} Hrs</small>
                    <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>18 Students</small>
                </div>
            </div>
        `;

        coursesSection.appendChild(newCourseItem);

        // Réinitialiser le formulaire après l'ajout du cours
        addCourseForm.reset();
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const courseIdForm = document.getElementById("courseIdForm");
    const coursesTableBody = document.querySelector("#coursesTable tbody");

    courseIdForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Empêcher le formulaire de se soumettre normalement

        const courseId = document.getElementById("courseId").value;

        // Envoyer une requête AJAX à select.php avec l'ID du cours
        fetch(`select.php?id=${courseId}`)
            .then(response => response.json())
            .then(course => {
                // Effacer le contenu précédent du tableau
                coursesTableBody.innerHTML = '';

                // Ajouter la ligne du cours correspondant à la réponse JSON
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${course.id}</td>
                    <td>${course.titre}</td>
                    <td><img src="${course.image}" alt="${course.titre}" style="max-width: 100px;"></td>
                    <td>${course.nombre_heures}</td>
                    <!-- Ajoutez ici d'autres colonnes si nécessaire -->
                `;
                coursesTableBody.appendChild(row);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
});
$(document).ready(function() {
    $('#saveDataBtn').click(function() {
        // Récupérer les données du tableau JSGrid
        var data = $('#jsGrid').jsGrid('option', 'data');

        // Envoyer les données au serveur via AJAX
        $.ajax({
            type: 'POST',
            url: 'Insert.php', // L'URL de votre fichier PHP d'insertion
            data: { data: JSON.stringify(data) }, // Convertir les données en JSON et les envoyer au fichier PHP
            success: function(response) {
                // Afficher la réponse du serveur (par exemple, un message de succès ou d'erreur)
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs en cas d'échec de la requête AJAX
                console.error(xhr.responseText);
            }
        });
    });
});