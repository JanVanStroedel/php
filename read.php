<?php

require 'Mustache/Autoloader.php';
Mustache_Autoloader::register();

$template = '<div class = "card"><div class = "content break"><p class = "title">{{title}}</p><p class = "text">{{text}}</p>{{#button1}}<div class = "button click-me-button ripple-effect {{btn1Class}}" {{btn1Attr}}> <p class = "button-text unselectable">{{btn1Text}}</p></div>{{/button1}}{{#button2}}<div class = "button click-me-button ripple-effect {{btn2Class}}" {{btn2Attr}}> <p class = "button-text unselectable">{{btn2Text}}</p></div>{{/button2}}</div></div>';

$host = 'localhost';
$user = 'root';
$password = '1234';
$database = 'rpi';

$conn = mysqli_connect($host, $user, $password, $database); 
if(!$conn) 
{ 
    trigger_error('Error when connecting: '.mysqli_connect_error()); 
} 

$data = array();

$query = "SELECT * FROM `rpi_info`"; 

if(!$result = mysqli_query($conn, $query)) 
{ 
    trigger_error('Error in query: '.mysqli_error()); 
} 
else 
{ 
	$i = 0;
	while ($property = mysqli_fetch_field($result)) {
		$data[0][$i] = $property->name;
		$i++;
	}
	
	$i = 1;
    while($row = mysqli_fetch_assoc($result)) 
    { 
		$j = 0;
		foreach($row as $value){
			$data[$i][$j] = $value;
			$j++;
		}
		$i++;
    }
}
	
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>SiteTitle</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="index-max.css">
		<script src = "https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>
		<script src = "Mustache.js"></script>
    </head>

    <body>
		<div class = "overlay"></div>
		<div class = "left-menu">
			<div class = "menu-head">
				<p>Left menu</p>
			</div>
			<div class = "menu-body">
				<div class = "button menu-button">
					<p class = "button-text unselectable">Click me!</p>
				</div>
				<div class = "button menu-button">
					<p class = "button-text unselectable">Click me!</p>
				</div>
				<div class = "button menu-button">
					<p class = "button-text unselectable">Click me!</p>
				</div>
			</div>
		</div>
		
		<div class = "hamburger">
				<div class = "hamburger-bg"></div>
				<div class = "hamburger1" ></div>
				<div class = "hamburger2" ></div>
				<div class = "hamburger3" ></div>
			</div>
		
		<div class = "head">			
			<div class = "head-main">
				<p class = "headtext">Hello!</p>
			</div>
			
		</div>
		
		<div class = "block-content">
			<p class="title">Title!</p>
			<div id = "connectedRPIS" class = "cardlist">
				<?php 
					$cardN = 0;
					$m = new Mustache_Engine;
					//for each item a new card
					for($i = 1; $i < count($data); $i++){
						$values = array(
							"title" => $data[$i][1],
							"text" => 'IP address: '.$data[$i][2],
							"button1" => true,
							"btn1Class" => 'listen-ip listen-'.$cardN,
							"btn1Attr" => 'data-ip='.$data[$i][2],
							"btn1Text" => 'Visit!',
							"button2" => false
						);
						
						echo $m->render($template, $values);
						$cardN +=2;
					}
					
					
				?>
				
			</div>
		</div>	
		
		<script src="gmd.js"></script>
		<script src="index.js"></script>
    </body>
</html>
