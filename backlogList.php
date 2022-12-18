<?php
require('./dbconnection.php');

$db = createSqliteConnection("./Friba.db");

$backlog = "SELECT * from backlog WHERE status = 'active'";

$backlogStatement = $db->prepare($backlog);
$backlogStatement->execute();

$backlogs = $backlogStatement->fetchAll(PDO::FETCH_ASSOC);

foreach($backlogs as $backlog) {
  echo ' Order row: '.$backlog['order_id'].' Backlog id: '.$backlog['backlog_id'].' Product id: '.$backlog['product_id'].' pcs: '.$backlog['pcs'].' status: '.$backlog['status'].'</br>';  
}