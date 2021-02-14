<?php

$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "users";
    
    $conn = mysqli_connect($server, $username, $password, $database);
    if(!$conn){
        echo "error";
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;
    
    //Check whether this username exists
    $existsSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existsSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows >0){
        // $exists = true;
        $showError = "Username already exists.";
    }
    else{
        // $exists = false;
    if(($password == $cpassword)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
        }
    }
    else{
        $showError = "Passwords do not match";
    }
}
}
    
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Signup</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">iSecure</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/loginsystem/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/loginsystem/login.php">Login</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/loginsystem/signup.php">Signup</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

    <?php

    if($showAlert){

        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is created and you can login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';

}

    if($showError){

        echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong> '. $showError .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';

}

    ?>

    <div class="container my-4">
        <h1 class="text-center">Signup to our website!</h1>
        <form action="/loginsystem/signup.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Username">
                <small id="emailHelp" class="form-text text-muted">Your username must not be greater than 20 characters</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" maxlength="25" class="form-control" id="password" name="password" placeholder="Password">
                <small id="emailHelp" class="form-text text-muted">Your password must not be greater than 25 characters</small>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                <small id="emailHelp" class="form-text text-muted">Make sure to type the same password.</small>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>