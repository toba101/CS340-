<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?>
<?php
// Get the array of classifications
//   $classification = getClassifications();
$classificationId = $invInfo["classificationId"];

$classificationDropDown = '<select id="classification" name="classificationId">';
$classificationDropDown .= '<option>Choose a car classification</option>';
foreach ($classifications as $classification) {
 $classificationDropDown .= "<option value='$classification[classificationId]'";


if (isset($classificationId)){
if($classification['classificationId'] === $classificationId){
    $classificationDropDown .= ' selected ';
  }
} elseif(isset($invInfo['classificationId'])){
    if($classification['classificationId'] === 2){
     $classificationDropDown .= ' selected ';
    }
 }
 $classificationDropDown .=">$classification[classificationName]</option>";
}
$classificationDropDown .= '</select>';

// Refactor array values
$invId = $invInfo[0]["invId"];
$invMake = $invInfo[0]["invMake"];
$invModel = $invInfo[0]["invModel"];
$invDescription = $invInfo[0]["invDescription"] ;
$invImage = $invInfo[0]["invImage"];
$invThumbnail = $invInfo[0]["invThumbnail"] ;
$invPrice = $invInfo[0]["invPrice"] ;
$invStock = $invInfo[0]["invStock"];
$invColor = $invInfo[0]["invColor"];
$classificationId = $invInfo[0]["classificationId"];
$imgId = $invInfo[0]["imgId"];
$imgName = $invInfo[0]["imgName"];
$imgPath = $invInfo[0]["imgPath"];
$tnPath = $invInfo[1]["imgPath"];
$imgDate = $invInfo[0]["imgDate"];
$imgPrimary = $invInfo[0]["imgPrimary"];

?><!DOCTYPE html>
<html lang="en-us">

<head>
<title>
<?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?>PHP Motors Add Vehicle</title>
<meta charset="utf-8">
<link href="/PHPMOTORS/css/small.styles" rel="stylesheet" media="screen">
<link href="/phpmotors/css/large.styles" rel="stylesheet" media="screen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<main>

<div id="entire">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';?> 
</nav>

<h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></h1>
<p>*All fields are required</p>

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
<input type="text" id="invMake" name="invMake" 
<?php
if (isset($invMake)) {
    echo "value='$invMake'";
    } elseif (isset($invInfo[0]['invMake'])) {
    echo 'value="' . $invInfo[0]['invMake'] . '"';
    }  ?> type="text" id="invMake" name="invMake" placeholder="Required" autofocus required>
    </td></tr>

    <tr><td>
    <label for="invModel">Model<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="invModel" name="invModel" 
    <?php 
    if(isset($invModel)){ 
        echo "value='$invModel'"; } 
        elseif(isset($invModel)) {
        echo "value='$invModel'";
    }   
    ?> required>
    </td></tr>

    <tr><td>
    <label for="invDescription">Description<abbr class="req">*</abbr></label>
    </td><td>
    <textarea name="invDescription" id="invDescription" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
    ?></textarea>
    </td></tr>

    <tr><td>
    <label for="invImage">Image<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="invImage" name="invImage" 
    <?php
    if(isset($invImage)){ 
        echo "value='$invImage'"; } 
        elseif(isset($imgPath)) {
        echo "value='$imgPath'"; 
    }
    ?> required>
    </td></tr>

    <tr><td>
    <label for="invThumbnail">Thumbnail<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="invThumbnail" name="invThumbnail"  
    <?php
    if(isset($invThumbnail)){ 
        echo "value='$invThumbnail'"; } 
        elseif(isset($tnPath)) {
        echo "value='$tnPath'"; 
    }
    ?> required>
    </td></tr>

    <tr><td>
    <label for="invPrice">Price<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="invPrice" name="invPrice" 
    <?php
    if(isset($invPrice)){ 
        echo "value='$invPrice'"; } 
        elseif(isset($invInfo['invPrice'])) {
        echo "value='$invInfo[invPrice]'"; 
    }
    ?> required>
    </td></tr>

    <tr><td>
    <label for="invStock">Stock<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="invStock" name="invStock" 
    <?php
    if(isset($invStock)){ 
        echo "value='$invStock'"; } 
        elseif(isset($invInfo['invStock'])) {
        echo "value='$invInfo[invStock]'"; 
    }
    ?> required>
    </td></tr>

    <tr><td>
    <label for="invColor">Color<abbr class="req">*</abbr></label>
    </td><td>
    <input type="text" id="invColor" name="invColor" 
    <?php
     if(isset($invColor)){ 
        echo "value='$invColor'"; } 
        elseif(isset($invInfo['invColor'])) {
        echo "value='$invInfo[invColor]'"; 
    }
    ?> required>
    </td></tr>

    <tr><td colspan="2">  
    <input type="submit" name="submit" id="regbtn" value="Update Vehicle">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="
    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
    elseif(isset($invId)){ echo $invId; } ?>">
        </td></tr>
 </table>
</form>
</main>

<hr>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 

</body>
</html>