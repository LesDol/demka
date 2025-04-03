<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                <h1>Админ-панель</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <!-- <li><a href="admin.php" class="active">Пользователи</a></li>
                    <li><a href="#">Настройки</a></li>
                    <li><a href="#">Статистика</a></li>
                    <li><a href="login.php">Выйти</a></li> -->
                </ul>
            </nav>
        </div>
    </header>

    <div class="admin-container">
        <h1 class="admin-title">Управление пользователями</h1>
        
        <div class="admin-actions">
            <button class="add-user-button">Добавить пользователя</button>
            <!-- <div class="search-box">
                <input type="text" placeholder="Поиск пользователя...">
                <button class="search-button">Поиск</button>
            </div> -->
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Статус</th>
                    <th>Дата регистрации</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>user1</td>
                    <td>user1@example.com</td>
                    <td>Пользователь</td>
                    <td>Активен</td>
                    <td>01.01.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>user2</td>
                    <td>user2@example.com</td>
                    <td>Администратор</td>
                    <td>Активен</td>
                    <td>15.02.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ivanov</td>
                    <td>ivanov@example.com</td>
                    <td>Пользователь</td>
                    <td>Активен</td>
                    <td>10.03.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>petrov</td>
                    <td>petrov@example.com</td>
                    <td>Пользователь</td>
                    <td>Заблокирован</td>
                    <td>22.04.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>sidorov</td>
                    <td>sidorov@example.com</td>
                    <td>Модератор</td>
                    <td>Активен</td>
                    <td>05.05.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>admin</td>
                    <td>admin@example.com</td>
                    <td>Администратор</td>
                    <td>Активен</td>
                    <td>01.01.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>moderator</td>
                    <td>moderator@example.com</td>
                    <td>Модератор</td>
                    <td>Активен</td>
                    <td>15.06.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>guest</td>
                    <td>guest@example.com</td>
                    <td>Гость</td>
                    <td>Активен</td>
                    <td>30.07.2023</td>
                    <td class="action-buttons">
                        <button class="edit-button">Редактировать</button>
                        <button class="delete-button">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- <div class="pagination">
            <button class="pagination-button">1</button>
            <button class="pagination-button active">2</button>
            <button class="pagination-button">3</button>
            <button class="pagination-button">4</button>
            <button class="pagination-button">5</button>
        </div> -->
    </div>

    <!-- Футер сайта -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-info">
                <p>&copy; 2023 Админ-панель. Все права защищены.</p>
            </div>
            <div class="footer-links">
                <!-- <a href="#">Политика конфиденциальности</a>
                <a href="#">Условия использования</a>
                <a href="#">Контакты</a> -->
            </div>
        </div>
    </footer>
</body>
</html> 