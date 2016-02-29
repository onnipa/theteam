<?php
	session_start();
	//unset($_SESSION["a"]);
	//unset($_SESSION["b"]);
	//unset($_SESSION["c"]);
	session_unset(); 
	session_destroy(); 
	header("Location: login.php");
