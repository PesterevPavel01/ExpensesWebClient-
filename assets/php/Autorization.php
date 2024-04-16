<?php
    $AutorName=$_POST['login'];
    $AutorPass=$_POST['password'];

    if ($AutorName=="" || $AutorPass==""){
        header("Location:/index.php");
        return;
    }

    setcookie('login', $AutorName, time()+3600*24*30,"/");
    setcookie('password',  $AutorPass, time()+3600*24*30,"/");
    header("Location:/index.php");
?>