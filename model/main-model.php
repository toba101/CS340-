<?php
//MAIN PHP MOTORS MODEL

function getClassifications(){
    //First, create a connection object from the phpmotors connection function. 
        /*Think about scope- how is this file locating and accessing the phpmotorsConnect 
        function within the library/connections.php file?*/
    $db = phpmotorsConnect();

    //The SQL statement to be used with the database. I'm selecting only the classificationName from the carclassification records.
    $sql = 'SELECT classificationName, classificationId 
            FROM carclassification 
            ORDER BY classificationName ASC'; 
    
    //Prepare the statement to be used with the phpmotors connection
        //Remember- -> is the object operator. I'm creating a new object here.
    $stmt = $db->prepare($sql);

    //Run the prepared statement
    $stmt->execute();

    //After executing the statement, the database will return data. This will store that data in an array.
    $classifications = $stmt->fetchAll();

    //Remember closing your connection in Java? You're not actually closing the connection- just closing this interaction.
    $stmt->closeCursor(); 

    //Send the array of data back to the controller (it'd better be the controller, or something is not right).
    return $classifications;
}
?>