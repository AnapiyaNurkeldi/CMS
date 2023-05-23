<?php 
    session_start();
    include "./connect.php";
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_SESSION['user']['name']; 

        $sql = "INSERT INTO blogs (title, content, author) VALUES ('$title', '$content', '$author')";
        $result = mysqli_query($connect, $sql);
        
        if ($result) {
            $_SESSION['ok'] = "Статья успешно добавлена!";
            header('Location: ../add.php');
        } else {
            $_SESSION['err'] = "Ошибка добавления статьи!";
            header('Location: ../add.php');
        }
    } else {
        $_SESSION['err'] = "Вы должны быть зарегистрированы, чтобы добавить статью.";
        header('Location: ../add.php');
        exit();
    }
?>
