<?php
	function Conectarse()
	{
		/* Funcion para conectarse a la base de datos en localhost */
		$link = mysqli_connect("localhost", "root", "root", "bestnid", 3307);

		if (mysqli_connect_errno()) 
		{
    		printf("Connect failed: %s\n", mysqli_connect_error());
    		exit();
		}
		return $link;
	}
?>