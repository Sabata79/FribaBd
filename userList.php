<?php
require('./dbconnection.php');

$db = createSqliteConnection("./Friba.db");

$customers = "SELECT * FROM customer WHERE status = 'active'";

$statement = $db->prepare($customers);
$statement->execute();

$allcustomers = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($allcustomers as $customer) {
    echo 'Name: '.$customer['fullname'].' Email: '.$customer['email'].' Status: '.$customer['status'].'</br>';
}
