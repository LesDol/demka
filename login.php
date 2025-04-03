<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Авторизация</h1>
        <div class="admin_user">
            <a href="admin.php">Админcтратор</a>
            <a href="user.php">Пользователь</a>
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Введите логин</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Введите пароль</label>
                <input type="password" id="password" name="password" required>  
            </div>
            <p class="notcorrect" style="color: red; text-align: center; margin-bottom: 1rem;">Неверный логин или пароль</p>
            <button type="submit" class="login-button">Войти</button>
        </form>

    </div>
</body>
</html> 