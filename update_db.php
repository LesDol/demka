<?php
$db = new PDO(
    'mysql:host=localhost;dbname=hostel; charset=utf8',
    'root',
    null,
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

// Добавляем новые поля в таблицу users
$alterQueries = [
    "ALTER TABLE users ADD COLUMN IF NOT EXISTS amountAttempt INT DEFAULT 0",
    "ALTER TABLE users ADD COLUMN IF NOT EXISTS latest DATETIME DEFAULT NULL"
];

foreach ($alterQueries as $query) {
    try {
        $db->exec($query);
        echo "Успешно выполнен запрос: " . $query . "<br>";
    } catch (PDOException $e) {
        echo "Ошибка при выполнении запроса: " . $query . "<br>";
        echo "Сообщение об ошибке: " . $e->getMessage() . "<br>";
    }
}

echo "<br><a href='login.php'>Вернуться на страницу входа</a>";
?> 