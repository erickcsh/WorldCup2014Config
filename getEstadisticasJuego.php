<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 
// check for post data
if (isset($_POST["idPartido"])) {
    $idPartido = $_POST['idPartido'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	
	 // get a product from products table
	$result = mysql_query("CALL getEstadisticasJuego($idPartido)");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
//Nuevo
			$result = mysql_fetch_array($result);
 
            $estadisticasJuego = array();
            $estadisticasJuego["Marcador"] = $result["Marcador"];
            $estadisticasJuego["TirosDirectos"] = $result["TirosDirectos"];
			$estadisticasJuego["TirosIndirectos"] = $result["TirosIndirectos"];
			$estadisticasJuego["TarjetasRojas"] = $result["TarjetasRojas"];
			$estadisticasJuego["TarjetasAmarillas"] = $result["TarjetasAmarillas"];
			$estadisticasJuego["Faltas"] = $result["Faltas"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["estadisticasJuego"] = array();
 
            array_push($response["estadisticasJuego"], $estadisticasJuego);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No Statistics found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "Statistics not found";
 
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