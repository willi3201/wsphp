<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

  	
  	include "config.php";
  	include "utils.php";
  	$json=file_get_contents('php://input');
  	$data=json_decode($json);
	//$dbConn = pg_connect('host= port=5432 dbname=postgre user=post password=1234') or die('No se ha podido conectar:'.pg_last_error());
  	$dbConn= connect($db);

		$sql = "SELECT e.* FROM employee e inner join users u on u.employee=e.id where u.id='".$data->id."'";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		echo json_encode(pg_fetch_all($result,PGSQL_ASSOC));
		//echo json_encode(pg_fetch_all($resu,PGSQL_ASSOC));
		exit();
	pg_close($dbConn);
	
?>