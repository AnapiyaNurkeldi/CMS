<?php 
    session_start();
    include "./connect.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password == $cpassword) {
        $sql = "UPDATE `user` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `user`.`name` = '$name'";
        $res = mysqli_query($connect, $sql);
        header("Location: ../edit.php");
        $_SESSION['ok'] = "Изменение сохранено";
    } else {
        $_SESSION['msg'] = "Пароли не совподают";
        header("Location: ../edit.php");
    }
?>