<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<body>
<main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
  <?php  echo $navList; ?>
</nav>

<h1>Register</h1>
  <?php
if (isset($message)) {
 echo $message;
}
?>

</main>

<form action="/phpmotors/accounts/index.php" method="post">
<fieldset class= "wrap">
 <label for="clientFirstname">First Name</label>
 <input name="clientFirstname" id="clientFirstname" <?php 
 if(isset($clientFirstname)){echo "value='$clientFirstname'";
} ?> required>
 
<br>

<label for="clientLastname">Last Name</label>
 <input type="text" name="clientLastname" id="clientLastname" <?php
 if (isset($clientLastname)) {
   echo "value='$clientLastname'";
} ?> required>

<br>

<label for="clientEmail">Email Address</label>
<input name="clientEmail" id="clientEmail" 
<?php 
if(isset($clientEmail)){echo "value='$clientEmail'";
} ?> required>

<br>

<label for="clientPassword">Password:</label> 
<input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"> <br>
<span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 

<br>

<input type="submit" name="submit" id="regbtn" value="Register">

 <input type="hidden" name="action" value="register">
 </fieldset>
 </form>

<hr>


    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>
</html>