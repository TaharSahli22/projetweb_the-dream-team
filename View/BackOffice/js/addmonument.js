document.addEventListener("DOMContentLoaded", function () {
    // Récupération des éléments des champs et des erreurs
    const nameElement = document.getElementById("name");
    const descriptionElement = document.getElementById("description");
    const priceElement = document.getElementById("price");
    const imageElement = document.getElementById("image");

    const nameErrorElement = document.getElementById("name_error");
    const descriptionErrorElement = document.getElementById("description_error");
    const priceErrorElement = document.getElementById("price_error");
    const imageErrorElement = document.getElementById("user_error");

    // Validation du champ "name"
    nameElement.addEventListener("keyup", function () {
        const nameValue = nameElement.value.trim();
        if (nameValue.length < 3) {
            nameErrorElement.textContent = "Le nom doit contenir au moins 3 caractères.";
            nameErrorElement.style.color = "red";
        } else {
            nameErrorElement.textContent = "Correct.";
            nameErrorElement.style.color = "green";
        }
    });

    // Validation du champ "description"
    descriptionElement.addEventListener("keyup", function () {
        const descriptionValue = descriptionElement.value.trim();
        if (descriptionValue.length < 10) {
            descriptionErrorElement.textContent = "La description doit contenir au moins 10 caractères.";
            descriptionErrorElement.style.color = "red";
        } else {
            descriptionErrorElement.textContent = "Correct.";
            descriptionErrorElement.style.color = "green";
        }
    });

    // Validation du champ "price"
    priceElement.addEventListener("keyup", function () {
        const priceValue = priceElement.value.trim();
        if (!/^\d+(\.\d{1,2})?$/.test(priceValue) || parseFloat(priceValue) <= 0) {
            priceErrorElement.textContent = "Le prix doit être un nombre positif avec jusqu'à deux décimales.";
            priceErrorElement.style.color = "red";
        } else {
            priceErrorElement.textContent = "Correct.";
            priceErrorElement.style.color = "green";
        }
    });

    // Validation du champ "image"
    imageElement.addEventListener("keyup", function () {
        const imageValue = imageElement.value.trim();
        const pattern = /\.(jpg|jpeg|png|gif)$/i;
        if (!pattern.test(imageValue)) {
            imageErrorElement.textContent = "L'image doit être un fichier valide (jpg, jpeg, png, gif).";
            imageErrorElement.style.color = "red";
        } else {
            imageErrorElement.textContent = "Correct.";
            imageErrorElement.style.color = "green";
        }
    });
});
