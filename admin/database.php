<?php
	
	define('DATABASE', 'super_images_turbo_3000');
	define('USER', 'root');
	define('PASSWD', 'root');
	
	
	$dpo = new PDO('mysql:host=localhost;dbname=' . DATABASE, USER, PASSWD);
	
		