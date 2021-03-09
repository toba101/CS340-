<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
exit;
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?>
<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<body>
<main>
  
<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
<?php echo $navList; ?>
</nav> 

<h2> Vehicle Management </h2>
 <a href="/phpmotors/vehicles?action=add-classification" title="myAccount" 
  target="_self">Add Classification</a><br>
 <a href="/phpmotors/vehicles?action=addvehicle" title="myAccount" 
  target="_self">Add Vehicle</a>

<?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Account Management</h2>'; 
 echo '<p class="class">Chose a classification to see those vehicles.</p>'; 
 echo $classificationList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<table id="inventoryDisplay"></table>

</main>
<hr>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

<script src="../js/inventory.js"></script>

</body>
</html>
<?php unset($_SESSION['message']); ?>