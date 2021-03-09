<?php
//This is the account controller
// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
//   exit;
$navList = navList($classifications);
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
  case 'login':
   include '../view/login.php';
   break;

  case 'Login-page':
   $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
   $clientEmail = checkEmail($clientEmail);
   $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   $checkPassword = checkPassword($clientPassword);
   
   // Run basic checks, return if errors
   if (empty($clientEmail) || empty($checkPassword)) {
    $_SESSION['$message'] = '<p class="notice">Please provide a valid email address and password.</p>';
    include '../view/login.php';
    exit;
   }
     
   // A valid password exists, proceed with the login process
   // Query the client data based on the email address
   $clientData = getClient($clientEmail);
   // Compare the password just submitted against
   // the hashed password for the matching client
   $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
   // If the hashes don't match create an error
   // and return to the login view
   if(!$hashCheck) {
    $_SESSION['loggedin'] = FALSE;
    $_SESSION['$message'] = '<p class="notice">Please check your password and try again.</p>';
     include '../view/login.php';
     exit;
   }
   // A valid user exists, log them in
   $_SESSION['loggedin'] = TRUE;
   // Remove the password from the array
   // the array_pop function removes the last
   // element from an array
   array_pop($clientData);
   // Store the array into the session


   

   $_SESSION['clientData'] = $clientData;
  
   // Send them to the admin view
   include '../view/admin.php';
   exit;
   break;

case 'register':
  //Filter & store the data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   
  //Check for existing email
      $existingEmail = checkExistingEmail($clientEmail);

  //Deal with existing email during registration
  if ($existingEmail) {
      $_SESSION['message'] = '<p>The email address is already registered. Please login or register using a new email address.</p>';
    include '../view/login.php';
    exit;
  }

   //Check for missing data
  if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
    $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
    include '../view/register.php';
    exit;
}
  // Hash the checked password
    $Password = password_hash($clientPassword, PASSWORD_DEFAULT);

  // Send the data to the model if no error exist
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $Password);

  // // Check and report the result    
  //     $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $Password);
  if ($regOutcome === 1) {
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
    $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
    header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $message = "<p>Sorry, $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
    }
      break;
      
  case 'logout':
    session_destroy();
    header('Location: /phpmotors');   
    break;
  case 'updateAccountview':
    include '../view/client-update.php';
    break;

  case 'updateClient':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);  
    
	$clientEmail = checkEmail($clientEmail);

	// check for existing email
	$existingEmail = checkExistingEmail($clientEmail);

	// Deal with existing email during the registration
	if($existingEmail && $clientEmail != $_SESSION['clientData']['clientEmail']){
	$message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
	include '../view/login.php';
	exit;
	}

	// Check for missing data
	if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
	$message = '<p>Please provide information for all empty form fields.</p>';
	include '../view/client-update.php';
	exit; 
	}

	// Hash the checked password
	$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

	// Send the data to the model
	$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

	// Check and report the result
	if($regOutcome === 1){
		setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
	// $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
	//include '../view/login.php';//
	$_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
	header('Location: /phpmotors/accounts/?action=login');
	exit;
	} else {
	$message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
	include '../view/register.php';
	exit;
	}
	break;

  case 'clientInfo':
	// $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
	// $clientData = getClientById($clientId);

	// $_SESSION['clientData'] = $clientData;
	include '../view/client-update.php';
	exit;
	break;

  //Check if the firstname cookie exists, get its value
  if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }  
    include '../view/login.php';
    break;
	
  case 'updatePassword':
  //Filter & store the data
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  $checkPassword = checkPassword($clientPassword);
  echo "client id " . $clientId;
  //Check for missing data
  if (empty($checkPassword)) {
    $messagePassword = '<p>Please provide a new password that matches the requirements and try again.</p>';
    include '../view/client-update.php';
    exit;
  }

  //Query the client data based on the email address
  $clientData = getClientById($clientId);

  // var_dump($clientData);
  //Store the array into the session
  $_SESSION['clientData'] = $clientData;

//Compare the password submitted againsted the hashed password for the matching client
  $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

  // var_dump($_SESSION['clientData']);

  //Insert the data
  $updateOutcome = updatePassword($hashedPassword, $clientId);
  $firstName = $_SESSION['clientData']['clientFirstname'];
  if ($updateOutcome === 1) {
     $_SESSION['message'] = "<p>Thanks, $firstName. Your password has been updated.</p>";
    header('Location: /phpmotors/accounts');
  exit;
  } else {
  $_SESSION['message'] = "<p>Sorry, $firstName. Your password update failed.</p>";
  // include '../view/admin.php';
  exit;
  }
  break;
    
default:
    //Check to see that user is logged in
    include '../view/admin.php';
    break;
}
