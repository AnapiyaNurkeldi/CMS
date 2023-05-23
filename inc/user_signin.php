<?php 
    session_start();
    include "./connect.php";
    $name = $_POST['name'];
    $password = $_POST['password'];
    if (isset($_POST['submit'])) {
        $sql = "SELECT * FROM user WHERE name = '$name' AND password = '$password'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['name'] = $name;
            header("Location: ../index.php");
        } else {
            $_SESSION['err'] = "<p style='color: red;'>Неверный имя пользователя или пароль</p>";
            header('Location: ../signin.php');
        }
    }

?>