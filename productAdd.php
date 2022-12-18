<?php
require('./dbconnection.php');
require('./functions.php');


if(!isset($_POST["group_id"]) || !isset($_POST["product_name"]) || !isset($_POST["price"]) || !isset($_POST["status"])) {
  http_response_code(404);
  echo 'Missing parameters.';
  return;
}

  $group_id = filter_var($_POST["group_id"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $productname = filter_var($_POST["product_name"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $price = filter_var($_POST["price"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $status = filter_var($_POST["status"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  try {
    $db = createSqliteConnection("./Friba.db");
    $sql = "INSERT INTO product (group_id, product_name, price, status) VALUES ('$group_id', '$productname', '$price', '$status')";
    executeInsert($db, $sql);
    $data = array('product_id'=> $db->lastInsertId(), 'product_name' => $productname);
    print json_encode($data);
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
  