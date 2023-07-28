<?php
    require_once "db_connect.php";
    require_once "file_upload.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: login.php");
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST["update"])){
        $name = $_POST["name"];
        $address = $_POST["address"];
        $description = $_POST["description"];
        $size = $_POST["size"];
        $age = $_POST["age"];
        $vaccinated = $_POST["vaccinated"];
        $breed = $_POST["breed"];
        $status = $_POST["status"];
        $picture = fileUpload($_FILES["picture"], "animal");

        if($_FILES["picture"]["error"] == 0){
            if($row["picture"] != "pet-avatar.png"){
                unlink("../images/$row[picture]");
            }
            $sql = "UPDATE `animals` SET `name`='$name',`address`='$address', `description`='$description', `size`='$size', `age`='$age', `vaccinated`='$vaccinated', `breed`='$breed', `status`='$status',`picture`='$picture[0]' WHERE id = $id";
        }else {
            $sql = "UPDATE `animals` SET `name`='$name',`address`= '$address', `description`='$description', `size`='$size', `age`='$age', `vaccinated`='$vaccinated', `breed`='$breed', `status`='$status'  WHERE id = $id";
        }
        if(mysqli_query($connect, $sql)){
            echo "<div class='alert alert-success' role='alert'>
                    Entry has been updated, {$picture[1]}
                </div>";
                header("refresh: 5; url = index.php");
        }else {
            echo "<div class='alert alert-danger' role='alert'>
                Oops! Something went wrong. {$picture[1]}
                </div>";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
       <h2>Edit Entry</h2>
       <form method="POST" enctype="multipart/form-data"> 
           <div class="mb-3 mt-3">
               <label for="name" class= "form-label">Name: </label>
               <input  type="text" class="form-control" id="name" aria-describedby="name" name="name" value="<?= $row["name"] ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control"  id="address"  aria-describedby="address"  name="address" value="<?= $row["address"] ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea type="text" style="height: 20vh;" class="form-control"  id="description"  aria-describedby="description"  name="description"><?= $row["description"] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size:</label>
                <input type="text" class="form-control"  id="size"  aria-describedby="size"  name="size" value="<?= $row["size"] ?>">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="text" class="form-control"  id="age"  aria-describedby="age"  name="age" value="<?= $row["age"] ?>">
            </div>
            <div class="mb-3">
                <label for="vaccinated" class="form-label">Vaccinated:</label>
                <input type="text" class="form-control"  id="vaccinated"  aria-describedby="vaccinated"  name="vaccinated" value="<?= $row["vaccinated"] ?>">
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed:</label>
                <input type="text" class="form-control"  id="breed"  aria-describedby="breed"  name="breed" value="<?= $row["breed"] ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <input type="number" class="form-control"  id="status"  aria-describedby="status"  name="status" value="<?= $row["status"] ?>">
            </div>
           <div class="mb-3">
                <label for="picture" class="form-label">Picture:</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture"   name="picture">
            </div>
            <button name="update" type="submit" class="btn btn-primary">Update entry</button>
            <a href="index.php" class="btn btn-dark">Back to home page</a>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>