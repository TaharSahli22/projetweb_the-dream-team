document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".wrapper");
    const signupHeader = document.querySelector(".form.signup header");
    const loginHeader = document.querySelector(".form.login header");

    loginHeader.addEventListener("click", () => {
        wrapper.classList.add("active");
    });

    signupHeader.addEventListener("click", () => {
        wrapper.classList.remove("active");
    });

    document.getElementById("role").addEventListener("change", toggleRole);
    document.getElementById("signupForm").addEventListener("submit", submitForm);
    document.getElementById("loginForm").addEventListener("submit", validatelogin);


    const createPopup = (message, status) => {
        const container = document.getElementById("popup-container");
        if (!container) return; // Fallback in case the container is not found.

        const popup = document.createElement("div");
        popup.className = `popup ${status}`;
        popup.textContent = message;

        container.appendChild(popup);
        setTimeout(() => popup.classList.add("show"), 10);
        setTimeout(() => {
            popup.classList.remove("show");
            setTimeout(() => popup.remove(), 300);
        }, 3000);
    };



    function validateForm(event) {
        const nom = document.getElementById("firstName");
        const prenom = document.getElementById("secondName");
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const confirm = document.getElementById("cpassword");
        let isValid = true;

        function isStringValid(ch) {
            return /^[A-Za-z]+$/.test(ch);
        }

        function removeShakeAnimation(element) {
            element.addEventListener("animationend", () => {
                element.classList.remove("error");
            });
        }

        if (!isStringValid(nom.value) || nom.value.trim() === "") {
            nom.value = "";
            nom.placeholder = "Prénom non valide";
            nom.classList.add("error");
            removeShakeAnimation(nom);
            isValid = false;
        }

        if (!isStringValid(prenom.value) || prenom.value.trim() === "") {
            prenom.value = "";
            prenom.placeholder = "Nom non valide";
            prenom.classList.add("error");
            removeShakeAnimation(prenom);
            isValid = false;
        }

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email.value)) {
            email.value = "";
            email.placeholder = "Adresse email non valide";
            email.classList.add("error");
            removeShakeAnimation(email);
            isValid = false;
        }


        const lengthCriteria = password.value.length >= 8;
        const uppercaseCriteria = /[A-Z]/.test(password.value);
        const numberCriteria = /\d/.test(password.value);
        const specialCharCriteria = /[!@#$%^&*(),.?":{}|<>]/.test(password.value);

        if (!lengthCriteria || !uppercaseCriteria || !numberCriteria || !specialCharCriteria) {
            password.classList.add("error");
            removeShakeAnimation(password);
            createPopup("Votre mot de passe ne respecte pas les critères", "error");
            isValid = false;
        }

        if (password.value !== confirm.value) {
            confirm.classList.add("error");
            removeShakeAnimation(confirm);
            createPopup("Les mots de passe ne correspondent pas", "error");
            isValid = false;
        }

        return isValid;
    }

    async function submitForm(event) {
        event.preventDefault();
        const form = document.getElementById("signupForm");
        const formData = new FormData(form);

        try {
            const response = await fetch("../PHP/sign_in.php", {
                method: "POST",
                body: formData,
            });

            if (!response.ok) {
                const errorData = await response.json();
                createPopup(errorData.message || "An error occurred.", "error");
                return;
            }

            const data = await response.json();
            if (data.success) {
                createPopup(data.message || "Operation successful!", "success");
            } else {
                createPopup(data.message || "An error occurred.", "error");
            }
        } catch (error) {
            console.error("Error:", error);
            createPopup("Failed to communicate with the server.", "error");
        }
    }


    async function validatelogin(event) {
        event.preventDefault();
        const email = document.getElementById("loginEmail");
        const password = document.getElementById("loginPassword");
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let isValid = true;

        if (!emailRegex.test(email.value)) {
            email.value = "";
            email.placeholder = "Adresse email non valide";
            email.classList.add("error");
            removeShakeAnimation(email);
            isValid = false;
        }

        const lengthCriteria = password.value.length >= 8;
        const uppercaseCriteria = /[A-Z]/.test(password.value);
        const numberCriteria = /\d/.test(password.value);
        const specialCharCriteria = /[!@#$%^&*(),.?":{}|<>]/.test(password.value);

        if (!lengthCriteria || !uppercaseCriteria || !numberCriteria || !specialCharCriteria) {
            password.classList.add("error");
            removeShakeAnimation(password);
            createPopup("Votre mot de passe ne respecte pas les critères", "error");
            isValid = false;
        }
    }

    function removeShakeAnimation(element) {
        element.addEventListener("animationend", () => {
            element.classList.remove("error");
        });
    }
});