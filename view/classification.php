<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/phpmotors/styles/small.css" type="text/styles" rel="stylesheet" media="screen">
  <link href="/phpmotors/styles/large.css" type="text/styles" rel="stylesheet" media="screen">
</head>

<body>
<main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';?>   

<nav><?php  echo $navList; ?></nav>

<h1><?php echo $classificationName; ?> vehicles</h1>

<?php if(isset($message)){
 echo $message; }
 ?>

<?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>

<hr>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';?>

</main>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>