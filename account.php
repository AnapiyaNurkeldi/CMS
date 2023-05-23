<?php 
    session_start();
    include "./inc/connect.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Аккаунт пользователя</title>
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
      <div class="profile-picture"></div>
      <div class="account-info">
        <p><?php echo $_SESSION['user']['name']; ?></p>
      </div>
    </div>
</header>
  <div class="main">
    <!-- Содержимое страницы аккаунта пользователя -->
    <div class="main">
  <section>
    <h2>Добро пожаловать, <?php echo $_SESSION['user']['name'];?></h2>
    <div class="user-info">
      <p>Имя: <?php echo $_SESSION['user']['name'];?></p>
      <p>Email: <?php echo $_SESSION['user']['email'] ?></p>
    </div>
    <h3>Ваши статьи</h3>
    <ul class="user-articles">
      <!-- <li>
        <h4>Заголовок статьи 1</h4>
        <p>Описание статьи...</p>
        <a href="#">Редактировать</a>
        <a href="#">Удалить</a>
      </li> -->
      <?php 
          $username = $_SESSION['user']['name'];

          $sql = "SELECT * FROM blogs WHERE author = '$username'";
          $result = mysqli_query($connect, $sql);
          
          while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['for_ed'] = [
              'title' => $row['title'],
              'content' => $row['content'],
              'id' => $row['id']
            ];
            echo "<li>";
            echo "<h4>".$row['title']."</h4>";
            
            $words = explode(' ', $row['content']);
            $limit = 40; 
            $shortDescription = implode(' ', array_slice($words, 0, $limit));
            $fullDescription = $row['content'];
            
            echo '<p class="short-description">'.$shortDescription.'</p> <hr>';
            
            if (count($words) > $limit) {
                echo '<a href="#" class="read-more" >Читать далее</a> <hr>';
                echo '<p class="full-description" style="display: none;">'.$fullDescription.'</p>';
            }
            
            echo "<a href='./update.php?id=".$row['id']."' style='color: blue; text-decoration: none;'>Редактировать</a> <hr>";
            echo "<a href='./delete.php?id=".$row['id']."' style='color: red; text-decoration: none;'>Удалить</a> <hr>";
            echo "</li>";
            
            
          }
      ?>
    </ul>
  </section>
  
  <aside>
    <h3>Дополнительная информация</h3>
    <ul>
      <li><a href="./edit.php">Редактировать профиль</a></li>
    </ul>
  </aside>
</div>

  </div>
  
  <footer>
    <p>&copy; 2023 Мой блог. Все права защищены.</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
  $(".read-more").click(function(e) {
    e.preventDefault();
    var $this = $(this);
    var $shortDescription = $this.siblings(".short-description");
    var $fullDescription = $this.siblings(".full-description");
    
    $shortDescription.hide();
    $fullDescription.show();
    $this.remove();
  });
});

  </script>
</body>
</html>
