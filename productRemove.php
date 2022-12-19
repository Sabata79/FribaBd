<?php
require('./dbconnection.php');
require('./functions.php');

if (!isset($_POST['product_id']) || !isset($_POST['product_name'])) {
  http_response_code(404);
  echo 'Missing parameters';
  return;
}

$pid = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
$pname = filter_var($_POST['product_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
  $db = createSqliteConnection("./Friba.db");
  $sql = "UPDATE product SET status = 'disabled' WHERE product_id = '$pid' OR product_name = '$pname'";
  executeInsert($db, $sql);
  $data = array('product_id' => $db->lastInsertId());
  echo 'Product ' . $pid . ' ' . $pname . ' has been removed (disabled)';
} catch (PDOException $pdoex) {
  returnError($pdoex);
}

