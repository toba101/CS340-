<?php

// Validate email address
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

//NAVIGATION
function navList($classifications){
 
$navList = '<ul class="navigation">';
$navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
    .urlencode($classification['classificationName'])."' title='View our $classification[classificationName] 
    lineup of vehicles'>$classification[classificationName]</a></li>";
}
    $navList .= '';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
$classificationList = '<select name="classificationId" id="classificationList">'; 
$classificationList .= "<option>Choose a Classification</option>"; 
foreach ($classifications as $classification) { 
$classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
} 
$classificationList .= '</select>'; 
return $classificationList; 
}

function buildVehicleDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';

    foreach ($vehicles as $vehicle) {
        $price = number_format($vehicle['invPrice']);

        $dv .= '<li>';
        $dv .= "<a href='index.php?action=vehicleInfo&invId=$vehicle[invId]'><img src ='$vehicle[imgPath]' alt='Picture of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<div class="namePrice">';
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$$price</span>";
        $dv .= '</div></a>';
        $dv .= '</li>';
    }
    $dv .= '</ul>';

    return $dv;
}

function updatePassword($hashedPassword, $clientId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'UPDATE clients 
        SET clientPassword = :clientPassword
        WHERE clientId = :clientId';

    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}
