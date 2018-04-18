<?php
session_start();
$pdo = new PDO('mysql:host=bernd-mysql.php-friends.de;dbname=521_rfid_test', '521_admin', 'Cb&0fv');

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        echo '<script type="text/javascript">window.open("index.php","_self")</script>';
        die();
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
  integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<style>
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  xpadding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>
<body class="text-center">

  <form class="form-signin" action="?login=1" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Bitte einloggen</h1>
    <label for="inputEmail" class="sr-only">Email Addresse</label>
    <input type="email" class="form-control" placeholder="Email Addresse" name="email" required autofocus>
    <label for="inputPassword" class="sr-only">Passwort</label>
    <input type="password" class="form-control" placeholder="Passwort" name="passwort" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Anmelden</button>

    <?php
    if(isset($errorMessage)) {
      echo '<br/><div class="alert alert-danger" role="alert">
              '.$errorMessage.'
            </div>';
    }
    ?>

    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
  </form>
</body>
</html>
