<?php

    session_start();

    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    require_once "db_connect.php";

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";

    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);

    $sqlAnimals = "SELECT * FROM animals";
    $resultAnimals = mysqli_query($connect, $sqlAnimals);

    $layout = "";

    if(mysqli_num_rows($resultAnimals) > 0){
        while($rowAnimal = mysqli_fetch_assoc($resultAnimals)){
            $layout .= "<div>
            <div class='card gap-3 mt-5 mb-5 shadow' style='width: 18rem;'>
                <img src='../images/{$rowAnimal["picture"]}' class='card-img-top' alt='...' style='height: 30vh;'>
                <div class='card-body'>
                <h4 class='card-title mb-4 text-center d-flex align-items-center justify-content-center' style='height: 8vh;' >{$rowAnimal["name"]}</h4>
                <hr class='TitleHR'>
                <p class='card-text mt-5'><b>Age:</b> <br> {$rowAnimal["age"]}</p>
                <p class='card-text mb-5'><b>Size:</b><br> {$rowAnimal["size"]}</p>
                <div class='buttons text-center'> 
                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Details</a>
                    <a href='adopt.php?x={$rowAnimal["id"]}' class='btn btn-dark'>Take me home</a>
                </div>
                </div>
                </div>
          </div>";
        }
    }else {
        $layout.= "No results found!";
    }

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0" >
   <title>Welcome <?= $row["first_name"] ?></title>
   <link rel="Stylesheet" href="../css/home.css">
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel= "stylesheet" integrity ="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin= "anonymous">

</head>
<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary" >
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="../images/logo.png" alt="logo" style="width: 5vw;">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="senior.php?id=<?= $row["id"] ?>">Our Seniors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a >
                </li>
            </ul>
            <a class="navbar-brand" href="update.php">
                <img src="../images/<?= $row["picture"] ?>" alt="user pic" width="30" height="24">
            </a>
        </div>
    </nav>
    <h2 class="text-center">Welcome <?= $row[ "first_name"] . " " . $row[ "last_name"] ?></h2>

    <div class="container">
        <div class="row">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>