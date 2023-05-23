<?php 
    session_start();
    include "./inc/connect.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Удаление блога</title>
  <style>
    /* Общие стили */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');
    * {
      font-family: 'Montserrat', sans-serif;
    }
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
}

header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #800000;
  color: #ffff;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-bottom: 4px solid #FF0000;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu ul li {
  display: inline;
  margin-right: 10px;
}

.menu ul li a {
  text-decoration: none;
  color: #fff;
}

.blog-title h1 {
  margin: 0;
  margin-right: 120px;
}

.account a {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: #fff;
}

.account svg {
  width: 24px;
  height: 24px;
  margin-right: 5px;
}

.dropdown {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: #800000;
  padding: 10px;
}

.dropdown li {
  margin-bottom: 5px;
}

.dropdown a {
  color: #fff;
  text-decoration: none;
}

.dropdown a:hover {
  text-decoration: underline;
}

.dropdown:hover {
  display: block;
}

main {
  display: flex;
  margin: 20px;
}

section {
  flex-basis: 70%;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
}

section h2 {
  margin-top: 0;
  color: #800000;
}

.account {
  position: relative;
  color: white;
  display: inline-block;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  display: none;
  background-color: #fff;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.account:hover .dropdown-menu {
  display: block;
}

.account a {
  text-decoration: none;
  color: #333;
}

.account svg {
  vertical-align: middle;
  margin-right: 5px;
}

.content {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  width: 400px;
}

input[type="submit"] {
  background-color: #FF0000;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #FF3333;
}
</style>
</head>
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
</div>
</header>
  <div class="content">
    <h2 style="margin-right: 40px;">Удаление блога</h2>
    <form action="#" method="post">
      <p>Вы действительно хотите удалить блог? Это действие необратимо.</p>
      <input type="submit" name="delete" value="Удалить">
    </form>
    <?php 
      if (isset($_POST['delete'])) {
        $blog_id = $_SESSION['for_ed']['id'];
        $blog_from_sql = "DELETE FROM `blogs` WHERE id = '$blog_id'";
        mysqli_query($connect, $blog_from_sql);
        unset($_SESSION['for_ed']);
        header('Location: ./account.php');
      }
    ?>
  </div>
</body>
</html>