<?php
/***********************************************
 * Vehicles  Controller
 *********************************************/

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the database connection file
require_once '../library/functions.php';
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

$navList = navList($classifications);

 // Build heselect list
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
    include '../view/add-vehicles.php';
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
  //Send the data to the model
  $regOutcome = insertclassification($classificationName);

  // Check and report the result
if($regOutcome === 1){
    $message = "<p>Vehicle classification has been added</p>";
    header('Location: ../vehicles/index.php');
    // include '../view/add-classification.php';
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
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
    $vehicles = getVehiclesByClassification($classificationName);
    if(!count($vehicles)){
     $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
    } else {
     $vehicleDisplay = buildVehiclesDisplay($vehicles);
    //  echo $vehicleDisplay;
    // exit;
    }
    include '../view/add-classification.php';
    break;

    case 'mod':
    //get the inventory id
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //get the info on that item based on id
    $invInfo = getInvItemInfo($invId);

    // // echo $invId;
    // var_dump($invInfo);

    //If no info, display message
    if (count($invInfo) < 1) {
        $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId); 
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray); 
      break;

    case 'updateVehicle':
      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
    //Check for missing data
	if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
		$message = '<p>Please complete all information for the new item! Double check the classification of the item.</p>';
		include '../view/vehicle-update.php';
		exit;
		}
		$updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage,  $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
		if ($updateResult) {
			$message = "<p>Congratulations, the $invMake $invModel was successfully added.</p>";
			$_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
			$message = "<p>Error. The new vehicle was not added.</p>";
			include '../view/vehicle-update.php';
			exit;
		}
		break;

  case 'del':
      $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
         $message = 'Sorry, no vehicle information could be found.';
    }
    // include '../view/vehicle-delete.php';
    echo $invId;
    exit;
    break;

  case 'deleteVehicle':
	$invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
	$invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
	$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
		
  // echo $invId;
	$deleteResult = deleteVehicle($invId);
	if ($deleteResult) {
		$message = "<p class='notice'>Congratulations the, $invMake $invModel was   successfully deleted.</p>";
		$_SESSION['message'] = $message;
		header('location: /vehicles/index.php?action=vehicle');
	exit;
	} else {
		$message = "<p class='notice'>Error: $invMake $invModel was not
		deleted.</p>";
		$_SESSION['message'] = $message;
		header('location: /vehicles/index.php?action=vehicle');
	exit;
	}
	break;

  case 'vehicleDetails':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);

    $vehicle = getInvItemInfo($invId);

    $vehicleDisplay = buildVehiclesDisplay($vehicle);

    // echo 'this is an id: '. $invId;
    // var_dump($vehicleData);

    // Create review Info
    // $reviews = getreviews($invId);

    // $_SESSION['vehicleData'] = $vehicleData;
    include '../view/vehicle-detail.php';
    break;
default:

  $classificationList = buildClassificationList($classifications);
  include '../view/vehicles-man.php';
  break;

}
?>