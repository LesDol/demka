<?php session_start();

$db = new PDO(
    'mysql:host=localhost;dbname=hostel; charset=utf8',
    'root',
    null,
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

// Проверка : существует ли токен и что он не пустой
if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
    $token = $_SESSION['token'];
    //
    $user = $db->query("SELECT id, type, isBlocked FROM users WHERE token = '$token'")->fetchAll();
    if (!empty($user)) {
        // Проверяем, не заблокирован ли пользователь
        if ($user[0]['isBlocked'] == '1') {
            // Если заблокирован, удаляем токен
            $userId = $user[0]['id'];
            $stmt = $db->prepare("UPDATE users SET token = NULL WHERE id = ?");
            $stmt->execute([$userId]);
            
            // Очищаем сессию
            $_SESSION = [];
            session_destroy();
            
            // Сообщение об ошибке
            $error = 'Ваш аккаунт заблокирован администратором';
        } else {
            $userType = $user[0]['type'];
            $isAdmin = $userType == 'admin';
            $isUser = $userType == 'user';
            
            if ($isAdmin) {
                header('Location: admin.php');
                exit();
            } else if ($isUser) {
                header('Location: user.php');
                exit();
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    // Проверка заполнения полей
    if (empty($login) || empty($password)) {
        $error = 'Поля необходимо заполнить';
    } else {
        // Проверка логина и пароля в БД
        $stmt = $db->prepare("SELECT id, type, isBlocked FROM users WHERE login = ? AND password = ?");
        $stmt->execute([$login, $password]);
        $user = $stmt->fetch();

        if ($user) {
            // Проверяем, не заблокирован ли пользователь
            if ($user['isBlocked'] == '1') {
                $error = 'Ваш аккаунт заблокирован администратором';
            } else {
                // Генерация токена
                $token = bin2hex(random_bytes(32));
                
                // Сохранение токена в БД
                $stmt = $db->prepare("UPDATE users SET token = ? WHERE id = ?");
                $stmt->execute([$token, $user['id']]);
                
                // Сохранение токена в сессии
                $_SESSION['token'] = $token;
                
                // Редирект в зависимости от типа пользователя
                if ($user['type'] === 'admin') {
                    header('Location: admin.php');
                } else {
                    header('Location: userChangePassword.php');
                }
                exit();
            }
        } else {
            $error = 'Неверный логин или пароль';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация - Кафе</title>
    
</head>
<body>
    <div class="login">
        <form action="login.php" method="post">
            <h1>Авторизация</h1>
            <label for="login">
                Введите логин
            </label>
            <input type="text" name="login" id="login" required>
            <label for="password">
                Введите пароль
            </label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Вход</button>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>