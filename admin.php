<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                <h1>Админ-панель</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="admin.php" class="active">Пользователи</a></li>
                    <li><a href="add_user.php">Добавить пользователя</a></li>
                    <li><a href="login.php">Выйти</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="admin-container">
        <h1 class="admin-title">Управление пользователями</h1>
        
        <div class="admin-actions">
            <a href="add_user.php" class="add-user-button">Добавить пользователя</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Пароль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>user1</td>
                    <td>user1@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=1" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>user2</td>
                    <td>user2@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=2" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>user3</td>
                    <td>user3@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=3" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>user4</td>
                    <td>user4@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=4" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>user5</td>
                    <td>user5@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=5" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>user6</td>
                    <td>user6@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=6" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>user7</td>
                    <td>user7@example.com</td>
                    <td>password1488</td>
                    <td class="action-buttons">
                        <a href="edit_user.php?id=7" class="edit-button">Редактировать</a>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-info">
                <p>&copy; 2023 Админ-панель. Все права защищены.</p>
            </div>
            <div class="footer-links">
                <a href="#">Политика конфиденциальности</a>
                <a href="#">Условия использования</a>
                <a href="#">Контакты</a>
            </div>
        </div>
    </footer>
</body>
</html> 