<?php
	
	define('DATABASE', 'super_images_turbo_3000');
	define('USER', 'root');
	define('PASSWD', 'root');
	
	$dpo = new PDO('mysql:host=localhost;dbname=' . DATABASE, USER, PASSWD);
	
	$id = $_GET['id'];
	
	if(!empty($_POST)){
		
		$statement = $dpo->prepare("
			
			UPDATE `keywords` 
			SET `category` = :category, `name` = :name 
			WHERE `keywords`.`id` = :id;
			
		");
			
		$statement->execute([
			'id' => $_POST['id'],
			'category' => $_POST['category'],
			'name' => $_POST['name'],
		]);
		
	}
	
	$statement = $dpo->prepare("SELECT id, name, category FROM keywords WHERE id = :id");
	$statement->execute(['id' => $id]);
	
	$keyword = $statement->fetch();
		
?>
<!DOCTYPE>
<html>
	<head>
		<title>Edit</title>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<h1>Edit</h1>
		<a class="back" href="/admin">Retour</a>
		
		<form class="edit" action="" method="post" >
			
			<input type="hidden" name="id" value="<?php echo $keyword['id'] ?>" />
			<input name="name" placeholder="name" type="text" value="<?php echo $keyword['name'] ?>" />
			<input name="category" placeholder="category" type="text" value="<?php echo $keyword['category'] ?>" />
			
			<button>Save</button>
			
		</form>
		
	</body>
</html>