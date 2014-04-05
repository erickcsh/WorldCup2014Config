<meta charset="utf8" />
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
	mysql_set_charset('utf8');
	
	 // get a product from products table
	$result = mysql_query("CALL getGrupos()");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
            $response["Grupos"] = array();
			$count =1;
			while($row = mysql_fetch_array($result)){
 				if ($count == 1 ) {
					$Grupos = array();
					$Grupos["Nombre"] = $row["nombre"];
					$Grupos["Integrantes"] = array();
				}
				array_push($Grupos["Integrantes"], $row["Pais"]);
				$count = $count+1;
				if ($count == 5) {
					array_push($response["Grupos"], $Grupos);
					$count =1;
				}
			}
			
			$response["success"] = 1;
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
