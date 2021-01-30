<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
  <?php  echo $navList; ?>
</nav>

<main>
<h1>Sign in</h1>
  <?php
//  if (isset($_SESSION['message'])) {
//   echo $_SESSION['message'];
//  }
?> 
<form class="add" action="/phpmotors/accounts/index.php" method="post">

 <table class= "Login">
   <tr><td>
   <label id="email">Email:<abbr class="req">*</abbr></label>
  
   <input type="email" id="clientEmail" name="clientEmail" required placeholder="Enter a valid email address"<?php 
    if(isset($clientEmail)){
      echo "value='$clientEmail'";
    }
    ?>>
    </td><td>
    </td></tr>

    <tr><td>
   <label for="clientPassword">Password:<abbr class="req">*</abbr></label>
  
   <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
   <span class="expect"> 
      Passwords must be at least 8 characters and contain at least 1 number,
      1 capital letter and 1 special character. </span>
    </td><td>
    </td></tr>

    <tr><td colspan="2"> <input type="submit" value="Sign-in"></td>
    </tr>
  </table>  
    <input type="hidden" name="action" value="login">
</form>
<p></p>
<a class= "register" href='/phpmotors/accounts/index.php?action=register' title="myAccount">Not a member yet - Register here!</a>

</main>

<hr>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>
</html>