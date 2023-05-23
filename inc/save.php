<?php 
    session_start();
    include "./connect.php";

    if (isset($_POST['submit'])) {
      $id = $_SESSION['for_ed']['id'];
      $title = $_POST['title'];
      $content = $_POST['content'];
      $sql = "UPDATE blogs SET title = '$title', content = '$content' WHERE id = '$id'";
      $result = mysqli_query($connect, $sql);
      if ($result) {
          $_SESSION['msg'] = "Статья изменена";
          header("Location: ../update.php");
      } else {
          $_SESSION['msg'] = "Не удалось изменить статью";
          header("Location: ../update.php");
      }
    }
?>