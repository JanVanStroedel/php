<?php

function request($data){
	if(isset($_REQUEST[$data])){
		return $_REQUEST[$data];
	}
	else{
		return false;
	}
}

function clientIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

function validUser($username, $password){
	$url = 'http://localhost:8080/projects/RPIIPRegister/auth.php';
	$data = array('name' => $username, 'password' => $password);
	
	$options = array(
		'http' => array(
			'header'  => "Content-type:  application/x-www-form-urlencoded",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { 
		return false; 
	}
	
	return (((int)$result) > 0);
}

if(request('name') != false && request('password') != false){
	if(validUser(request('name'), request('password'))){
		$host = 'localhost';
		$user = 'root';
		$password = '1234';
		$database = 'rpi';

		$conn = mysqli_connect($host, $user, $password, $database); 
		if(!$conn) 
		{ 
			trigger_error('Error when connecting: '.mysqli_connect_error()); 
		} 

		$stmt = $conn->prepare('INSERT INTO `rpi_info`( `Name`, `IP`) VALUES (?, ?) ON DUPLICATE KEY UPDATE IP=?;');
		$stmt->bind_param("sss", $name, $ip, $ip);

		$name = $_REQUEST['name'];
		$ip = clientIP();

		$stmt->execute();

		echo 'writed succesfully!';

		$stmt->close();
		$conn->close();	
	}
	else{
		echo 'user not valid!';
	}
}
else{
	echo '<b>Error: </b>missing values!';
}
	
?>