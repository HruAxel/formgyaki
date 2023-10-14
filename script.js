$('button').click(function (e) {
    e.preventDefault();

    let user = $('#name').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let password_confirmation = $('#password_confirmation').val();

    $.ajax({
        url: 'process.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            name: user,
            email: email,
            password: password,
            password_confirmation: password_confirmation
        }),

        success: function (response, status) {


            if (response.status == 'error') {
                $('#info').html(response.errors.map(err => `<li style = "color: red", "list-style: none">${err}</li>`).join(''));
            }
            else {
                $('#info').html(response.message);
            }
        }

    });

})