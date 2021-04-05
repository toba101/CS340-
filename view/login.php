<!DOCTYPE html>
<html lang="en-us">

<body>
<main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav><?php  echo $navList; ?></nav>


<h1>Sign in</h1>
  <?php
  if (isset($message)) {
    echo $message;
}
  if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?> 
<form action="/phpmotors/accounts/index.php" method="post">
  <fieldset class= "wrap">
    <label for="clientEmail">Email Address</label>
    <input name="clientEmail" id="clientEmail" 
    <?php 
    if(isset($clientEmail)){echo "value='$clientEmail'";
    } 
    ?> required>

    <br>

    <label for="clientPassword">Password:</label>  
    <input type="password" name="clientPassword" id="clientPassword" 
     required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"> <br>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
    <label>&nbsp;</label> <br>
    <input type="submit" value="sign-in">
    <input type="hidden" name="action" value="Login-page">
  </fieldset>
 </form>
<a class= "register" href='/phpmotors/accounts/index.php?action=register' title="myAccount">Not a member yet - Register here!</a>

</main>

<hr>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>
</html>