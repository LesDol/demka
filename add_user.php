<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                <h1>Админ-панель</h1>
            </div>

        </div>
    </header>

    <div class="admin-container">
        <h1 class="admin-title">Добавление нового пользователя</h1>
        
        <form class="user-form" action="" method="POST">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            
            <div class="form-actions">
                <button type="submit" class="submit-button">Добавить пользователя</button>
                <a href="admin.php" class="cancel-button">Отмена</a>
            </div>
        </form>
    </div>

    <footer class="site-footer">
        <div class="footer-container">
  
        </div>
    </footer>
</body>
</html> 