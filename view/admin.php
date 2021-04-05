<?php
// Create or access a Session
//  session_start();

// Get the array of classifications

if(!$_SESSION['loggedin']){
  header('Location: /phpmotors/index.php');
  //include '/phpmotors';
  exit;
  }
//$classifications = getClassifications();
?>
<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>
<body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>  

<nav><?php echo $navList; ?></nav>

<main>
  <?php if(isset($_SESSION['clientData']['clientFirstname'])){
 echo "<h1>".$_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname']."</h1>";
} 
?> 
<p>You are logged in.</p>
<?php
if(isset($_SESSION['$reviewMessage'])){
      echo $_SESSION['reviewMessage'];
    }
  ?>


<!--<ul>
 <li>
    if(isset($_SESSION['clientData']['clientFirstname'])){
      echo "<p>First Name:".$_SESSION['clientData']['clientFirstname']."</p>";
    }
    ?> </li>
  <li>
    if(isset($_SESSION['clientData']['clientLastname'])){
      echo "<p>Last Name:".$_SESSION['clientData']['clientLastname']."</p>";
    }
    ?>   
  <li>
    if(isset($_SESSION['clientData']['clientEmail'])){
      echo "<p>Email:".$_SESSION['clientData']['clientEmail']."</p>";
    }

    if(isset($_SESSION['clientData']['clientLevel'] )){
      echo "<p>:".$_SESSION['clientData']['clientLevel']."</p>";
    }
    ?>
  </li> -->
  <h2>Account Management</h2>
  <p>Use this link to update account information.</p>
  <a href="/phpmotors/accounts?action=updateAccountview">Update Client Information</a> 

  <br>

  <h2>Inventory Management</h2>
  <p>Use this link to manage the inventory.</p>
  <a href='/phpmotors/vehicles/'>Vehicle Management</a>

 <h2>Review Management</h2>
    <?php
      if (isset($_SESSION['userReviews'])) {
        echo buildUserReviewDetails($_SESSION['userReviews']);
      } else {
        echo '<p>Once you leave reviews on the site, you can access them here.</p>';}
?>
</main>
  <hr>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';?>

</body>
</html>
