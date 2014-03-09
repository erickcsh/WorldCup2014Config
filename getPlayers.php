<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 
// check for post data
if (isset($_POST["nombreEquipo"])) {
    $nombreEquipo = $_POST['nombreEquipo'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	
	 // get a product from products table
	$result = mysql_query("CALL jugadoresPorEquipo($nombreEquipo)");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		

			$result = mysql_fetch_array($result);
 
            $jugadores = array();
            $jugadores["id"] = $result["id"];
            $jugadores["nombre"] = $result["nombre"];
			$jugadores["numero"] = $result["numero"];
			$jugadores["posicion"] = $result["posicion"];
 
            // success
            $response["success"] = 1;
 
            // user node
            $response["jugadores"] = array();
 
            array_push($response["jugadores"], $jugadores);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No players found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "Country not found";
 
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