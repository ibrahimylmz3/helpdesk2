<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "helpdeskproject";

define('DB_SERVER', $dbhost);
define('DB_USERNAME', $dbuser);
define('DB_PASSWORD', $dbpass);
define('DB_NAME', $dbname);
 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>