<?php

function selectAsJson(object $db, string $sql): void
{
  $query = $db->query($sql);
  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  header('HTTP/1.1 200 OK');
  echo json_encode($results);
}

function executeInsert(object $db, string $sql): int
{
  $query = $db->query($sql);
  return $db->lastInsertId();
}

function returnError(PDOException $pdoex): void
{
  header('HTTP/1.1 500 Internal Server Error');
  $error = array('error' => $pdoex->getMessage());
  echo json_encode($error);
  exit;
}

function addOrder($db,$customer_id, $pid, $pcs)
{
  try {

    $sql = "INSERT INTO orders (customer_id, status) VALUES ($customer_id, 'active')";

    $statement = $db->prepare($sql);
    $statement->execute();

    $rownumber = array('order_id' => $db->lastInsertId());
    $order_id = $rownumber['order_id'];          
  
     $sql = "INSERT INTO backlog (order_id, product_id, pcs, status)
    VALUES($order_id, $pid, $pcs,'active')";

    $statement = $db->prepare($sql);
    $statement->execute();          

  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}
