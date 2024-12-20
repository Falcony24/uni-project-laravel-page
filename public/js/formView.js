function showLoginForm() {
    $("#formLogin").show();
    $("#formRegister").hide();
    $("#loginBtn").addClass("active");
    $("#registerBtn").removeClass("active");
}

function showRegisterForm() {
    $("#formRegister").show();
    $("#formLogin").hide();
    $("#registerBtn").addClass("active");
    $("#loginBtn").removeClass("active");
}

$(document).ready(function() {
    $("#loginBtn").click(function() {
        showLoginForm();
    });

    $("#registerBtn").click(function() {
        showRegisterForm();
    });
});
