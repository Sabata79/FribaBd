<?php
require('./dbconnection.php');
require('./functions.php');

if (isset($_POST["disctype"]) && (isset($_POST["status"]))) {

  $disctype = filter_var($_POST["disctype"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $status = filter_var($_POST["status"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  try {
    $db = createSqliteConnection("./Friba.db");
    $sql = "INSERT INTO productgroups (disctype, status) VALUES ('$disctype','$status')";
    executeInsert($db, $sql);
    $data = array('group_id' => $db->lastInsertId(), 'disctype' => $disctype);
    print json_encode($data);
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
} else {
  http_response_code(400);
  echo "Missing argument";
}
