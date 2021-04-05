<?php
// Validate email address
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }

   
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function navList($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
       $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName']). "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
$classificationList = '<select name="classificationId" id="classificationList">'; 
$classificationList .= "<option>Choose a Classification</option>"; 
foreach ($classifications as $classification) { 
$classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
} 
$classificationList .= '</select>'; 
return $classificationList; 
}

function updatePassword($hashedPassword, $clientId)
{
    $db = phpmotorsConnect();

    //The SQL statement
    $sql =
        'UPDATE clients 
        SET clientPassword = :clientPassword
        WHERE clientId = :clientId';

    //Create the prepared statement using the PHP Motors connection
    $stmt = $db->prepare($sql);

    //These will replace the :placeholders in the sql and give the data type
    $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed due to the insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //Return the indication of success
    return $rowsChanged;
}

function checkImg($path)
{
    $pattern = '([^\s]+(\.(?i)(jpg|png|gif|bmp))$)';
    return preg_match($pattern, $path);
}

function buildThumbImages($thumbImages) {
    $dv = '<ul>';
    foreach ($thumbImages as $thumbImage) {
     $dv .= '<li>';
     $dv .= "<img class='thumbCarList' src='$thumbImage[imgPath]' alt='Image of $thumbImage[imgName] on phpmotors.com'>"; 
     $dv .= '</li>'; 
    }
    $dv .= '</ul>';
    return $dv;    
   }

   // Build a display of vehicles within an unordered list.
    function buildVehiclesDisplay($vehicles){
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
         $dv .= '<li>';
         $dv .= "<a href='/phpmotors/vehicles/index.php/?action=vehicleDetails&invId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
         $dv .= '<hr>';
        //  $dv .= "$vehicle[invThumbnail]";
         $dv .= "<h2><a href='/phpmotors/vehicles/index.php/?action=vehicleDetails&invId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
         $dv .=   "<span>$".number_format($vehicle['invPrice'],2)."</span>";
         $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
       }

   function buildVehicleDetails($carId) {
    // $className = $class;
    $price = number_format($carId['invPrice'], 2, '.',',');
    $dv = "<div class='form'><img class='carImage' src='$carId[imgPath]' alt='image of $carId[invMake] $carId[invModel] on phpmotors.com'></div>";
    $dv .= "<div class='form'><h2>$carId[invMake] $carId[invModel] </h2>";
    $dv .= "<h3 id='price'>Price: $$price  </h3>";
    // $dv .= "<P>Car Type: $className[classificationName] </p>";
        if ($carId['invDescription']) {
            $dv .= "<P>Description:  $carId[invDescription]  </p>";
        }
    $dv .= "<P>Number in Stock: $carId[invStock]  </p>";
    $dv .= "<P>Color: $carId[invColor]  </p></div>";
    return $dv;
   }

   function buildUserReviewDetails($reviews){

    $rd = '<ul class="reviews">';

    foreach ($reviews as $review) {
        //get user
        $firstInitial = strtoupper(substr($review['clientFirstname'], 0, 1));
        $lastInitial = strtoupper(substr($review['clientLastname'], 0, 1));
        $lastName = strtolower(substr($review['clientLastname'], 1));
        $screenName = $firstInitial . $lastInitial . $lastName;

        //get date
        $unix = strtotime($review['reviewDate']);
        $date = date("M j Y", $unix);

        $reviewId = $review['reviewId'];

        $rd .= '<li>';
        $rd .= "<a href='/phpmotors/reviews/index.php?action=editreview&reviewid=$reviewId' class='review-edit'>Edit</a>";
        $rd .= "<a href='/phpmotors/reviews/index.php?action=deletereview&reviewid=$reviewId' class='review-delete'>Delete</a>";
        $rd .= "<p class='review-screenname'>$screenName</p>";
        $rd .= "<p class='review-date'>$date</p>";
        $rd .= "<p class='review-text'>$review[reviewText]</p>";
        $rd .= '</li>';
    }

    $rd .= '</ul>';

    return $rd;
}
   
// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }


//Building thumbnails list 
function buildThumbnails($vehicles){
    //$dv = ""; 
    $dv = "<ul id='inv-thumbnail'>";
    foreach ($vehicles as $vehicle) {
    $dv .= "<li><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></li>";
    }
    $dv .= "</ul>";
     return $dv; 
   }

function buildReviewDetails($reviews){
$rd = '<ul class="reviews">';
foreach ($reviews as $review) {
    //get user
    $firstInitial = strtoupper(substr($review['clientFirstname'], 0, 1));
    $lastInitial = strtoupper(substr($review['clientLastname'], 0, 1));
    $lastName = strtolower(substr($review['clientLastname'], 1));
    $screenName = $firstInitial . $lastInitial . $lastName;

    //get date
    $unix = strtotime($review['reviewDate']);
    $date = date("M j Y", $unix);

    $rd .= '<li>';
    $rd .= "<p class='review-screenname'>$screenName</p>";
    $rd .= "<p class='review-date'>$date</p>";
    $rd .= "<p class='review-text'>$review[reviewText]</p>";
    $rd .= '</li>';
}
    $rd .= '</ul>';
    return $rd;
}
function buildScreenName()
{
    $firstInitial = strtoupper(substr($_SESSION['clientData']['clientFirstname'], 0, 1));
    $lastInitial = strtoupper(substr($_SESSION['clientData']['clientLastname'], 0, 1));
    $lastName = strtolower(substr($_SESSION['clientData']['clientLastname'], 1));
    $screenName = $firstInitial . $lastInitial . $lastName;

    return $screenName;
}
// Adds "-tn" designation to file name

function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }
   // Build images display for image management view

function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a class= 'account' href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }

function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}
   // Processes images by getting paths and 
// creating smaller versions of the image

function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
    // Set up the image path
    $image_path = $dir . $filename;
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }
   // Checks and Resizes image

function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function
   ?>