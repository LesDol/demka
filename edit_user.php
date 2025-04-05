<?php
session_start();

// Проверка авторизации
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

// Получение информации о пользователе
$token = $_SESSION['token'];
$user = $db->query("SELECT id, type FROM users WHERE token = '$token'")->fetch();

// Проверка роли администратора
if (!$user || $user['type'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin.php');
    exit();
}

// Получение данных из формы
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$type = $_POST['type'] ?? '';

// Валидация
if (empty($id) || empty($login) || empty($type)) {
    header('Location: admin.php?error=missing_fields');
    exit();
}

// Обновление данных пользователя
if (empty($password)) {
    // Обновление без изменения пароля
    $stmt = $db->prepare("UPDATE users SET name = ?, surname = ?, login = ?, type = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $login, $type, $id]);
} else {
    // Обновление с изменением пароля
    $stmt = $db->prepare("UPDATE users SET name = ?, surname = ?, login = ?, password = ?, type = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $login, $password, $type, $id]);
}

// Перенаправление обратно на страницу администратора
header('Location: admin.php?success=user_updated');
exit(); 