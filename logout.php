<?php
	// Resume session on this page before destroying it!
	session_start();
	
	session_destroy();
	unset($_SESSION['uname']);
	unset($_SESSION['pword']);
	
	
	echo 'You are logged out! You will now be redirected to the home page';
?>
<html>
<head><meta http-equiv="refresh" content="10; url=home.php" /></head>
</html>
