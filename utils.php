<?php 
	
	function connect($db)
	{
			$conn = pg_connect("host={$db['host']} dbname={$db['db']} user={$db['username']} password={$db['password']}") or die('No se ha podido conectar:'.pg_last_error());

			return $conn;
	}

?>