<?php 
session_start();
require "config.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password,$user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];
        echo "Anmeldung erflogreich!";
        header("Location:dashboard.php");
        exit;
    }else{
        echo "Üngultiger Beniutzer oder Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzeranmeldung</title>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />

</head>
<body>
    <?php include "./includes/header.php";?>
    <div class="container vh-100" >
    <h2>Benutzer Anmeldung</h2>
    <form class="form" action="login.php" method="POST" style="width: 700px;">
      <div class="mb-3">
        <label for="name" class="form-label">Email address</label>
        <input
          type="text"
          class="form-control"
          id="name"
          aria-describedby="emailHelp"
          name="username"
        />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password"/>
      </div>
 
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="submit" class="btn btn-primary">
        <a style="color: #fff; text-decoration: none;" href="register.html">Registrieren</a>
      </button>

    </form>

    <?php include "./includes/footer.php"?>
    </div>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</body>
</html>