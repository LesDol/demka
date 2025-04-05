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
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$type = $_POST['type'] ?? '';

// Валидация
if (empty($login) || empty($password) || empty($type)) {
    header('Location: admin.php?error=missing_fields');
    exit();
}

// Проверка, существует ли уже пользователь с таким логином
$stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
$stmt->execute([$login]);
if ($stmt->fetchColumn() > 0) {
    header('Location: admin.php?error=login_exists');
    exit();
}

// Добавление нового пользователя
$stmt = $db->prepare("INSERT INTO users (name, surname, login, password, type, isBlocked) VALUES (?, ?, ?, ?, ?, '0')");
$stmt->execute([$name, $surname, $login, $password, $type]);

// Перенаправление обратно на страницу администратора
header('Location: admin.php?success=user_added');
exit(); 