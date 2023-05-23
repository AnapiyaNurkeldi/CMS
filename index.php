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
<?php 
      $check = "SELECT * FROM blogs";
      $result = mysqli_query($connect, $check);
      $row = mysqli_fetch_array($result); 
?>
 <main>
    <section>
        <h2>Новости</h2>

        <?php
        $sql = "SELECT * FROM blogs";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['title'];
                $content = $row['content'];
                $author = $row['author'];
                $_SESSION['post'] = [
                    'title' => $title,
                    'content' => $content,
                    'author' => $author
                ];
              
                echo '<article>';
                echo '<h3>' . $title . '</h3>';
                echo '<p style="color: #800000;"> Автор: ' . $author . '</p>';

                $words = explode(' ', $content);
                $limit = 40; 
                $shortDescription = implode(' ', array_slice($words, 0, $limit));

                echo '<p>' . $shortDescription . '</p>';

                if (count($words) > $limit) {
                    echo '<a href="./post.php">Читать далее</a>';
                }

                echo '</article>';
            }
        } else {
            echo 'Нет доступных новостей.';
        }
        mysqli_close($connect);
        ?>

    </section>
</main>

  
  <footer>
    <p>&copy; 2023 Мой блог. Все права защищены.</p>
  </footer>
</body>
</html>
