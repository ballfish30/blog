<?php
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'blog';

  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 8443);
  return $link
?>