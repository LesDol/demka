<?php
session_start();

// Проверка авторизации администратора
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
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

// Проверка, что пользователь является администратором
$token = $_SESSION['token'];
$admin = $db->query("SELECT id, type FROM users WHERE token = '$token'")->fetch();

if (!$admin || $admin['type'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Получение параметров
$userId = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if (!$userId || !$action || !in_array($action, ['block', 'unblock'])) {
    header('Location: admin.php?error=invalid_params');
    exit();
}

try {
    // Проверяем существование пользователя
    $stmt = $db->prepare("SELECT id, type FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $targetUser = $stmt->fetch();

    if (!$targetUser) {
        header('Location: admin.php?error=user_not_found');
        exit();
    }

    // Нельзя заблокировать администратора
    if ($targetUser['type'] === 'admin') {
        header('Location: admin.php?error=cannot_block_admin');
        exit();
    }

    // Обновляем статус блокировки
    $isBlocked = $action === 'block' ? '1' : '0';
    $stmt = $db->prepare("UPDATE users SET isBlocked = ?, token = NULL, amountAttempt = 0 WHERE id = ?");
    $stmt->execute([$isBlocked, $userId]);

    // Перенаправляем обратно с сообщением об успехе
    $message = $action === 'block' ? 'blocked' : 'unblocked';
    header('Location: admin.php?success=' . $message);
    exit();

} catch (PDOException $e) {
    // В случае ошибки перенаправляем с сообщением об ошибке
    header('Location: admin.php?error=db_error');
    exit();
}
?> 