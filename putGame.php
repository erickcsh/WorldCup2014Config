<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 

 // fk_paisVisita, fk_paisCasa, fk_estadio, hora, fecha, minuto, finalizado
// check for post data
if (isset($_POST['fk_paisVisita'])&&isset($_POST['fk_paisCasa'])&&isset($_POST['fk_estadio'])&&isset($_POST['hora'])&&isset($_POST['fecha'])&&isset($_POST['minuto'])&&isset($_POST['finalizado'])){

    $fk_paisVisita = $_POST['fk_paisVisita'];
	$fk_paisCasa = $_POST['fk_paisCasa'];
	$fk_estadio = $_POST['fk_estadio'];
	$hora = $_POST['hora'];
	$fecha = $_POST['fecha'];
	$minuto = $_POST['minuto'];
	$finalizado = $_POS$T['finalizado'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
 
	// connecting to db
	$db = new DB_CONNECT();
 
    // get a product from products table
	$result = mysql_query("CALL insertar_partido($fk_paisVisita, $fk_paisCasa, $fk_estadio,$hora,$fecha,$minuto,$finalizado)");
 
    if ($result) {

		// success
		$response["success"] = 1;
		$response["message"] = "Game successfully created";

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