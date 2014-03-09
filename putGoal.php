<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 

 
// check for post data
if (isset($_POST["idJugador"])&&isset($_POST["minuto"])&&isset($_POST["idPartido"])) {

    $idJugador = $_POST['idJugador'];
	$minuto = $_POST['minuto'];
	$idPartido = $_POST['idPartido'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
 
	// connecting to db
	$db = new DB_CONNECT();
 
    // get a product from products table
	$result = mysql_query("CALL agregarGol($idJugador, $minuto, $idPartido)");
 
    if ($result) {

		// success
		$response["success"] = 1;
		$response["message"] = "Goal successfully created";

		// echoing JSON response
		echo json_encode($response);
        
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error ocurred";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>