function checkPasswords() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('cpassword').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}

document.getElementById('registerForm').addEventListener('submit', function(event) {
    if (!checkPasswords()) {
        event.preventDefault();
    }
});