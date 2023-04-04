
function href(link) {
    window.location.href = link;
}

function login() {
    result = $('#auth-login').val();
    alert(result)
}

function register() {
    const username = $('#auth-login').val();
    const email = $('#auth-email').val();
    const password = $('#auth-password').val();
    const rePassword = $('#auth-re-password').val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(username.length < 2 || email.length == 0 || password.length < 6 || password !== rePassword || !emailRegex.test(email)) {
        alert('заполните все поля');
        return;
    }
  
    $.ajax({
      url: 'core/auth/register.php', 
      type: 'POST',
      data: {
        username: username,
        email: email,
        password: password
      },
      success: function(response) {
        alert(response);
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        alert('Ошибка при отправке данных на сервер!');
      }
    });
}

function filterAuthLogin() {
    const loginValue = $('#auth-login').val();
    const filteredValue = loginValue.replace(/[^a-zA-Z0-9]/g, '');
    if(loginValue.length > 2) {
        $('#auth-login').css('border', '1px solid rgba(0,0,0,.1)');
    } else {
        $('#auth-login').css('border', '1px solid red');
    }
    if (loginValue !== filteredValue) {
        $('#auth-login').val(filteredValue);
    }
}
function filterAuthPassword() {
    const passwordInput = $('#auth-password');
    const passwordValue = $('#auth-password').val();
    if(passwordValue.length < 6) {
        passwordInput.css('border', '1px solid red');
    } else {
        passwordInput.css('border', '1px solid rgba(0,0,0,.1)');
    }
}

function filterAuthEmail() {
    const emailValue = $("#auth-email").val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (!emailRegex.test(emailValue)) {
      
      $("#auth-email").css('border', '1px solid red');
    } else {
      
      $("#auth-email").css('border', '1px solid rgba(0,0,0,.1)');
    }
}