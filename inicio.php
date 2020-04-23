<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	include "config.php";
  	include "utils.php";
if (!$_POST){ 	
  	
  	$json=file_get_contents('php://input');
  	$data=json_decode($json);
  	$dbConn= connect($db);
		$sql = "SELECT c.*,ce.users_inf,e.name,ce.id as ids FROM calendar c inner join calendar_exam  ce on c.id=ce.calendar inner join exam e on ce.exam=e.id where c.exam_state='asignado' and ce.exam <> 0 order by c.id asc";
		//$sql = "SELECT * FROM patient";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		//echo json_encode(pg_fetch_array($result,PGSQL_ASSOC));
		$arra = (pg_fetch_all($result,PGSQL_ASSOC));
		
		//echo var_dump($arra);
		/*foreach ($arra as $valor){
			echo '<a href="http://localhost:4200/informes/'.$valor['ids'].'">'.$valor['date_c'].' '.$valor['name'].' - '.$valor['exam_state'].'</a> <br>';
		}*/


?>
<form action="#" method="post">
	<?foreach ($arra as $ar) {
		
 echo '<input type="checkbox" name="check_list[]" value='.$ar["ids"].'><label>'.$ar["id"].' '.$ar["name"].'</label><br/>';
}
?>
<input type="submit" name="submit" value="Submit"/>
</form>
<?
}
if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
	
	$idsa='';
	$val='';
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected){
	$idsa=$idsa.','.$selected;
	$val=$val.','.$selected;
}
$ssa=explode(',', $val);
	$dbConn= connect($db);
	echo var_dump($ssa);
	echo var_dump($val);
		$sql = "SELECT calendar FROM calendar_exam where id='".$ssa[1]."'";
		//$sql = "SELECT * FROM patient";
		$result = pg_query($sql) or die('La consulta fallo:'.pg_last_error());
		//echo json_encode(pg_fetch_array($result,PGSQL_ASSOC));
		$arra = (pg_fetch_array($result,null,PGSQL_ASSOC));
		echo $arra['calendar'];
}
	$str=$arra['calendar'].$idsa;
	
	header("Location: http://localhost:4200/informes/".base64_encode($str));
	//header("Location: http://localhost:4200/informes/".base64_encode($json_string));
	
}
?>