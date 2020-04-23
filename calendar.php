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

		$sq= "SELECT c.*,ce.users_inf,ce.exam FROM calendar_exam ce inner join calendar  c on c.id=ce.calendar where ce.calendar='".$data->id."' ";
		$res= pg_query($sq);
		//$resu=pg_fetch_array($res,null,PGSQL_ASSOC);
		echo json_encode(pg_fetch_array($res,null,PGSQL_ASSOC));
		//echo json_encode(pg_fetch_all($resu,PGSQL_ASSOC));
		exit();
	pg_close($dbConn);
	
?>