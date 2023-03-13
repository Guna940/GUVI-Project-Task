$(document).ready(function () {
    $("#myForm").validate();
});

$('#submit').on('click', function () {
    $.ajax({
        type: 'GET',
        url: 'php/register.php',
        data: $('#myForm').serialize(),
        success: function (response) {
            alert("Your Successfully Signup");
            console.log(response);
        },
        error: function () {
            alert("error")
        }
    }).done(function () {
        var url = "http://localhost/GUVI-Project-master/login.html";
        $(location).attr('href', url);
    });
})
