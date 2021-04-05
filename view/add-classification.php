<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
<?php echo $navList; ?>
</nav>

<main>

<h1>Add Car Classification</h1>
<form class="add" action="/phpmotors/vehicles/index.php" method="post">
<table class="regForm">
<tr><td>
<label id="classificationName">Classification Name<abbr class="req">*</abbr></label>
</td><td>
<input type="text" id="classificationName" name="classificationName" required>

<?php
if(isset($classificationName)){
echo "value='$classificationName'";
}
?>

</td></tr>

<tr><td colspan="2">
<input type="submit" name="submit" id="regbtn" value="Add Classification"> 
<!-- Add the action name - value pair -->
<input type="hidden" name="action" value="insertclassification">
</td></tr>
</table>
</form>


</main>
<hr>
<footer>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</footer>

</body>
</html>
    
