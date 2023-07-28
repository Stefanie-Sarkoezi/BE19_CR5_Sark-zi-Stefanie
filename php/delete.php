<?php
    require_once "db_connect.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row["picture"] != "pet-avatar.png"){
        unlink("../images/$row[picture]");
    }

    $delete = "DELETE FROM `animals` WHERE id = $id";
    if(mysqli_query($connect, $delete)){
        header("Location: index.php");
    }else {
        echo "error";
    }
