<?php
   session_start();

   require_once "db_connect.php";
   require_once "file_upload.php";

   $id = $_GET["id"]; 
   $sql = "SELECT * FROM users WHERE id = $id";
   $result = mysqli_query($connect, $sql);
   $row = mysqli_fetch_assoc($result);

   $backBtn = "home.php";

   if( isset($_SESSION["adm"])){
       $backBtn = "dashboard.php";
   }

   if (isset($_POST["update"])){
       $fname = $_POST["fist_name"];
       $lname = $_POST["last_name"];
       $email = $_POST["email"];
       $address = $_POST["address"];
       $phone = $_POST["phone"];
       $picture = fileUpload($_FILES["picture"]);
       
       if($_FILES["picture"]["error"] == 0){
            if($row["picture"] != "avatar.png"){
               unlink("../images/$row[picture]" );
           }
           $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `picture` = '$picture[0]', address = '$address', `phone` = '$phone', `email` = '$email' WHERE id = {$id}";
       } else {
           $sql = "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', address = '$address', `phone` = '$phone', `email` = '$email' WHERE id = {$id}";
       }

    if (mysqli_query($connect, $sql)){
        echo  "<div class='alert alert-success' role='alert'>
       Your user information has been updated. {$picture[1]}
     </div>" ;
     header( "refresh: 5; url=$backBtn" );
   } else  {
        echo   "<div class='alert alert-danger' role='alert'>
       Oops! Something went wrong. {$picture[1]}
     </div>" ;
   }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>Edit profile </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Edit profile: </h1>
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-3 mt-3" >
                    <label for="first_name" class="form-label"> First name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?= $row["first_name"] ?> ">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control"   id="last_name" name="last_name" placeholder="Last name" value="<?= $row["last_name"] ?> ">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adress:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= $row["address"] ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $row["phone"] ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?> ">
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Profile picture:</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                </div>
                <button name="update" type="submit" class="btn btn-warning" >Update profile</button>
                <a href="<?= $backBtn ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>