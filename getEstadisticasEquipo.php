<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 
// check for post data
if (isset($_POST["idEquipo"])) {
    $idEquipo = $_POST['idEquipo'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	
	 // get a product from products table
	$result = mysql_query("CALL getEstadisticasEquipo($idEquipo)");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
//Nuevo
			$result = mysql_fetch_array($result);
 
            $estadisticasEquipo = array();
            $estadisticasEquipo["puntos"] = $result["puntos"];
            $estadisticasEquipo["partidosJugados"] = $result["partidosJugados"];
			$estadisticasEquipo["partidosGanados"] = $result["partidosGanados"];
			$estadisticasEquipo["partidosEmpatados"] = $result["partidosEmpatados"];
			$estadisticasEquipo["partidosPerdidos"] = $result["partidosPerdidos"];
			$estadisticasEquipo["golesAFavor"] = $result["golesAFavor"];
			$estadisticasEquipo["golesEnContra"] = $result["golesEnContra"];
			$estadisticasEquipo["golDiferencia"] = $result["golDiferencia"]; 
            // success
            $response["success"] = 1;
 
            // user node
            $response["estadisticasEquipo"] = array();
 
            array_push($response["estadisticasEquipo"], $estadisticasEquipo);
 
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