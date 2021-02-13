<?php
//ACCOUNTS MODEL

//Register new client
function regClient($clientFirstname, $clientLastname, $clientEmail, 
$clientPassword){
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'INSERT INTO
            clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}
?>
