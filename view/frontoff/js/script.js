function validateForm() {
    var a = document.getElementById('error-emailuser');
    var b = document.getElementById('error-type');
    a.textContent = "";
    b.textContent = "";

    var emailuser = document.forms["Form"]["emailuser"].value;
    var type = document.forms["Form"]["type"].value;

    if (emailuser == "") {
        a.textContent = "Le champ email doit être rempli";
        return false;
    }

    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailuser)) {
        a.textContent = "L'email doit être sous forme d'email valide.";
        return false;
    }

    if (type == "") {
        b.textContent = "Would you select a course type";
        return false;
    }
}