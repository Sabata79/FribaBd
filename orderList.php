<?php

require('./dbconnection.php');

$db = createSqliteConnection("./Friba.db");

$orders = "SELECT * FROM orders WHERE status = 'active'";

$orderStatement = $db->prepare($orders);
$orderStatement->execute();

$allOrders = $orderStatement->fetchAll(PDO::FETCH_ASSOC);

foreach($allOrders as $order) {
  echo ' Order id: '.$order['order_id'].' Customer id: '.$order['customer_id'].' Date '.$order['date'].' status: '.$order['status'].'</br>';
}