<!DOCTYPE html>
<html lang="en">

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>
<body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 

<nav><?php echo $navList;?></nav>
<main>

<?php // var_dump($vehicleData)?>

<?php 
// echo $vehicleData[0]['invMake'] . ' ' . $vehicleData[0]['invModel'] 
?>
    <p>Reviews can be found beneath the vehicle details.</p>
    <?php
    //  if (isset($message)) {
    //     echo $message;
    // } 
    ?>
    <?php 
    if (isset($vehicleDisplay)) {
    // $invId = $vehicleDisplay[0]['invId'];
        echo $vehicleDisplay;
        } 
    ?>
    <h1>Customer Reviews</h1>
    <?php
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == TRUE) {
        echo '<p>To add a review, please <a href="http://localhost/phpmotors/accounts/index.php?action=login" title="Log In to Your Account">Log In</a></p>';
}   else {
    //Display Review Message if there is one
    if (isset($_SESSION['reviewMessage'])) {
        echo $_SESSION['reviewMessage'];
    }
    //create username
    $screenName = buildScreenName();

    //Add review form
    $reviewForm = '<form method="post" action="/phpmotors/reviews/index.php"><fieldset>';
    $reviewForm .= '<legend>Add Your Review</legend>';
    $reviewForm .= '<label id="screenName">Screen Name</label>';
    $reviewForm .= "<input name='screenName' type='text' readonly value='$screenName'>";
    $reviewForm .= '<label id="reviewText" >Your Review</label>';
    $reviewForm .= '<textarea name="reviewText"></textArea>';
    $reviewForm .=  '<input type="submit" name="submit" value="Add Review" class="primary-button">';
    $reviewForm .=  '<input type="hidden" name="action" value="addreview">';
    $reviewForm .=  '<input type="hidden" name="clientId" value="' . $_SESSION['clientData']['clientId'] . '">';
    $reviewForm .=  '<input type="hidden" name="invId" value="' . $invId . '">';
    $reviewForm .= '</fieldset></form>';
    echo $reviewForm;
}
 if ($reviewUser){echo $reviewUser;} 
 
            // if (count($reviews) == 0) {
            //     echo '<p>Be the first to review!</p>';
            // } else {
            //     echo $reviewDetails;
            // }
?>

<?php //if(isset($message)){
 //echo $message; }
 ?>
<?php if(isset($vehicleDetail)){
echo "<table><tr id='both'><td id='thumb'><h2 class='hidden'>Thumbnails</h2>".$vehicleThumbnails."</td><td>".$vehicleDetail."</td></tr></table>";
 } 
 ?>

</main>
<hr>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';?>

</body>
</html>