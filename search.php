<?php
require('./dbconnection.php');


  if(!isset($_POST['search'])) {
    http_response_code(404);
    echo 'Missing parameters.';
  }
  $search = filter_var($_POST['search'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  try {
  $db = createSqliteConnection("./Friba.db");
  $searchItem = "SELECT product_name
  FROM product
  WHERE product_name LIKE '%$search%'";

 $searchStatement = $db->prepare($searchItem);
 $searchStatement->execute();
 
 $searchitems = $searchStatement->fetchAll(PDO::FETCH_COLUMN);

 foreach($searchitems as $item) {
  echo 'Label: '. $item .'</br>';
 }  
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
