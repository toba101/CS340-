<?php
/***********************************************
 * Vehicles  Controller
 *********************************************/

// Create or access a Session
// session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the database connection file
// require_once '../library/functions.php';
// // Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// require_once '../models/reviews-model.php';
// Get the accounts model
require_once '../model/vehicles-model.php';

// Dynamic Navigation
// Get the array of classifications
$classifications = getClassifications();
// $navList = $navList($classifications);
// var_dump($classifications);
// exit;

// Build a navigation bar using the $classifications array
 $navList = '<ul>';
 $navList .= "<li><a href='/index.php' title='View the PHP Motors home page'>Home</a></li>";
 foreach ($classifications as $classification) {
  $navList .= "<li> <a href='/vehicles/?action=classification&classificationName="
    .urlencode($classification['classificationName']).
    "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a> </li>";
 }
 $navList .= '</ul>';

 $classificationDropDown  = '<label for="classificationId">Car Type</label><br>';
 $classificationDropDown  = '<select class="loginInput" name="classificationId" id="classificationId">';
 foreach ($classifications as $classification) {
  $classificationDropDown .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
 }
  $classificationDropDown  .= '</select>';

 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
  case 'addvehicle':
   include '../view/add-vehicles.php';
   break;

   case 'add-classification':
    include '../view/add-classification.php';
    break;

case 'insertvehicle':
  //Filter & store the data
  $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
  $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING);
  $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
  $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING);
      
   
  //Check for missing data
  if(empty($invMake) || empty($invModel) || empty($classificationId) || empty($invImage) ||
  empty($invThumbnail) || empty($invPrice ) || empty($invStock )|| empty($invColor )){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/register.php';
    exit;
}
  // Send the data to the model if no error exist
      $regOutcome = insertvehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, 
      $invStock, $invColor, $classificationId);

  // Check and report the result    
    //   $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
  if ($regOutcome === 1) {
      $message = "<p>Thanks for registering, Please use your email and password to login.</p>";
      // setcookie('firstname', $clientFirstname,/* 'lastname', $clientLastname,*/ strtotime('+1 year'), "/");
      
      include '../view/add-vehicles.php';
      exit;
  } else {
      $message = "<p>Sorry, but the registration failed. Please try again.</p>";
      include '../view/add-vehicles.php';
      exit;
  }
    break;

    case 'insertclassification';
    $classificationName = filter_input(INPUT_POST, 'classificationName',  FILTER_SANITIZE_STRING);
   // echo $classificationName;
    // Check for missing data
    if(empty($classificationName)){
      $message ='<p>Please enter the classification type.</p>';
      include '../view/add-classification.php';
   exit; 
  }

  $regOutcome = insertclassification($classificationName);

  // Check and report the result
if($regOutcome === 1){
    $message = "<p>Vehicle classification has been added</p>";
    include '../view/add-classification.php';
    exit;
    } else {
    $message = "<p>Sorry, the addition failed. The classification was not entered. Please try again.</p>";
    include '../view/add-classification.php';
    exit;
    }
    
    break;
    case 'vehicle':
    include '../view/vehicles-man.php';
    break;
    case 'classification';
      include '../view/add-classification.php';
    break;
   default:
    include '../view/vehicles-man.php';
}
?>