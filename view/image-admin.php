<?php 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Image Management</title>
<meta charset="utf-8">
<link href="/phpmotors/css/small.css" rel="stylesheet" media="screen">
<link href="/phpmotors/css/large.css" rel="stylesheet" media="screen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';?> 

<nav><?php echo $navList; ?></nav>

<main>
  <h1>Image Management</h1>
  <h2>Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>
<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Vehicle</label>
  <?php echo $prodSelect;?>
    <fieldset>
        <label>Is this the main image for the vehicle?</label>
        <label for="priYes" class="pImage">Yes</label>
        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
        <label for="priNo" class="pImage">No</label>
        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
    </fieldset>
 <label>Upload Image:</label>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<hr>
<h2>Existing Images</h2>
<p class="message">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
</main>

<footer>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
</footer>

</body>
</html>
<?php unset($_SESSION['message']); ?>