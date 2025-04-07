<?php
session_start();

if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
    header('Location: login.php');
    exit();
}

$db = new PDO(
    'mysql:host=localhost;dbname=hostel; charset=utf8',
    'root',
    null,
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$token = $_SESSION['token'];
$user = $db->query("SELECT id, type FROM users WHERE token = '$token'")->fetch();

if (!$user || $user['type'] !== 'admin') {
    header('Location: login.php');
    exit();
}


$users = $db->query("SELECT id, login, name, surname, type, isBlocked FROM users ORDER BY type, name")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора - Отель</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1>Система управления кафе</h1>
        </div>
    </header>
    
    <div class="container">
        <div class="admin-panel">
            <h2>Панель администратора</h2>
            
            <div class="header-buttons">
                <button id="addUserBtn">Добавить пользователя</button>
                <button id="logoutBtn" onclick="location.href='logout.php';">Выйти</button>
            </div>

            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Логин</th>
                        <th>Тип</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($user['surname'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($user['login']); ?></td>
                            <td><?php echo $user['type'] === 'admin' ? 'Администратор' : 'Пользователь'; ?></td>
                            <td>
                                <span class="status-<?php echo $user['isBlocked'] == '1' ? 'blocked' : 'active'; ?>">
                                    <?php echo $user['isBlocked'] == '1' ? 'Заблокирован' : 'Активен'; ?>
                                </span>
                            </td>
                            <td class="action-buttons">
                                <button class="edit-btn" data-id="<?php echo $user['id']; ?>">Редактировать</button>
                                <?php if ($user['isBlocked'] == '0' || $user['isBlocked'] === null): ?>
                                    <button class="delete-btn" data-id="<?php echo $user['id']; ?>">Удалить</button>
                                <?php else: ?>
                                    <button class="unblock-btn" data-id="<?php echo $user['id']; ?>">Разблокировать</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="addUserForm" class="panel-section" style="display: none;">
                <h3>Добавить пользователя</h3>
                <form id="userForm" action="add_user.php" method="post">
                    <div class="form-group">
                        <label for="userName">Имя:</label>
                        <input type="text" id="userName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="userSurname">Фамилия:</label>
                        <input type="text" id="userSurname" name="surname">
                    </div>
                    <div class="form-group">
                        <label for="userLogin">Логин:</label>
                        <input type="text" id="userLogin" name="login" required>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Пароль:</label>
                        <input type="password" id="userPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="userType">Тип пользователя:</label>
                        <select id="userType" name="type" required>
                            <option value="admin">Администратор</option>
                            <option value="user">Пользователь</option>
                        </select>
                    </div>
                    <button type="submit">Добавить</button>
                    <button type="button" id="cancelAddBtn">Отмена</button>
                </form>
            </div>

            <div id="editUserForm" class="panel-section" style="display: none;">
                <h3>Редактировать пользователя</h3>
                <form id="editForm" action="edit_user.php" method="post">
                    <input type="hidden" id="editUserId" name="id">
                    <div class="form-group">
                        <label for="editName">Имя:</label>
                        <input type="text" id="editName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="editSurname">Фамилия:</label>
                        <input type="text" id="editSurname" name="surname">
                    </div>
                    <div class="form-group">
                        <label for="editLogin">Логин:</label>
                        <input type="text" id="editLogin" name="login" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Новый пароль (оставьте пустым, если не хотите менять):</label>
                        <input type="password" id="editPassword" name="password">
                    </div>
                    <div class="form-group">
                        <label for="editType">Тип пользователя:</label>
                        <select id="editType" name="type" required>
                            <option value="admin">Администратор</option>
                            <option value="user">Пользователь</option>
                        </select>
                    </div>
                    <button type="submit">Сохранить изменения</button>
                    <button type="button" id="cancelEditBtn">Отмена</button>
                </form>
            </div>
        </div>
    </div>
    
    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2023 Система управления кафе</p>
        </div>
    </footer>

    <script>
        // Показать форму добавления пользователя
        document.getElementById('addUserBtn').addEventListener('click', function() {
            document.getElementById('addUserForm').style.display = 'block';
            document.getElementById('editUserForm').style.display = 'none';
        });
        
        // Скрыть форму добавления пользователя
        document.getElementById('cancelAddBtn').addEventListener('click', function() {
            document.getElementById('addUserForm').style.display = 'none';
        });
        
        // Скрыть форму редактирования пользователя
        document.getElementById('cancelEditBtn').addEventListener('click', function() {
            document.getElementById('editUserForm').style.display = 'none';
        });
        
        // Редактирование пользователя
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                // Получить информацию о пользователе для редактирования
                // В реальном приложении здесь должен быть AJAX-запрос
                // Сейчас просто показываем форму
                document.getElementById('editUserId').value = userId;
                document.getElementById('editUserForm').style.display = 'block';
                document.getElementById('addUserForm').style.display = 'none';
            });
        });
        
        // Удаление/блокировка пользователя
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                if (confirm('Вы уверены, что хотите удалить этого пользователя?')) {
                    location.href = 'block_user.php?id=' + userId + '&action=block';
                }
            });
        });
        
        // Разблокировка пользователя
        document.querySelectorAll('.unblock-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                if (confirm('Вы уверены, что хотите разблокировать этого пользователя?')) {
                    location.href = 'block_user.php?id=' + userId + '&action=unblock';
                }
            });
        });
    </script>
</body>
</html>