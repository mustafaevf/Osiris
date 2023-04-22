<? top('Авторизация');
if($_SESSION['auth'] == 1) {
    header('Location: /');
}

?>

<main>
    <div class="block-auth">
        <h3>Авторизация</h3>
        <div class="input">
            <p>Логин</p>
            <input type="text" placeholder="Имя пользователя" id="auth-login" onkeyup="filterAuthLogin()">
        </div>
        <div class="input">
            <p>Пароль</p>
            <input type="password" placeholder="Пароль" id="auth-password" onkeyup="filterAuthPassword()">
        </div>
        <div class="btn-inline-block">
            <button class="btn btn-line" onclick="login()">Войти</button>
            <button class="btn btn-neutral" onclick="href('register')">Регистрация</button>
        </div>
        <button class="btn btn-neutral" onclick="href('recovery')">Восстановить доступ</button>
    </div>
</main>
<? footer() ?> 