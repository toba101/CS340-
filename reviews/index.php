<?php
//REVIEWS CONTROLLER FOR SITE

//Create or access a Session
session_start();

//* * * * * * * * * * * * * * CONNECTIONS/DATA * * * * * * * * * * * * * * * * * * *
// Get the database connection file first. The model can't run on a connection that hasn't been included in the scope yet.
require_once '../library/connections.php';
// Get the PHP Motors model connected for when it's needed... And now we know how these two files will see each other.
require_once '../model/main-model.php';
//Get the reviews model
require_once '../model/review-model.php';
//get the functions page
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

$navList = navList($classifications);
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


switch ($action) {
        //	Add a new review
    case 'addreview':

        //Filter & store the data
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($reviewText)) {
            $_SESSION['reviewMessage'] = "<p class='warning'>Please provide text for your review before attempting to submit.</p>";
            header('Location: http://localhost/phpmotors/vehicles/index.php?action=vehicleInfo&invId=' . $invId);
            exit;
        }
        //Insert the data       
        $addReviewOutcome = addReview($clientId, $invId, $reviewText);
        if ($addReviewOutcome === 1) {
            $_SESSION['reviewMessage'] = "<p>Thank you. Your review has now been added. You can see it below!</p>";

            //update user's reviews
            // $userReviews = getReviewsByUser($clientId);
            $_SESSION['userReviews'] = $userReviews;

            header('location: /phpmotors/accounts/');

            exit;
        } else {
            $message = "<p>Sorry, but the vehicle registration failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;

//	Deliver a view to edit a review.
    case 'editreview':
        //get the review id
        $reviewId = filter_input(INPUT_GET, 'reviewid', FILTER_VALIDATE_INT);
        //get the info on that item based on id
        $reviewDetails = getReviewById($reviewId);
        //If no info, display message
        if (count($reviewDetails) < 1) {
            $message = 'Sorry, no review could be found.';
        }
        $_SESSION['reviewDetails'] = $reviewDetails;

        include '../view/review-update.php';
        break;


        //	Handle the review update.
    case 'updatereview':
        //Filter & store the data
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        var_dump($reviewId);
        //Check for missing data
        if (empty($reviewText)) {
            $message = '<p class="warning">Please provide details for the review. It cannot be deleted here.</p>';
            include '../view/review-update.php';
            exit;
        }

        $updateResult = updateReview($reviewText, $reviewId);

        if ($updateResult) {
            $message = "<p class='warning'>Thank you. Your review has been updated.</p>";
            $_SESSION['message'] = $message;

            //update user's reviews
            $userReviews = getReviewsByUser($_SESSION['clientData']['clientId']);
            $_SESSION['userReviews'] = $userReviews;

            header('location: ../../phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='warning'>Sorry, but the review update failed. Please try again.</p>";
            include '../view/review-update.php';
            exit;
        }
        break;

        //    Handle the review deletion.
    case 'deletereview':
        //get the review id
        $reviewId = filter_input(INPUT_GET, 'reviewid', FILTER_VALIDATE_INT);
        //get the info on that item based on id
        $reviewDetails = getReviewById($reviewId);
        //If no info, display message
        if (count($reviewDetails) < 1) {
            $message = 'Sorry, no review could be found.';
        }
        $_SESSION['reviewDetails'] = $reviewDetails;

        include '../view/review-delete.php';
        break;

        //	Deliver a view to confirm deletion of a review.
    case 'confirmdelete':
        //Filter & store the data
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_STRING);

        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = '<p class="warning">Thank you. Your review has been deleted.</p>';
            $_SESSION['message'] = $message;

            //update user's reviews
            $userReviews = getReviewsByUser($_SESSION['clientData']['clientId']);
            $_SESSION['userReviews'] = $userReviews;

            header('location: ../../phpmotors/accounts/');
            exit;
        } else {
            $message = '<p class="warning">Error: Your review was not deleted.</p>';
            $_SESSION['message'] = $message;
            header('location: ../../phpmotors/accounts/');
            exit;
        }
        break;

    default:
        //update user's reviews
        $userReviews = getReviewsByUser($_SESSION['clientData']['clientId']);
        $_SESSION['userReviews'] = $userReviews;

        var_dump($_SESSION['userReviews']);

        include '../view/admin.php';
        break;
}
