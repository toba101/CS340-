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

function navList($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
       $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName']). "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}
// //NAVIGATION
// function navList($classifications){
// $navList = '<ul class="navigation">';
// $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//     $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
//     .urlencode($classification['classificationName']).
//     "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
// }
//     $navList .= '';
//     return $navList;
// }

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
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

//Building thumbnails list 
function buildThumbnails($vehicles){
    //$dv = ""; 
    $dv = "<ul id='inv-thumbnail'>";
    foreach ($vehicles as $vehicle) {
    $dv .= "<li><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></li>";
    }
    $dv .= "</ul>";
     return $dv; 
   }

function buildReviewDetails($reviews){
$rd = '<ul class="reviews">';
foreach ($reviews as $review) {
    //get user
    $firstInitial = strtoupper(substr($review['clientFirstname'], 0, 1));
    $lastInitial = strtoupper(substr($review['clientLastname'], 0, 1));
    $lastName = strtolower(substr($review['clientLastname'], 1));
    $screenName = $firstInitial . $lastInitial . $lastName;

    //get date
    $unix = strtotime($review['reviewDate']);
    $date = date("M j Y", $unix);

    $rd .= '<li>';
    $rd .= "<p class='review-screenname'>$screenName</p>";
    $rd .= "<p class='review-date'>$date</p>";
    $rd .= "<p class='review-text'>$review[reviewText]</p>";
    $rd .= '</li>';
}
    $rd .= '</ul>';
    return $rd;
}

function buildScreenName()
{
    $firstInitial = strtoupper(substr($_SESSION['clientData']['clientFirstname'], 0, 1));
    $lastInitial = strtoupper(substr($_SESSION['clientData']['clientLastname'], 0, 1));
    $lastName = strtolower(substr($_SESSION['clientData']['clientLastname'], 1));
    $screenName = $firstInitial . $lastInitial . $lastName;

    return $screenName;
}