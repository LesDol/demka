<?php
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=hostel; charset=utf8',
        'root',
        null,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    // Добавляем колонку amountAttempt
    $db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS amountAttempt INT DEFAULT 0");
    echo "Колонка amountAttempt успешно добавлена<br>";

    // Добавляем колонку latest
    $db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS latest DATETIME DEFAULT NULL");
    echo "Колонка latest успешно добавлена<br>";

    echo "<br>База данных успешно обновлена!<br>";
    echo "<a href='login.php'>Вернуться на страницу входа</a>";

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?> 