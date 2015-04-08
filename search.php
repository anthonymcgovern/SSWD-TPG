<?php
//Start Sessions
session_start();
	

	// Firstly, connect this script to the right database & schema
	$dbhost = "gcdsrv.com";
	$dbuser = "pgriffin";
	$dbpassword = "levile32";
	$dbschema = "pgriffin_sswdproj";
	
	$connection = mysql_connect($dbhost, $dbuser, $dbpassword);
	
	if(!$connection){
		echo 'Error connecting to the database!';
	die();
	}
	
	// Else, asssume we have connected successfully!

	
	//3. choose the database
	
	$database = mysql_select_db($dbschema, $connection);	
	
	
	
	
?>	

<html>
<head>
<title>Search for Games</title>
</head>
<body>

	<!-- Display info of the searched game -->
	<?php
		
	?>
	

	No Results found 
	
	<a href=home.php>Return home</a>
	
</body>
</html>
