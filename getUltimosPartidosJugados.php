<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 
// check for post data
if (isset($_POST["fechaCalculo"])) {
    $fechaCalculo = $_POST['fechaCalculo'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	
	 // get a product from products table
	$result = mysql_query("CALL getultimosPartidosAJugar($fechaCalculo)");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
//Nuevo
			$result = mysql_fetch_array($result);
 
            $ultimosPartidos = array();
            $ultimosPartidos["id"] = $result["id"];
            $ultimosPartidos["Visita"] = $result["Visita"];
			$ultimosPartidos["Casa"] = $result["Casa"];
			$ultimosPartidos["Estadio"] = $result["Estadio"];
			$ultimosPartidos["Ronda"] = $result["Ronda"];
			$ultimosPartidos["Estado"] = $result["Estado"];
			$ultimosPartidos["fecha"] = $result["fecha"];
			$ultimosPartidos["hora"] = $result["hora"]; 
            // success
            $response["success"] = 1;
 
            // user node
            $response["ultimosPartidos"] = array();
 
            array_push($response["ultimosPartidos"], $ultimosPartidos);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No games found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "Games not found";
 
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