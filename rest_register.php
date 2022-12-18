<?php
require('./headers.php');
session_start();
require('./userFunctions.php');

$body = file_get_contents("php://input");
$user = json_decode($body);

if(!isset($_POST['Fullname']) || !isset($_POST['email']) || !isset($_POST['pw'])){  
  http_response_code(400);
  echo "User not defined. Check your username, email and password";
  return;
}

$uname = filter_var($_POST['Fullname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
$pw = $_POST['pw'];

registerUser($uname, $email, $pw);

$_SESSION['username'] = $uname;

http_response_code(200);
echo 'User '.$uname.' registered';
