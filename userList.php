<?php
require('./dbconnection.php');

$db = createSqliteConnection("./Friba.db");

$customers = "SELECT * FROM customer WHERE status = 'active'";

$customerstatement = $db->prepare($customers);
$customerstatement->execute();

$allcustomers = $customerstatement->fetchAll(PDO::FETCH_ASSOC);

foreach($allcustomers as $customer) {
    echo 'Name: '.$customer['fullname'].' Email: '.$customer['email'].' Status: '.$customer['status'].'</br>';
}
