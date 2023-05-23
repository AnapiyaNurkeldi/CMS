<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<style>
  .container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.container h1 {
  text-align: center;
  margin-bottom: 20px;
}

.container form {
  display: flex;
  flex-direction: column;
}

.container label {
  margin-bottom: 10px;
}

.container input[type="text"],
.container input[type="email"],
.container input[type="password"] {
  padding: 10px;
  border-radius: 3px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
}

.container input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px;
  border-radius: 3px;
  cursor: pointer;
}

.container input[type="submit"]:hover {
  background-color: #555;
}

.container p {
  text-align: center;
  margin-top: 10px;
}

.container p a {
  color: #333;
  text-decoration: underline;
}

.container p a:hover {
  color: #555;
}

</style>
<body>
  <div class="container">
    <h1>Регистрация</h1>
    <form action="/CMS/inc/user_signup.php" method="post">
      <label for="username">Имя пользователя:</label>
      <input type="text" id="username" name="name" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="password">Пароль:</label>
      <input type="password" id="password" name="password" required>
      
      <label for="password">Подвердите пароль:</label>
      <input type="password" id="password" name="cpassword" required>
      
      <input type="submit" value="Зарегистрироваться" name="reg">
    </form>
    <p>Уже есть аккаунт? <a href="./signin.php">Войти</a></p>
    <?php 
          if (isset($_SESSION['err'])) {
              echo $_SESSION['err'];
              unset($_SESSION['err']);
          }
    ?>
  </div>
</body>
</html>
