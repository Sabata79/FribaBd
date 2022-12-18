<?php
require('./dbconnection.php');
require('./functions.php');

if (isset($_POST['group_id']) || isset($_POST['disctype'])) {
  $groupid = filter_var($_POST['group_id'], FILTER_SANITIZE_NUMBER_INT);
  $disctype = filter_var($_POST['disctype'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  try {
    $db = createSqliteConnection("./Friba.db");
    $sql = "UPDATE productgroups SET status = 'disabled' WHERE group_id = '$groupid' OR disctype = '$disctype'";
    executeInsert($db, $sql);
    $data = array('group_id' => $db->lastInsertId(), 'disctype' => $disctype);
    echo 'Productgroup ' . $groupid . ' ' . $disctype . ' has been removed (disabled)';
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
} else {
  http_response_code(400);
  echo "Missing arguments!";
}
