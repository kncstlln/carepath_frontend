function validateForm() {
    var userName = document.getElementById("userName").value;
    var password = document.getElementById("password").value;

    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");

    // Reset previous error messages
    usernameError.style.display = "none";
    passwordError.style.display = "none";

    var isValid = true;

    if (userName === "") {
        usernameError.style.display = "block";
        isValid = false;
    }

    if (password === "") {
        passwordError.style.display = "block";
        isValid = false;
    }

    if (isValid) {
        // Perform your login logic here
        alert("Form submitted successfully!");
    }
}



