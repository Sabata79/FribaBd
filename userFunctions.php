<?php
require('./functions.php');
require('./dbconnection.php');

// Register
function registerUser($uname, $email, $pw)
{
    try {
        $db = createSqliteConnection("./Friba.db");
        $db->beginTransaction();
        $pw = password_hash($pw, PASSWORD_DEFAULT);
        $sql = "INSERT INTO customer (fullname,email, pw, status) VALUES (?,?,?,'active')";

        $statement = $db->prepare($sql);
        $statement->execute(array($uname, $email, $pw));
    } catch (PDOException $pdoex) {
        $db->rollBack();
        returnError($pdoex);
    }
}


// Check User
function checkUser($uname, $pw)
{
    $db = createSqliteConnection("./Friba.db");

    $sql = "SELECT pw FROM customer WHERE fullname=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));

    $hashedpw = $statement->fetchColumn();

    if (isset($hashedpw)) {
        return password_verify($pw, $hashedpw) ? $uname : null;
    }
    return null;
}

// Check Status

function getUserStatus($uname)
{
    $db = createSqliteConnection("./Friba.db");

    $sql = "SELECT status FROM customer WHERE fullname=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));

    return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
}
