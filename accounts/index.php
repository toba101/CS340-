<?php
//This is the account controller

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

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/accounts/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/accounts/index.php?action=".urlencode($classification['classificationName'])
 ."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
  case 'login':
   include '../view/login.php';
   break;

case 'register':
  //Filter & store the data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   
      //Check for missing data
  if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
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
      $_SESSION['message'] = "<p>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
      // setcookie('firstname', $clientFirstname,/* 'lastname', $clientLastname,*/ strtotime('+1 year'), "/");

      include '../view/login.php';
      // header('Location: /phpmotors/accounts/?action=login');
      exit;
  } else {
      $message = "<p>Sorry, $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
  }
    break;
}

?>
