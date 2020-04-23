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
/*if($data->pet=='patient'){
		$sq= "SELECT patient FROM calendar where id='".$data->id."'";
		$res= pg_query($sq);
		$resu=pg_fetch_array($res,null,PGSQL_ASSOC);
		$sql = "SELECT * FROM patient WHERE id='".intval($resu['patient'])."'";
		//$sql = "SELECT * FROM patient";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		//echo json_encode(pg_fetch_array($result,null,PGSQL_ASSOC));
		echo json_encode(pg_fetch_all($result,PGSQL_ASSOC));
		exit();
	}*/

	if($data->pet=='patient'){
		$sql = "SELECT * FROM patient WHERE id='".$data->id."'";
		//$sql = "SELECT * FROM patient";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		//echo json_encode(pg_fetch_array($result,null,PGSQL_ASSOC));
		echo json_encode(pg_fetch_all($result,PGSQL_ASSOC));
		exit();
	}else if($data->pet=='medico'){
		$sql = "SELECT * FROM users u where state='activo' and u.id='".$data->id."' ORDER BY u.id ASC";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		echo json_encode(pg_fetch_all($result,PGSQL_ASSOC));
		exit();
	}else if($data->pet=='template'){
		$src=explode(",",$data->exam);
		//echo var_dump($data->exam);
		$exam="ce.id=".$src[0];
		for ($i=1; $i <count($src); $i++) { 
			$exam=$exam." or ce.id=".$src[$i];
		}
		$sql = "SELECT e.name,c.patient FROM calendar_exam ce inner join exam e on ce.exam=e.id inner join calendar c on c.id=ce.calendar where (".$exam.") and ce.users_inf='".$data->id."' and ce.calendar='".$data->calendar."' and c.patient='".$data->patient."' and c.exam_state='asignado'";
		
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		echo json_encode(pg_fetch_all($result,PGSQL_ASSOC));
		exit();
	}else if($data->pet=='doctor'){
		$sql = "SELECT * FROM ref_doctor where id='".$data->id."'";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		echo json_encode(pg_fetch_all($result,PGSQL_ASSOC));
		exit();
	}else {
		echo '<h3>no se ha podido leer la peticion '.$data->pet;
		exit();
	}


	pg_close($dbConn);
	
?>