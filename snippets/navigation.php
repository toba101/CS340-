<!-- <nav>
 <div class="topnav" id="myTopnav">
    <ul class="navigaton">
        <li><a href="home.php">Home</a></li>
        <li><a href="classic.php">Classic</a></li>
        <li><a href="sports.php">Sports</a></li>
        <li><a href="suv.php">SUV</a></li>
        <li><a href="truck.php">Truck</a></li>
        <li><a href="used.php">Used</a></li> 
    </ul>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i></a>
</nav> -->
<?php  
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();

$navList = '<nav><ul class="navigation">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul></nav>';
?>