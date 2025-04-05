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

// Если есть токен, удаляем его из БД
if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
    $token = $_SESSION['token'];
    $stmt = $db->prepare("UPDATE users SET token = NULL WHERE token = ?");
    $stmt->execute([$token]);
}

// Очищаем сессию
$_SESSION = [];

// Уничтожаем сессию, если используются cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Удаляем сессию
session_destroy();

// Перенаправляем на страницу входа
header('Location: login.php');
exit();
?> 