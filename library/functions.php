<?php

// Validate email address
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
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