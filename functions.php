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

function addOrder($customer_id, $pid, $pcs)
{

  try {
    $db = createSqliteConnection("./Friba.db");
    //$db->beginTransaction();

    $sql = "INSERT INTO orders (customer_id, status) VALUES ($customer_id, 'active')";

    $statement = $db->prepare($sql);
    $statement->execute();     //PDOStatement OK  ///TÄHÄN PYSÄHTYY DEBUGGAUS JOS TRANSAKTIO ON POIS , Ei erroreita!

    $rownumber = array('order_id' => $db->lastInsertId());  //HAKEE TIEDON ARRAYNA 
    $order_id = $rownumber['order_id'];                //OTETAAN ARVO ARRAYSTA                 
  
     $sql = "INSERT INTO backlog (order_id, product_id, pcs, status)
    VALUES($order_id, $pid, $pcs,'active')";

    $statement = $db->prepare($sql);
    $statement->execute();            //PDOStatement OK 

  } catch (PDOException $pdoex) {
   // $db->rollBack();
    returnError($pdoex);
  }
}

//EI vaikutusta vaikka otetaan arvot vastaan integerinä (int)
//Jos poistetaan transaktio niin debuggaus pysähtyy!
//Vuotaa kun Suomen jalkapallomaajoukkueen puolustus.. Transaction päällä :(