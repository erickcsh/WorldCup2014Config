<?php
 
/*
 * 
 */
 
// array for JSON response
$response = array();
 
// check for post data
	
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	
	 // get a product from products table
	$result = mysql_query("CALL getGrupos()");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
//Nuevo
			$result = mysql_fetch_array($result);
 
            $Grupos = array();
            $Grupos["Pais"] = $result["Pais"];
            $Grupos["nombre"] = $result["nombre"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["Grupos"] = array();
 
            array_push($response["Grupos"], $Grupos);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No groups found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "Groups not found";
 
        // echo no users JSON
        echo json_encode($response);
    }
?>