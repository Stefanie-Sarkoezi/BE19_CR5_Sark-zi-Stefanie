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
       $fname = $_POST["first_name"];
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
        <link rel="Stylesheet" href="../css/update.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" >
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="../images/logo.png" alt="logo" style="width: 5vw;">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navText" >
                <li class="nav-item ms-2 me-3">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="home.php">Pets</a>
                </li>-->
                <li class="nav-item  me-3"> 
                    <a class="nav-link" href="senior.php">Our Seniors</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a >
                </li>
            </ul>
            <a class="navbar-brand" href="update.php?id=<?=$row["id"]?>">
              <span class="text-black-50 fs-6"><?= $row["email"] ?></span>
            </a>
            <a class="navbar-brand" href="update.php?id=<?=$row["id"]?>">
                <img src="../images/<?= $row["picture"] ?>" class="object-fit-contain" alt="user pic" width="70" height="70">
            </a>
        </div>
    </nav>

        <div class="container mt-5 mb-5">
            <div class="text-center mb-5">
                <h1  id="welcome">Edit profile: </h1>
                <hr class="MLLine" id="upLine" style="width:20vw;">
            </div>
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-4 mt-5" >
                    <label for="first_name" class="form-label"> First name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?= $row["first_name"] ?>">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control"   id="last_name" name="last_name" placeholder="Last name" value="<?= $row["last_name"] ?> ">
                </div>
                <div class="mb-4">
                    <label for="address" class="form-label">Adress:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= $row["address"] ?>">
                </div>
                <div class="mb-4">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $row["phone"] ?>">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?> ">
                </div>
                <div class="mb-4">
                    <label for="picture" class="form-label">Profile picture:</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                </div>
                <button name="update" type="submit" class="btn text-white mb-5" id="upBtn" >Update profile</button>
                <a href="<?= $backBtn ?>" class="btn btn-secondary mb-5">Back</a>
            </form>
        </div>

        <footer class="mt-5">
        <div class="card text-center" id="foBg">
            <div class="card-header p-3">
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/Facebook.png" width="40%" class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/twitter.png" width="90%" class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/instagram.png" width="75%"  class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/google.png" width="75%"  class="m-1"></a>
            </div>
            <span class="card-body input-group input-group-sm  mx-auto p-3" style="width: 40%;" >
                <span class="input-group-text bg-black border-black text-white">Sign up for our newsletter</span>
                <input type="text" name="email" autocomplete="email" class="form-control bg-black border-black" placeholder="example@gmail.com">
                <button class=" btn rounded-end bg-black text-white" type="button" id="button-addon1"> Subscripe</button>
            </span>
            <div class="card-footer text-body-secondary p-1">
                &copy; Stefanie Sarközi
            </div>
        </div>
    </footer>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>