document.addEventListener("DOMContentLoaded", function() {
    let valid = true;

    const nomElement = document.getElementById("nom");
    const prenomElement = document.getElementById("prenom");
    const emailElement = document.getElementById("email");
    const telephoneElement = document.getElementById("telephone");
    const messageElement = document.getElementById("messages");
    const formElement = document.getElementById("addreclamationForm"); // Assuming your form has an ID of "myForm"

    function validateForm() {
        valid = true; // Reset valid status

        // Validate Nom
        const nomErrorElement = document.getElementById("nom_error");
        const nomErrorValue = nomElement.value;
        const nomPattern = /^[a-zA-Z\s]{3,}$/;
        if (!nomPattern.test(nomErrorValue)) {
            nomErrorElement.innerHTML = "Le nom doit contenir uniquement des lettres et des espaces et au moins 3 caractères";
            nomErrorElement.style.color = "red";
            valid = false;
        } else {
            nomErrorElement.innerHTML = "Correct";
            nomErrorElement.style.color = "green";
        }

        // Validate Prénom
        const prenomErrorElement = document.getElementById("prenom_error");
        const prenomErrorValue = prenomElement.value;
        const prenomPattern = /^[a-zA-Z\s]{3,}$/;
        if (!prenomPattern.test(prenomErrorValue)) {
            prenomErrorElement.innerHTML = "Le prénom doit contenir uniquement des lettres et des espaces et au moins 3 caractères";
            prenomErrorElement.style.color = "red";
            valid = false;
        } else {
            prenomErrorElement.innerHTML = "Correct";
            prenomErrorElement.style.color = "green";
        }

        // Validate Email
        const emailErrorElement = document.getElementById("email_error");
        const emailErrorValue = emailElement.value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailErrorValue)) {
            emailErrorElement.innerHTML = "L'email doit être valide.";
            emailErrorElement.style.color = "red";
            valid = false;
        } else {
            emailErrorElement.innerHTML = "Correct";
            emailErrorElement.style.color = "green";
        }

        // Validate Téléphone
        const telephoneErrorElement = document.getElementById("telephone_error");
        const telephoneErrorValue = telephoneElement.value;
        const telephonePattern = /^\d{8}$/;
        if (!telephonePattern.test(telephoneErrorValue)) {
            telephoneErrorElement.innerHTML = "Le téléphone doit être composé de 8 chiffres.";
            telephoneErrorElement.style.color = "red";
            valid = false;
        } else {
            telephoneErrorElement.innerHTML = "Correct";
            telephoneErrorElement.style.color = "green";
        }

        // Validate Message
        const messageErrorElement = document.getElementById("messages_error");
        const messageErrorValue = messageElement.value;
        if (messageErrorValue.length < 3) {
            messageErrorElement.innerHTML = "Le message doit contenir au moins 3 caractères.";
            messageErrorElement.style.color = "red";
            valid = false;
        } else {
            messageErrorElement.innerHTML = "Correct";
            messageErrorElement.style.color = "green";
        }

        console.log("valid", valid);
        
        return valid;
    }

    // Add event listeners for real-time validation
    nomElement.addEventListener("keyup", validateForm);
    prenomElement.addEventListener("keyup", validateForm);
    emailElement.addEventListener("keyup", validateForm);
    telephoneElement.addEventListener("keyup", validateForm);
    messageElement.addEventListener("keyup", validateForm);

    // Handle form submission
    formElement.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
            alert("Veuillez corriger les erreurs dans le formulaire."); // Optional alert
        } else {
            
        }
    });
});