<?php 
 session_start();
 include "./connect.php";
 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $cpassword = $_POST['cpassword'];
 $submit = $_POST['submit'];
 
 if ($password == $cpassword) {
     $sql = "INSERT INTO `user` (`name`, `email`, `password`) VALUES ('$name','$email','$password')";
     $result = mysqli_query($connect, $sql);
     if ($result) {
         header ("Location: ../signin.php");
         $name_from_sql = "SELECT * FROM `user` WHERE name = '$name'";
         $res = mysqli_query($connect, $name_from_sql);
         $row = mysqli_fetch_assoc($res);
         $_SESSION['user'] = $row; // Используем ключ 'user' вместо 'name'
         $email_from_sql = "SELECT * FROM `user` WHERE email = '$email'";
         $ress = mysqli_query($connect, $email_from_sql);
         $roww = mysqli_fetch_assoc($ress);
         $_SESSION['email'] = $roww;
     } else {
         echo "Что-то пошло не так";
     }
 } else {
     $_SESSION['err'] = "<p style='color: red;'>Пароли не совпадают.</p>";
     header ("Location: ../signup.php");
     exit();
 }
?>
