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
  main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
  }
  
  section {
    max-width: 100%;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }
  
  form {
    display: flex;
    flex-direction: column;
  }
  
  label {
    font-weight: bold;
    margin-bottom: 10px;
    color: #555;
  }
  
  input[type="text"],
  textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
  }
  
  input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  input[type="submit"]:hover {
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
    <section>
      <?php 
          if(isset($_SESSION['ok'])) {
              echo "<h2>".$_SESSION['ok']."</h2>";
              unset($_SESSION['ok']);
          }
          if(isset($_SESSION['err'])) {
              echo "<h2>".$_SESSION['err']."</h2>";
              unset($_SESSION['err']);
          }
      ?>
      <h2>Добавление блога</h2>
      <form action="./inc/adding.php" method="POST">
        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title">

        <label for="content">Содержание:</label>
        <textarea id="content" name="content"></textarea>

        <input type="submit" value="Опубликовать" name="submit">
      </form>
    </section>
  </main>

  <footer>
    &copy; 2023 Мой блог. Все права защищены.
  </footer>
</body>
</html>
