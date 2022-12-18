<?php
require('./dbconnection.php');

$db = createSqliteConnection("./Friba.db");

$sql = 
"SELECT product_name, disctype
FROM product, productgroups
WHERE product.group_id = productgroups.group_id AND product.status = 'active'";

$productStatement = $db->prepare($sql);
$productStatement->execute();

$products = $productStatement->fetchAll(PDO::FETCH_ASSOC);
      
foreach($products as $product) {
  echo 'Name:  '. $product['product_name'].'Disc Type:  '.$product['disctype'].'</br>';
}