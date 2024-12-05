document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const bankName = document.getElementById('bankName');
    const accountNumber = document.getElementById('accountNumber');
    const iban = document.getElementById('iban');
    const donationAmount = document.getElementById('donationAmount');

    const validateFullName = () => {
        if (fullName.value.trim() === '' || fullName.value.length < 3) {
            showError(fullName, 'Full Name must be at least 3 characters long.');
            return false;
        }
        showSuccess(fullName);
        return true;
    };

    const validateEmail = () => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            showError(email, 'Please enter a valid email address.');
            return false;
        }
        showSuccess(email);
        return true;
    };

    const validatePhone = () => {
        const phoneRegex = /^\+?[0-9]{10,15}$/;
        if (!phoneRegex.test(phone.value.trim())) {
            showError(phone, 'Please enter a valid phone number.');
            return false;
        }
        showSuccess(phone);
        return true;
    };

    const validateBankName = () => {
        if (bankName.value.trim() === '') {
            showError(bankName, 'Bank Name is required.');
            return false;
        }
        showSuccess(bankName);
        return true;
    };

    const validateAccountNumber = () => {
        if (accountNumber.value.trim() === '' || isNaN(accountNumber.value)) {
            showError(accountNumber, 'Please enter a valid account number.');
            return false;
        }
        showSuccess(accountNumber);
        return true;
    };

    const validateIBAN = () => {
        const ibanRegex = /^[A-Z0-9]{15,34}$/;
        if (!ibanRegex.test(iban.value.trim())) {
            showError(iban, 'Please enter a valid IBAN.');
            return false;
        }
        showSuccess(iban);
        return true;
    };

    const validateDonationAmount = () => {
        if (donationAmount.value.trim() === '' || parseFloat(donationAmount.value) <= 0) {
            showError(donationAmount, 'Please enter a donation amount greater than 0.');
            return false;
        }
        showSuccess(donationAmount);
        return true;
    };

    const showError = (input, message) => {
        const formControl = input.parentElement;
        formControl.className = 'mb-3 error';
        const small = formControl.querySelector('small');
        if (small) {
            small.innerText = message;
        } else {
            const errorText = document.createElement('small');
            errorText.className = 'text-danger';
            errorText.innerText = message;
            formControl.appendChild(errorText);
        }
    };

    const showSuccess = (input) => {
        const formControl = input.parentElement;
        formControl.className = 'mb-3 success';
        const small = formControl.querySelector('small');
        if (small) {
            small.remove();
        }
    };

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const isFullNameValid = validateFullName();
        const isEmailValid = validateEmail();
        const isPhoneValid = validatePhone();
        const isBankNameValid = validateBankName();
        const isAccountNumberValid = validateAccountNumber();
        const isIBANValid = validateIBAN();
        const isDonationAmountValid = validateDonationAmount();

        if (
            isFullNameValid &&
            isEmailValid &&
            isPhoneValid &&
            isBankNameValid &&
            isAccountNumberValid &&
            isIBANValid &&
            isDonationAmountValid
        ) {
            form.submit();
        }
    });

    fullName.addEventListener('input', validateFullName);
    email.addEventListener('input', validateEmail);
    phone.addEventListener('input', validatePhone);
    bankName.addEventListener('input', validateBankName);
    accountNumber.addEventListener('input', validateAccountNumber);
    iban.addEventListener('input', validateIBAN);
    donationAmount.addEventListener('input', validateDonationAmount);
});
