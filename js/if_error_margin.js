window.onload = function() {
    var errors = document.getElementsByClassName('error');
    var register = document.getElementsByClassName('register')[0];

    if (errors.length > 0) {
        register.style.marginTop = '60px'; // Change this to the amount of space you want
    }
};