<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 
// check for post data
if (isset($_GET["fechaPartido"])) {
    $fechaPartido = $_GET['fechaPartido'];
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	
	 // get a product from products table
	$result = mysql_query("CALL getPartidos($fechaPartido)");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
			// user node
			$response["partidos"] = array();
			
			while($row = mysql_fetch_array($result)){
 
				$partido = array();
				$partido["id"] = $row["id"];
				$partido["visita"] = $row["visita"];
				$partido["casa"] = $row["casa"];
				$partido["estadio"] = $row["estadio"];
				$partido["hora"] = $row["hora"];
				array_push($response["partidos"], $partido);
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
        $response["message"] = "games not found";
 
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