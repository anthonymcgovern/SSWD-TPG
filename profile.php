<?php	
//start the session	
session_start();

//store the session in a variable		
$userName = $_SESSION['uname'];		

//Connect to the Database		
$dbhost = "gcdsrv.com";	
$dbuser = "pgriffin";	
$dbpassword = "levile32";	
$dbschema = "pgriffin_sswdproj";	

//1. connect to the server	
$connection = mysql_connect($dbhost, $dbuser, $dbpassword);		

//2. verify the connection	
if(!$connection){
	echo '<h1>There was a problem connecting to the server</h1><br/><br/>';
	die();	
	}
	
//3. choose the database	
$database = mysql_select_db($dbschema, $connection);	
//	if(!$database){	//	echo '<h1>there was a problem connecting to the database </h1><br/><br/>';	
//	die();	
//}	
//picupload	
if(isset($_POST['picsubmit'])){
		move_uploaded_file($_FILES['file']['tmp_name'],"profilePic/".$_FILES['file']['name']);
		$connect = mysql_connect($host, $dbUsername, $dbPassword, "profilePic");		
		$ps = mysql_query($connect, "UPDATE users SET image = '".$_FILES['file']['name']."' WHERE uname = '".$_SESSION['uname']."'");	
		}
		
		?>
		
<html>

<head>

<!--    <script language="JavaScript">
			function submitForm(){		 
			if(document.myForm.new1.value != document.myForm.new2.value)
			{			
			alert("New password doesnt match");	
			}		 
			else if(document.myForm.new1.value < document.myForm.new1.value.length(6)){
 			alert("Password too short");		
			}
			else if(document.myForm.new1.value == document.myForm.ext.value){ 
			alert("Matches existing password");		
			}else{		
			document.myForm.mySubmit.click();		 
			}		
			}	
			</script>
			-->
			
<title>Profile Page</title>
</head>

<body>	
<!-- page header with username and profile pic -->	
<h1> 	
<?php		
$ps = mysql_query($connection, "SELECT * FROM users");
		while($row = mysql_fetch_assoc($ps)){	
		echo $row['uname'] . "<br>";		
		if($row['image'] == ""){	
		echo "<img width='100' height='100' src='profilePic/default.jpg' alt='Default Pic'>";	
		}

		else{			
		echo "<img width='100' height='100' src='profilePic/".$row['image']."' alt='Pic'>";
		}
		}
		?>		
		
		</h1>	
		
		<!-- form to change picture -->		
			
		<form action = "" method ="post" enctype="multipart/form-data">		
		<input type = "file" name = "file">		
		<input type = "submit" name = "picsubmit">	
		</form>			

		<!--	<Change your password>	
		<h2> Edit your profile < /h2>
		<form to change your password >	
		<form method="post" action="profile.php" name="myForm">	
		<h3>Change your password</h3>
		Existing password<input type="password" name="ext"><br />	
		New password<input type="password" name="new1"><br />	
		Confirm password<input type="password" name="new2"><br />	
		
		<a href="javascript:submitForm()"><input type="submit" value="Change" ></a>	</form>	-->	
		</body>
		</html>
