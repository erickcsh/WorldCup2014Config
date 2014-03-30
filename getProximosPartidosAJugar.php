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
	$result = mysql_query("CALL getProximosPartidosAJugar($fechaCalculo)");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
			// user node
            $response["proximosPartidos"] = array();
			while($row = mysql_fetch_array($result))
			{
				$Partido = array();
				$Partido["id"] = $row["id"];
				$Partido["Visita"] = $row["Visita"];
				$Partido["Casa"] = $row["Casa"];
				$Partido["Estadio"] = $row["Estadio"];
				$Partido["Ronda"] = $row["Ronda"];
				$Partido["Estado"] = $row["Estado"];
				$Partido["fecha"] = $row["fecha"];
				$Partido["hora"] = $row["hora"]; 
				
	 
				array_push($response["proximosPartidos"], $Partido);
			}
			// success
			$response["success"] = 1;
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