<?php

session_start();

$db = new PDO(
    'mysql:host=localhost;dbname=hostel; charset=utf8',
    'root',
    null,
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
    header('Location: login.php');
    exit();
}

$token = $_SESSION['token'];
$user = $db->query("SELECT id, type, isBlocked, name, surname FROM users WHERE token = '$token'")->fetch();

if (!$user) {
    header('Location: login.php');
    exit();
}

if ($user['isBlocked'] == '1') {
    $stmt = $db->prepare("UPDATE users SET token = NULL WHERE id = ?");
    $stmt->execute([$user['id']]);
    
    $_SESSION = [];
    session_destroy();
    
    header('Location: login.php?error=blocked');
    exit();
}

if ($user['type'] === 'admin') {
    header('Location: admin.php');
    exit();
}

$message = '';
$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['password'] ?? '';
    
    if (empty($newPassword) || empty($confirmPassword)) {
        $error = 'Оба поля должны быть заполнены';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'Пароли не совпадают';
    } else {
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $result = $stmt->execute([$newPassword, $user['id']]);
        
        if ($result) {
            $success = true;
            $message = 'Пароль успешно изменен';
        } else {
            $error = 'Ошибка при обновлении пароля';
        }
    }
}

$userFullName = trim(($user['name'] ?? '') . ' ' . ($user['surname'] ?? ''));
$userFullName = !empty($userFullName) ? $userFullName : 'Пользователь';
$userType = $user['type'] === 'admin' ? 'Администратор' : 'Пользователь';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение пароля</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1>Система управления кафе</h1>
            <div class="user-info">
                <span><?php echo htmlspecialchars($userFullName); ?></span> | 
                <span><?php echo htmlspecialchars($userType); ?></span>
                <a href="logout.php"><button class="logout-button">Выйти</button></a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="login">
            <h2 class="login-title">Изменение пароля</h2>
            
            <?php if ($success): ?>
                <p class="success-message"><?php echo $message; ?></p>
            <?php endif; ?>
            
            <?php if (!empty($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <form action="" method="POST" id="passwordForm">
                <div class="form-group">
                    <label for="new_password">Новый пароль</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="password">Подтвердите пароль</label>
                    <input type="password" id="password" name="password" required>  
                </div>
                <p class="notcorrect" style="color: red; text-align: center; margin-bottom: 1rem;">Пароли не совпадают</p>
                
                <div class="button-container">
                    <button type="submit" class="login-button">Изменить пароль</button>
                    <a href="user.php"><button type="button">Вернуться</button></a>
                </div>
            </form>
        </div>
    </div>
    
    <footer class="main-footer">
        <div class="container">
        </div>
    </footer>

    <script>
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('password').value;
            
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                document.querySelector('.notcorrect').style.display = 'block';
            }
        });
    </script>
</body>
</html> 