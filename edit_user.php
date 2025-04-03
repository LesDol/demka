<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
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
        <h1 class="admin-title">Редактирование пользователя</h1>
        
        <form class="user-form" action="" method="POST">
            <input type="hidden" name="user_id" value="1">
            
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" value="user1" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="user1@example.com" required>
            </div>
            
            <div class="form-group">
                <label for="password">Новый пароль</label>
                <input type="password" id="password" name="password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Подтвердите новый пароль</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            
            
            
            <div class="form-actions">
                <button type="submit" class="submit-button">Сохранить изменения</button>
                <a href="admin.php" class="cancel-button">Отмена</a>
            </div>
        </form>
    </div>

    <footer class="site-footer">

    </footer>
</body>
</html> 