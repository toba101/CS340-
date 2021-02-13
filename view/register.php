<!DOCTYPE html>
<html lang="en-us">


<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>


<body>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
  <?php  echo $navList; ?>
</nav>

<main>
<h1>Register</h1>
  <?php
if (isset($message)) {
 echo $message;
}
?>
<form class="add" action="/phpmotors/accounts/index.php" method="post">
 <table class="regForm">
     <tr><td>
    <label for="clientFirstname">First Name<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="clientFirstname" name="clientFirstname" placeholder="Your name.." 
    <?php
    if(isset($clientFirstname)){
      echo "value='$clientFirstname'";
    }
    ?>required>
    </td></tr>
    <tr><td>
     <label for="clientLastname">Last Name<abbr class="req">*</abbr></label>
     </td><td>
    <input type="text" id="clientLastname" name="clientLastname" placeholder="Your last name.." 
    <?php
    if(isset($clientLastname)){
      echo "value='$clientLastname'";
    }
    ?> required>
    </td></tr>
    <tr><td>
    <label for="clientEmail">Email:<abbr class="req">*</abbr></label>
    </td><td>
    <input type="email" id="clientEmail" name="clientEmail" required placeholder="Enter a valid email address"
    <?php 
    if(isset($clientEmail)){
      echo "value='$clientEmail'";
    }
    ?>>
    </td></tr>
    <tr><td>
    <label for="clientPassword">password:<abbr class="req">*</abbr></label>
    </td><td>
    
    <input type="password" id="clientPassword" name="clientPassword"
     required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
 
     <span class="expect">
      Passwords must be at least 8 characters and contain at least 1 number,
      1 capital letter and 1 special character.</span>
    </td></tr>
    <tr><td colspan="2">  
        <input type="submit" name="submit" id="regbtn" value="Register">
        <input type="hidden" name="action" value="register">
    </td></tr>
 </table>
</form>
</main>

<hr>


    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>
</html>