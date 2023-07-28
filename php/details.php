<?php
    require_once "db.connect.php";
    $id = $_GET["x"];

    $sql = "SELECT * FROM media WHERE id = $id";
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> <img src="../images/logo.png" style="width: 5vw;" >  </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ms-3 me-4">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="create.php">Create product</a>
            </li>
        </ul>
        
        </div>
    </div>
    </nav>

    <div class="headerImage mb-5"></div>

    <div class="text-center">
        <h1 >Details</h1>
        <hr class="MLLine" style="width:10vw;">
    </div>

    <div class="d-flex flex-row justify-content-center align-items-start">
        <div><img src="../images/<?= $row["image"] ?>" width="700vw"></div>
        <div class="w-50">
            <div class="mb-3"><b>Title:</b> <br> <?= $row["title"] ?></div>
            <div class="mb-3"><b>Author:</b> <br><?= $row["author_first_name"]?> <?=$row["author_last_name"]?></div>
            <div class="mb-3"><b>Publisher:</b> <br><?= $row["publisher_name"]?>, <?=$row["publisher_address"]?></div>
            <div class="mb-5"><b>Publish Date:</b> <br><?= $row["publish_date"] ?></div>
            <div class="mb-3"><b>Type:</b> <?= $row["type"] ?></div>
            <div class="mb-5"><b>ISBN:</b> <?= $row["ISBN"] ?></div>
            <div >
                <b>Status:</b> 
                <span class="<?php echo $colorClass; ?>"> <?php echo $message; ?> </span>
            </div>
        </div>
        <div class="w-100"> <b id="description">Description:</b> <br> <?= $row["short_description"] ?></div>   
    </div>

    <footer >
        <div class="card text-center bg-black">
            <div class="card-header mt-3">
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/Facebook.png" width="40%" class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/twitter.png" width="90%" class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/instagram.png" width="75%"  class="m-1"></a>
                <a class="btn btn-dark p-1 m-1" style="width: 3%;" href="#" role="button"><img src="../images/google.png" width="75%"  class="m-1"></a>
            </div>
            <span class="card-body input-group input-group-sm  mx-auto p-2" style="width: 40%;" >
                <span class="input-group-text bg-black text-white">Sign up for our newsletter</span>
                <input type="text" name="email" autocomplete="email" class="form-control bg-black" placeholder="example@gmail.com">
                <button class=" btn rounded-end btn-light " type="button" id="button-addon1"> Subscripe</button>
            </span>
            <div class="card-footer text-body-secondary">
                &copy; Stefanie Sarközi
            </div>
          </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>