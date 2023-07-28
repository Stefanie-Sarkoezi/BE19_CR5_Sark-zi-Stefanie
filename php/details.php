<?php
    require_once "db_connect.php";
    $id = $_GET["x"];

    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);

    $status = $row["status"];
    if($status > 0){ 
        $message = "Available";
        $colorClass = "green-text";
    }else {
        $message = "Reserved";
        $colorClass = "red-text";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="Stylesheet" href="../css/details.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
   

    <div class="text-center">
        <h1 >Details</h1>
        <hr class="MLLine" style="width:10vw;">
    </div>

    <div class="d-flex flex-row justify-content-center align-items-start">
        <div><img src="../images/<?= $row["picture"] ?>" width="700vw"></div>
        <div class="w-50">
            <div class="mb-3"><b>Name:</b> <br> <?= $row["name"] ?></div>
            <div class="mb-3"><b>Address:</b> <br><?= $row["address"]?></div>
            <div class="mb-3"><b>Age:</b> <br><?= $row["age"]?></div>
            <div class="mb-3"><b>Size:</b> <br><?= $row["size"]?> cm</div>
            <div class="mb-3"><b>Vaccinated:</b> <br><?= $row["vaccinated"] ?></div>
            <div class="mb-3"><b>Breed:</b> <br><?= $row["breed"] ?></div>
            <div >
                <b>Status:</b> 
                <span class="<?php echo $colorClass; ?>"> <?php echo $message; ?> </span>
            </div>
        </div>
        <div class="w-100"> <b id="description">Description:</b> <br> <br> <?= $row["description"] ?></div>   
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>