<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/styles/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Восстановление доступа</title>
    </head>
    <body> 
        <div class="container">
            <div class="block-auth">
                <h3>Восстановление доступа</h3>
                <div class="input">
                    <p>Почта</p>
                    <input type="email" placeholder="Введите почту" id="auth-email" onkeyup="filterAuthEmail()">
                </div>
                <div class="btn-inline-block">
                    <button class="btn btn-line" onclick="recovery()">Восстановить</button>
                    <button class="btn btn-neutral" onclick="href('register')">Регистрация</button>
                </div>
                <button class="btn btn-neutral" onclick="href('login')">Авторизация</button>
            </div>
        </div>
        
    </body>
    
    <script src="public/scripts/script.js"></script>
</html>