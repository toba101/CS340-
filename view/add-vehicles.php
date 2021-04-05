<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?>
<?php
// Get the array of classifications
$classifications = getClassifications();

$classificationDropDown = '<select id="classification" name="classificationId">';
$classificationDropDown .= '<option>Choose a car classification</option>';
foreach ($classifications as $classification) {
 $classificationDropDown .= "<option value='$classification[classificationId]'";


 if (isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
    $classificationDropDown .= ' selected ';
  }
 }
 $classificationDropDown .=">$classification[classificationName]</option>";
}
$classificationDropDown .= '</select>';

?><!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>

<body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav><?php echo $navList; ?></nav>

<main>
  
<?php
if(isset($message))
  echo $message;
?> 

<h1> Add Vehicle </h1>
<form class="add" action="/phpmotors/vehicles/index.php" method="post">
<table class="regForm">
<tr><td>
<label id="classificationId">Classification<abbr class="req">*</abbr></label>
</td><td>
<?php echo $classificationDropDown; ?>
</td></tr>

<tr><td>
<label for="invMake">Make<abbr class="req">*</abbr></label>
</td><td>
<input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required>
</td></tr>

<tr><td>
<label for="invModel">Model<abbr class="req">*</abbr></label>
</td><td>
<input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?>required> 
</td></tr>

<tr><td>
<label for="invDescription">Description<abbr class="req"></abbr></label>
</td><td>
<!-- <input type="text" id="invDescription" name="invDescription" required> -->
<textarea id="invDescription" name="invDescription" required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea> -->
</td></tr>

<tr><td>
<label for="invImage">Image<abbr class="req">*</abbr></label>
</td><td>
<input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" required>
</td></tr>

<tr><td>
<label for="invThumbnail">Thumbnail<abbr class="req">*</abbr></label>
</td><td>
<input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image 2.png" required>
</td></tr>

<tr><td>
<label for="invPrice">Price<abbr class="req">*</abbr></label>
</td><td>
<input type="number" id="invPrice" name="invPrice"
<?php
if(isset($invPrice)){
echo "value='$invPrice'";
}
?>
required>
</td></tr>

<tr><td>
<label for="invStock">Stock<abbr class="req">*</abbr></label>
</td><td>
<input type="number" id="invStock" name="invStock"
<?php
if(isset($invStock)){
echo "value='$invStock'";
}
?>
required>
</td></tr>

<tr><td>
<label for="invColor">Color<abbr class="req">*</abbr></label>
</td><td>
<input type="text" id="invColor" name="invColor" 
<?php
if(isset($invColor)){
echo "value='$invColor'";
}
?>
required>
</td></tr>

<tr><td colspan="2">
<input type="submit" name="submit" id="regbtn" value="Add Vehicle">
<!-- Add the action name - value pair -->
<input type="hidden" name="action" value="insertvehicle">
</td></tr>
</table>
</form>


</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</body>
</html>
    
