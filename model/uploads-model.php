<?php
// Add image information to the database table
function storeImages($imgPath, $invId, $imgName, $imgPrimary) {
 $db = phpmotorsConnect();
 $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary) VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
 $stmt = $db->prepare($sql);
 // Store the full size image information
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
 $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
 $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
 $stmt->execute();
  
 // Make and store the thumbnail image information
 // Change name in path
 $imgPath = makeThumbnailName($imgPath);
 // Change name in file name
 $imgName = makeThumbnailName($imgName);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
 $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
 $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
 $stmt->execute();
 
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

//Get img info from images table
function getImages() {
    $db = phpmotorsConnect();
    //The SQL statement
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel
        FROM images JOIN inventory ON images.invId = inventory.invId';

    //create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //Execute the sql
    $stmt->execute();

    //Fetch the data as an associative array
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $imageArray;
}

function getThumbnailsOfVehicle($invId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'SELECT imgPath
        FROM images 
        WHERE imgPath LIKE "%-tn.%" AND invId = :invId';

    //create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //bind variable names
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    //Execute the sql
    $stmt->execute();

    //Fetch the data as an associative array
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $imageArray;
}

//Delete img info from the images table
function deleteImage($imgId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'DELETE FROM images
        WHERE imgId = :imgId';

    //create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //Replace the placeholder & give data type
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);


    //Execute the sql
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}

//Check for an existing img
function checkExistingImage($imgName)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'SELECT imgName
        FROM images
        WHERE imgName = :imgName';

    //create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //Replace the placeholder & give data type
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);

    //Execute the sql
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $imgMatch = $stmt->fetch();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $imgMatch;
}
?>