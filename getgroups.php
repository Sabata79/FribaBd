<?php
require('./dbconnection.php');

$db = createSqliteConnection("./MyFribadb.db");

$sql = "SELECT * FROM customer";

$statement = $db->prepare($sql);
$statement->execute();

$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row){
    echo $row.'<br>';
}