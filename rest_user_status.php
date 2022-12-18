<?php
require('./headers.php');
session_start();
require('./userFunctions.php');

if(!isset($_SESSION['username'])){
  http_response_code(403);
  echo "No access for user data";
  return;
}

$messages =getUserStatus($_SESSION['username']);
$status = 'active';

$json = json_encode($messages);
header('Content-type: application/json');
if(isset($json) != $status) {
  echo 'Your account is disabled. Please contact support';
} else {
  echo 'Your account is ' .$json;
}
