
function validateForm() {
    let valid = true;

    
    document.querySelectorAll('.error-message').forEach(function(errorElement) {
        errorElement.innerHTML = '';
    });
    document.querySelectorAll('input, textarea').forEach(function(input) {
        input.classList.remove('invalid');
    });


    const title = document.getElementById("title").value.trim();
    if (title === "" || !/^[a-zA-Z\s]+$/.test(title)) {
        document.getElementById("titleEror").innerText = "Veuillez entrer un title valide (lettres uniquement).";
        document.getElementById("title").classList.add("invalid");
        valid = false;
    }

    
    const subjects = document.getElementById("supjects").value.trim();
    if (subjects === "" || !/^[a-zA-Z\s]+$/.test(subjects)) {
        document.getElementById("subjectsError").innerText = "Veuillez entrer un subject valide (lettres uniquement).";
        document.getElementById("subjects").classList.add("invalid");
        valid = false;
    }


    // Validation de l'adminuser
    const adminuser = document.getElementById("adminuser").value.trim();
    const adminuserPattern = /^[a-zA-Z0-9._-]+$/;
    if (adminuser === "" || !adminuserPattern.test(adminuser)) {
        document.getElementById("adminuserError").innerText = "Veuillez entrer un adminuser valide (ex: exemple@domaine.com).";
        document.getElementById("adminuser").classList.add("invalid");
        valid = false;
    }

    // Si le formulaire est valide, on permet l'envoi
    return valid;
}



