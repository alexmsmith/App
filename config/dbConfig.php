<?php
try {
	$conn = new PDO('mysql:host=localhost;dbname=crimedatabase', 'root', '');
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}