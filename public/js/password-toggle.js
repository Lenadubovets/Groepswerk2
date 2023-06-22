function togglePasswordVisibility() {
    var passwordField = document.getElementById("new_password");
    var passwordToggle = document.getElementById("password_toggle");

    var isPasswordVisible = (passwordField.type === "text");

    if (isPasswordVisible) {
        passwordField.type = "password";
        passwordToggle.classList.remove("fa-eye");
        passwordToggle.classList.add("fa-eye-slash");
    } else {
        passwordField.type ="text";
        passwordToggle.classList.remove("fa-eye-slash");
        passwordToggle.classList.add("fa-eye");
    }
}