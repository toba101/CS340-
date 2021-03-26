<?php
//REVIEWS MODEL

//Insert a review 
function addReview($clientId, $invId, $reviewText)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'INSERT INTO
            reviews (clientId, invId, reviewText)
        VALUES (:clientId, :invId, :reviewText)';

    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}



//Get reviews for a specific inventory item
function getReviewsByInvId($invId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'SELECT reviewText, reviewDate, clientFirstname, clientLastname
        FROM reviews JOIN clients
        ON reviews.clientId = clients.clientId
        WHERE invId = :invId
        ORDER BY reviewDate DESC';


    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

    //Execute the statement
    $stmt->execute();

    //Will return an associative array if a match is found
    $reviewData = $stmt->fetchall(PDO::FETCH_ASSOC);

    //Close the database interaction
    $stmt->closeCursor();

    return $reviewData;
}

//Get reviews written by a specific client
function getReviewsByUser($clientId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'SELECT reviewText, reviewDate, reviewId, clientFirstname, clientLastname
        FROM reviews JOIN clients
        ON reviews.clientId = clients.clientId
        WHERE reviews.clientId = :clientId
        ORDER BY reviewDate DESC';


    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);

    //Execute the statement
    $stmt->execute();

    //Will return an associative array if a match is found
    $reviewData = $stmt->fetchall(PDO::FETCH_ASSOC);

    //Close the database interaction
    $stmt->closeCursor();

    return $reviewData;
}
//Get a specific review
function getReviewById($reviewId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'SELECT reviewText, reviewDate, reviewId, clientFirstname, clientLastname
        FROM reviews JOIN clients
        ON reviews.clientId = clients.clientId
        WHERE reviewId = :reviewId
        ORDER BY reviewDate DESC';


    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);

    //Execute the statement
    $stmt->execute();

    //Will return an associative array if a match is found
    $reviewData = $stmt->fetch(PDO::FETCH_ASSOC);

    //Close the database interaction
    $stmt->closeCursor();

    return $reviewData;
}
//Update a specific review
function updateReview($reviewText, $reviewId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'UPDATE reviews 
        SET reviewText = :reviewText
        WHERE reviewId = :reviewId';

    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}


//Delete a specific review
function deleteReview($reviewId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'DELETE FROM reviews 
        WHERE reviewId = :reviewId';

    //create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //Replace the placeholder & give data type
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}
