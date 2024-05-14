document.addEventListener('DOMContentLoaded', function() {
    const downloadPdfBtn = document.getElementById('downloadPdfBtn');

    downloadPdfBtn.addEventListener('click', function() {
        // Création d'un nouveau document PDF
        const doc = new jsPDF();

        // Variables pour les positions de début des tableaux dans le PDF
        let yOffset = 10;
        const firstTableYOffset = 20;

        // Fonction pour ajouter un tableau au document PDF
        const addTableToPdf = (table, offsetY) => {
            const content = doc.autoTableHtmlToJson(table);
            doc.autoTable(content, { startY: offsetY });
        };

        // Sélection des deux tableaux à télécharger
        const tables = document.querySelectorAll('.table-data table');

        // Ajout de chaque tableau au document PDF avec un décalage vertical
        tables.forEach((table, index) => {
            if (index !== 0) {
                yOffset = firstTableYOffset;
            }
            addTableToPdf(table, yOffset);
            yOffset = doc.autoTable.previous.finalY + 10; // Met à jour la position Y pour le prochain tableau
        });

        // Téléchargement du document PDF
        doc.save('tableaux.pdf');
    });
});

function validateForm() {
    var matiere = document.getElementById("matiere_<?php echo $Cours['idlesson']; ?>").value;
    var nbheure = document.getElementById("nbheure_<?php echo $Cours['idlesson']; ?>").value;
    var niveau = document.getElementById("niveau_<?php echo $Cours['idlesson']; ?>").value;
    var idt = document.getElementById("idt_<?php echo $Cours['idlesson']; ?>").value;
    var errorMatiere = document.getElementById("error-matiere_<?php echo $Cours['idlesson']; ?>");
    var errorNbheure = document.getElementById("error-nbheure_<?php echo $Cours['idlesson']; ?>");
    var errorNiveau = document.getElementById("error-niveau_<?php echo $Cours['idlesson']; ?>");
    var errorIdt = document.getElementById("error-idt_<?php echo $Cours['idlesson']; ?>");

    // Vérification de la matière
    if (matiere === "") {
        errorMatiere.innerHTML = "Enter the course";
        return false;
    } else {
        errorMatiere.innerHTML = "";
    }

    // Vérification du nombre d'heures
    if (isNaN(nbheure) || nbheure === "") {
        errorNbheure.innerHTML = "Enter a valid number of courses";
        return false;
    } else {
        errorNbheure.innerHTML = "";
    }

    // Vérification du niveau
    var niveauxPermis = ["A1", "A2", "B1", "B2", "C1", "C2"];
    if (!niveauxPermis.includes(niveau)) {
        errorNiveau.innerHTML = "Enter a valid level (A1, A2, B1, B2, C1, C2)";
        return false;
    } else {
        errorNiveau.innerHTML = "";
    }

    // Vérification de l'ID enseignant
    if (isNaN(idt) || idt === "") {
        errorIdt.innerHTML = "Enter a  valide id teacher";
        return false;
    } else {
        errorIdt.innerHTML = "";
    }

    return true; // Le formulaire peut être soumis
}