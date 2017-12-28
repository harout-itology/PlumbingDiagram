<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */

$servername = "localhost";
$username = "root";
$password = "1111";
$db = "plumbingdiagram";

function data_connect($servername,$db,$username,$password)
{
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	} catch (PDOException $e) {
		return  "Connection failed: " . $e->getMessage();
	}
}
?>

