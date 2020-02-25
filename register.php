<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
  header("location: index.php");
  exit;
}
require_once "config.php";
$name = $surname = $email = $password = $repassword ="";
$name_error = $surname_error = $email_error = $password_error = $repassword_error = $message ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"]))){
      $name_error = "ad giriniz";
    } 
    else{
        $name = trim($_POST["name"]);
    }
    if(empty(trim($_POST["surname"]))){
        $surname_error = "soyad giriniz";
    }
    else{
        $surname = trim($_POST["surname"]);
    }
    if(empty(trim($_POST["email"]))){
        $email_error = "email giriniz";
    }
    else{
        $email = trim($_POST["email"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_error = "sifre giriniz";
    } 
    else{
        $password = trim($_POST["password"]);
    }
    if($password == trim($_POST["repassword"])){
        $repassword = trim($_POST["repassword"]);
    }
    else{
        $repassword_error = "sifreler eslesmiyor";
    } 
    $sql="select * from tbl_users where (email='$email');";
        $res=mysqli_query($conn,$sql);
        if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($email===$row['email'])
        {
            $email_error = "mail adresi kullanimda";
        }
        else{
            $sql = "INSERT INTO tbl_users (name, surname, email, password) VALUES (?, ?, ?, ?)";
                 if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, $param_name, $param_surname, $param_email, $param_password);
                        $param_name = $name;
                        $param_surname = $surname;
                        $param_email = $email;
                        $param_password = $password;
                            if(mysqli_stmt_execute($stmt)){
                                header("location: index.php");
                                exit();
                                  //insert yapıalacak ve login sayfasına yönlendirilecek. username sql ile create edilecek name+surname
                            } 
                            else{
                                echo "kayit basarisiz.";
                            }
                        } 
                    }
                }
            }
else{
  
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>help desk - kayit ol</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" placeholder="name" value="<?php echo $name; ?>" name="name"/>
      <span class="help-block"><?php echo $name_error; ?></span>
      <input type="text" placeholder="surname" value="<?php echo $surname; ?>" name="surname"/>
      <span class="help-block"><?php echo $surname_error; ?></span>
      <input type="email" placeholder="email address" value="<?php echo $email; ?>" name="email" required/>
      <span class="help-block"><?php echo $email_error; ?></span>
      <input type="password" placeholder="password" name="password"/>
      <span class="help-block"><?php echo $password_error; ?></span>
      <input type="password" placeholder="re password" name="repassword"/>
      <span class="help-block"><?php echo $repassword_error; ?></span>
      <button type="submit" name="submit">create</button>
      <p class="message">zaten bir hesabin var mi? <a href="login.php">giris yap</a></p>
    </form>
  </div>
  </div>
</body>
</html>
