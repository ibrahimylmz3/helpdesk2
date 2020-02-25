<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
  header("location: index.php");
  exit;
}
require_once "config.php";
$username = $password = "";
$username_error = $password_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_error = "kullanici adi giriniz";
    }
    else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_error = "sifre giriniz";
    } 
    else{
        $password = trim($_POST["password"]);,
    }
}
else{

}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>help desk - giris yap</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" placeholder="username" value="<?php echo $username; ?>" name="username"/>
      <span class="help-block"><?php echo $username_error; ?></span>
      <input type="password" placeholder="password" value="<?php echo $password; ?>" name="password"/>
      <span class="help-block"><?php echo $password_error; ?></span>
      <button type="submit" name="submit">login</button>
      <p class="message">hesabin yok mu? <a href="register.php">kayit ol</a></p>
    </form>
  </div>
  </div>
</body>
</html>
