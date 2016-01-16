<?php 

$host = 'localhost';
$user = 'root';
$password = '1234';
$database = 'rpi';

$conn = mysqli_connect($host, $user, $password, $database); 
if(!$conn) 
{ 
	trigger_error('Error when connecting: '.mysqli_connect_error()); 
} 

$stmt = $conn->prepare('SELECT * FROM `rpi_users` WHERE Name=? AND Password=?;');
$stmt->bind_param("ss", $name, $password);

$name = $_REQUEST['name'];
$password = $_REQUEST['password'];

$stmt->execute();

$result = $stmt->get_result();
echo $result->num_rows;

$stmt->close();
$conn->close();

?>