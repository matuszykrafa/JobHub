const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const repeatPasswordInput = form.querySelector('input[name="repeat_password"]');
const loginInput = form.querySelector('input[name="login"]');
const companyInput = form.querySelector('input[name="company"]');

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    const condition = /\S+@\S+\.\S+/.test(emailInput.value);
    markValidation(emailInput, condition);
}

function validatePassword() {
    const condition = repeatPasswordInput.previousElementSibling.value === repeatPasswordInput.value;
    markValidation(repeatPasswordInput, condition);
}

function validateLogin() {
    const condition = loginInput.value.length >= 5;
    markValidation(loginInput, condition);
}

function validateCompany() {
    const condition = companyInput.value.length >= 5;
    markValidation(companyInput, condition);
}

emailInput.addEventListener('focusout', validateEmail);
repeatPasswordInput.addEventListener('focusout', validatePassword);
loginInput.addEventListener('focusout', validateLogin);
companyInput.addEventListener('focusout', validateCompany);