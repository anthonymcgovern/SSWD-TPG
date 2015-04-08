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
	
	// Select the schema!
	$database = mysql_select_db($dbschema, $connection);
	

	
	//on register store the posted username and password in sessions and register the user in the database
	if(isset($_POST['uname']) && isset($_POST['pword']) && isset($_POST['email'])){
		$_SESSION['uname'] = $_POST['uname'];
		$_SESSION['pword'] = $_POST['pword'];
		$_SESSION['email'] = $_POST['email'];
		
		$username = $_SESSION['uname'];
		$password = $_SESSION['pword'];
		$email = $_SESSION['email'];
		
	//Insert the entries from the users table 
	$sql = "INSERT INTO users VALUES ('', '', '" . $username . "', '" . $password . "', '" . $email . "')";	
	$result = mysql_query($sql, $connection);		
	
	//standard error checking 
	if(!$result) { 
    die(mysql_error()); 	
	}
	
}

	
	
?>
	
<html>
<head>
<title>Home</title>
</head>
<body>
	
	<?php
	
	$_SESSION['uname'] = $_POST['unameLogin'];
	$_SESSION['pword'] = $_POST['pwrdLogin'];
	$user = $_SESSION['uname'];
	$pass = $_SESSION['pword'];
	
	
	
	//Grab all the usernames from the users table and filter for the username in the form
	$sql1 = "SELECT * FROM users WHERE uname = '" . $user . "'";	
	$result1 = mysql_query($sql1, $connection);		
	
	//Grab all the passwords from the users table and filter for the password in the form
	$sql2 = "SELECT * FROM users WHERE pword = '" . $pass . "'";	
	$result2 = mysql_query($sql2, $connection);
	
	//standard error checking 
	if(!$result1 || !$result2) { 
    die(mysql_error()); 	
	}
	
	
	//Pull the username from the SQL table and store it in a variable  
		while ($row = mysql_fetch_array($result1)) {
		$verifyusr = $row['uname'];
		
}

	//Pull the password	from the SQL table and store it in a variable  
		while ($row = mysql_fetch_array($result2)) {
		$verifypswd = $row['pword'];
		
}
	
	//If the verifyuser variable isnt set display the logon page
	if(!isset($verifyusr) || !isset($verifypswd))
	{
	//<!--Create a form to login-->
	echo '<form action="home.php" method="post">';
	//<!-- Create input types for username and password -->
	echo 'Username:<input type="text" name="unameLogin">';
	echo 'Password:<input type="password" name="pwrdLogin">';
	//<!-- Create a submit button to send information in the form to be verified -->
	echo '<input type="submit" value="Login"></form>';
	
	
	//<!-- Login / Register link -->
	echo "Dont have an account Click to <a href='login.php'>Register </a>";
	echo "<BR>" . "<BR>";
	
	}
	
	//if verify variable is set display the logon button
	if(isset($verifyusr) && isset($verifypswd))	
	{
	echo "<BR>" . "<BR>";
	echo "<a href='profile.php'> My Profile </a>";
	echo "<BR>" . "<BR>";
	echo "<a href='home.php'>Logout </a>";
	
	//Destorys session so logon form appears again
	$verifyusr = "";
	$verifypswd = "";
	session_destroy();
	}
?>	
	<br><br>
	<BR><BR>
	<!-- Create a form to search for a game -->
	<center><form action="search.php" method="post">
	<input type="search" name="searchGame" Value="Search for a Game">
	<!-- Replace this with an image of search -->
	<input type="submit" value="Search">
	</form></center>
	
	<?php
	if(!isset($verifyusr) || !isset($verifypswd))
	{echo "No user logged in";}
	
	if(isset($verifyusr) && isset($verifypswd))
	{echo "Welcome " . $user;}
	?>
	
	
	<!-- Show Top Favs -->
	
</body>
</html>
