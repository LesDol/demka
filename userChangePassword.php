<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение пароля</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Изменение пароля пользователя</h1>
  
        <form action="" method="POST" id="passwordForm">
            <div class="form-group">
                <label for="new_password">Введите новый пароль</label>
                <input type="text" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="password">Подтвердите пароль</label>
                <input type="password" id="password" name="password" required>  
            </div>
            <p class="notcorrect" style="color: red; text-align: center; margin-bottom: 1rem;">Попробуйте снова</p>
            <button type="submit" class="login-button">Изменить пароль</button>
        </form>
    </div>

    <!-- Модальное окно "Пароль изменен" -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-title">Пароль успешно изменен</h2>
            <button class="modal-button" onclick="closeModal('successModal')">OK</button>
        </div>
    </div>

    <!-- Модальное окно "Вы заблокированы" -->
    <div id="blockedModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-title">Вы заблокированы</h2>
            <p>Ваш аккаунт был заблокирован из-за превышения количества попыток.</p>
            <button class="modal-button" onclick="closeModal('blockedModal')">OK</button>
        </div>
    </div>

    <script>
        // Функция для открытия модального окна
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        // Функция для закрытия модального окна
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Обработчик отправки формы
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Здесь можно добавить логику проверки паролей
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('password').value;
            
            if (newPassword === confirmPassword) {
                // Если пароли совпадают, показываем окно успеха
                openModal('successModal');
            } else {
                // Если пароли не совпадают, можно показать сообщение об ошибке
                document.querySelector('.notcorrect').style.display = 'block';
            }
        });

        // Закрытие модального окна при клике вне его области
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html> 