<?php 
    include "./inc/connect.php";
    session_start();
    // $_SESSION['account'] = ' <span style="color: white;">Аккаунт</span>';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Мой блог</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<style>
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input[type="text"],
  input[type="email"],
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  button[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button[type="submit"]:hover {
    background-color: #45a049;
  }
</style>

<body>
<header>
  <div class="menu">
    <nav>
      <ul>
        <li><a href="./index.php">Главная</a></li>
        <li><a href="./about.php">О нас</a></li>
        <li><a href="./contacts.php">Контакты</a></li>
        <li><a href="./add.php">Добавить статью</a></li>
      </ul>
    </nav>
  </div>
  
  <div class="account">
  <a href="#">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path d="M0 0h24v24H0z" fill="none"/>
      <path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 2c-3.33 0-6 2.67-6 6v2h12v-2c0-3.33-2.67-6-6-6zm0 2a3.999 3.999 0 0 0-3.87 3H8c-2.21 0-4 1.79-4 4v1h16v-1c0-2.21-1.79-4-4-4h-0.13A3.999 3.999 0 0 0 12 16zm-6 6c0-2.67 2.33-5 6-5s6 2.33 6 5h2c0-3.79-3.08-7-8-7s-8 3.21-8 7h2z"/>
    </svg>
    <!-- <span style="color: white;">Аккаунт</span> -->
    <?php 
      if (!empty($_SESSION['user'])) {
        $username = $_SESSION['user']['name'];
    
        // Добавляем проверку наличия пользователя в базе данных
        $user_from_sql = "SELECT * FROM `user` WHERE name = '$username'";
        $res = mysqli_query($connect, $user_from_sql);
        $row = mysqli_fetch_assoc($res);
    
        if ($row) {
            echo '<span><a href="./account.php" style="color: white;">'.$username.'</a></span>';
        } else {
            unset($_SESSION['user']);
            echo '<span style="color: white;">Аккаунт</span>
            <div class="dropdown-menu">
                <a href="./signin.php">Войти</a>
                <a href="./signup.php">Регистрация</a>
            </div>';
        }
    } else {
        echo '<span style="color: white;">Аккаунт</span>
        <div class="dropdown-menu">
            <a href="./signin.php">Войти</a>
            <a href="./signup.php">Регистрация</a>
        </div>';
    }
    
    ?>


  </a>
  
</header>
<main>
  <h1>Напишите нам</h1>
  <form action="#" method="POST">
    <div class="form-group">
      <label for="name">Имя:</label>
      <input type="text" id="name" name="name">
    </div>
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
    </div>
    
    <div class="form-group">
      <label for="message">Сообщение:</label>
      <textarea id="message" name="message"></textarea>
    </div>
    
    <div class="form-group">
      <button type="submit">Отправить</button>
    </div>
  </form>
</main>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // $to = "anapiyanurkeldi@gmail.com"; 
    $to = "yetoga7621@duscore.com";
    $subject = "Новое сообщение";
    $headers = "От: $name <$email>\r\n";


    $emailBody = "Имя: $name\n";
    $emailBody .= "Почта: $email\n\n";
    $emailBody .= "Сообщение:\n$message";

    if (mail($to, $subject, $emailBody, $headers)) {
        // echo "Спасибо за интерес, вам скоро ответим";
        $_SESSION['answer_soon'] = "Сообщение отправленено";
        echo $_SESSION['answer_soon'];
        unset($_SESSION['answer_soon']);
    } else {
        // echo "Упс! Что то пошло не так...";
        $_SESSION['answer_soon'] = "Сообщение не отправлено";
        echo $_SESSION['answer_soon'];
        unset($_SESSION['answer_soon']);
    }
} 
?>

  
  <main>
    <section>
      <h2>Контакты</h2>
      <p>Адрес: г. Туркестан, с.Бабайкурган, ул.С.Кожанова, д.15</p>
      <p>Телефон: +7 700 105 0594</p>
      <p>Email: anapiyanurkeldi@gmail.com</p>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2023 Мой блог. Все права защищены.</p>
  </footer>
</body>
</html>
