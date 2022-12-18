<?php

require('./dbconnection.php');
require('./functions.php');

 $db = Null;
/*
if (!isset($_POST['fullname']) || !isset($_POST['product_name']) || !isset($_POST['pcs'])) {
  http_response_code(404);
  echo 'Missing parameters';
  return;
}*/
  
  $uname= 'Mikko Mallikas';
  $pname ='Innova Halo Star Invader';
  $pcs = 10;
  
/*
  $uname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $pname = filter_var($_POST['product_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $pcs = filter_var($_POST['pcs'], FILTER_SANITIZE_NUMBER_INT); */


  $db = createSqliteConnection("./Friba.db");
  $sql = "SELECT customer_id FROM customer WHERE fullname= '$uname'";
  $statement = $db->prepare($sql);
  $statement->execute();
  
  $customer_id = (int)$statement->fetchColumn(); //OK
 
  $sql = "SELECT product_id FROM product WHERE product_name='$pname'";
  $statement = $db->prepare($sql);
  $statement->execute();
  
  $pid =(int)$statement->fetchColumn(); //OK

  addOrder($customer_id, $pid, $pcs);

  $_SESSION['username'] = $uname;

  http_response_code(200);
  echo 'User '.$uname.' ,the order has been accepted';

