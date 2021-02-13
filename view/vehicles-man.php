<!DOCTYPE html>
<html lang="en-us">

<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>




<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<nav>
<?php echo $navList; ?>
</nav> 

<h2> Vehicle Management </h2>
 <a href="/phpmotors/vehicles?action=add-classification" title="myAccount" 
  target="_self">Add Classification</a><br>
 <a href="/phpmotors/vehicles?action=addvehicle" title="myAccount" 
  target="_self">Add Vehicle</a>

<main>
<h2>Content Here </h2>

</main>
<hr>


    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>


</body>
</html>
    
