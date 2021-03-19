<?php
if($_SESSION['clientData']['clientLevel'] < 2){
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
} elseif(isset($invInfo['classificationId'])){
    if($classification['classificationId'] === $invInfo['classificationId']){
     $classificationDropDown .= ' selected ';
    }
 }
 $classificationDropDown .=">$classification[classificationName]</option>";
}
$classificationDropDown .= '</select>';

?><!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors Delete</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/phpmotors/styles/small.css" type="text/css" rel="stylesheet" media="screen">
  <link href="/phpmotors/styles/large.css" type="text/css" rel="stylesheet" media="screen"> 
</head>

<body>
<main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';?>  
 
<nav> <?php echo $navList; ?> </nav>


<h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?>
</h1>
<p>Confirm Vehicle Deletion. The delete is permanent.</p>

<form action="/phpmotors/vehicles/index.php" method="post">
      <div class="form">
        <label class="label" for="invMake">Make:</label><br>
        <input class="loginInput" type="text" name="invMake" id="invMake" readonly <?php if (isset($invInfo['invMake'])) {
                                                                                      echo "value='$invInfo[invMake]'";
                                                                                    }  ?>> <br>
        <label class="label" for="invModel">Model:</label><br>
        <input class="loginInput" type="text" name="invModel" id="invModel" readonly <?php if (isset($invInfo['invModel'])) {
                                                                                        echo "value='$invInfo[invModel]'";
                                                                                      } ?>><br>
        <label class="label" for="invDescription">Description:</label><br>
        <textarea class="loginInput" name="invDescription" id="invDescription" rows="6" readonly><?php if (isset($invInfo['invDescription'])) {
                                                                                                    echo "$invInfo[invDescription]";
                                                                                                  } ?></textarea>
        <input class="register" type="submit" name="submit" value="Delete Vehicle" e>
        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                    echo $invInfo['invId'];
                                                  }  ?>">
      </div>
    </form>

<!-- <form method="post" action="/phpmotors/vehicles/">
<fieldset>
<table class="regForm">
<tr><td>
  <label for="invMake">Vehicle Make</label>
	<input type="text" readonly name="invMake" id="invMake" <php
    if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
</tr></td>

<tr><td>
  <label for="invModel">Vehicle Model</label>
	<input type="text" readonly name="invModel" id="invModel" <php
if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
</tr></td>

<tr><td>
  <label for="invDescription">Vehicle Description</label>
	<textarea name="invDescription" readonly id="invDescription">
<php
if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
?>
</textarea>
</tr></td>

<tr><td>
<input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

<input type="hidden" name="action" value="deleteVehicle">
<input type="hidden" name="invId" value="<php if(isset($invInfo['invId'])){
echo $invInfo['invId'];} ?>">
</td></tr>
</table>
</fieldset>
</form> -->

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</body>
</html>