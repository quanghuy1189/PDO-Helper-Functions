<?php
	
	$config = array(
		'username' => 'username',
		'password' => 'password'
	);

  /* 
  |----------------------------------------------------------------------------
  |Connect to mySQL database. Can switch host between 'localhost' and '127.0.0.1'
  |----------------------------------------------------------------------------
  */
  
	function connect($config)
	{
		try {
			$conn = new PDO('mysql:host=127.0.0.1;dbname=practice',
							$config['username'], 
							$config['password']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch(Exception $e) {
			return false;
		}
	}


  /* 
  |----------------------------------------------------------------------------
  |Query from Database 
  |----------------------------------------------------------------------------
  */
  
  
	function query($query, $bindings, $conn) 
	{
		$stmt = $conn->prepare($query);
		$stmt->execute($bindings);
		$result = $stmt->fetchAll();

		return $result ? $result : false;
	}

  /* 
  |----------------------------------------------------------------------------
  |Query from Database 
  |----------------------------------------------------------------------------
  */

	function get($tableName, $conn)
	{
		try {
			$result = $conn->query("SELECT * FROM $tableName");

			return ($result->rowCount() > 0)
				? $result
				: false;
		} catch (Exception $e) {
			return false;
		}
	}
?>
