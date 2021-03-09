<!-- 
//Image Uploads Controller

session_start();

//* * * * * * * * * * * * * * CONNECTIONS/DATA * * * * * * * * * * * * * * * * * * *
require_once '../library/connections.php';
require_once '../models/main-model.php';
require_once '../models/vehicles-model.php';
require_once '../models/uploads-model.php';
require_once '../library/functions.php';

//build classifications
$classifications = getClassifications();

//* * * * * * * * * * * * * * NAVIGATION * * * * * * * * * * * * * * * * * * *
$navList = createNavList();

//* * * * * * * * * * VARIABLES FOR IMAGE UPLOAD FUNCTIONALITY * * * * * * * * * * * * *
//directory name where uploaded images are stored
$image_dir = '/phpmotors/images/vehicle';

//the path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

//* * * * * * * * * * * * * * ACTION/VIEWS * * * * * * * * * * * * * * * * * * *
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action  = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'upload':
        //store the incoming vehicle id & primary pic indicator
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);

        //store the name of the uploaded img
        $imgName = $_FILES['file1']['name'];

        //check for existing file name
        $imageCheck = checkExistingImage($imgName);

        if ($imageCheck) {
            $message = '<p class="warning">An image by that name already exists.</p>';
        } elseif (empty($invId) || empty($imgName)) {
            $message = '<p class="warning">You must select a vehicle and image file for the vehicle.</p>';
        } else {
            //upload the img, store the returned path to the file
            $imgPath = uploadFile('file1');

            //Insert the image info to the db, get the result
            $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);

            //Set msg based on result
            if ($result) {
                $message = '<p class="warning">Upload success.</p>';
            } else {
                $message = '<p class="warning">Sorry, the upload failed.</p>';
            }
        }

        //store msg to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;

    case 'delete':
        //get the img name & id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);

        //build the full path to the img to be deleted
        $target = $image_dir_path . '/' . $filename;

        //check whether file exists
        if (file_exists($target)) {
            //Deletes file
            $result = unlink($target);
        }

        //Remove from database only if physical file was deleted
        if ($result) {
            $remove = deleteImage($imgId);
        }

        //set msg based on result
        if ($remove) {
            $message = "<p class='warning'>$filename was successfully deleted.</p>";
        } else {
            $message = "<p class='warning'>$filename was NOT deleted.</p>";
        }

        //store msg to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');

        break;

    default:
        //return img info from database
        $imageArray = getImages();

        //build img info into HTML for display
        if (count($imageArray)) {
            $imageDisplay = buildImageDisplay($imageArray);
        } else {
            $imageDisplay = '<p class="warning">Sorry, no images could be found.</p>';
        }

        //get vehicle info from db
        $vehicles = getVehicles();

        //build a select list of vehicle info for the view
        $prodSelect = buildVehicleSelect($vehicles);

        include '../view/image-admin.php';
        exit;

        break;
} -->
