<?php
	
	include('database.php');
	
	if( !empty($_POST) ) {
				
		move_uploaded_file($_FILES["name"]["tmp_name"], 'images/' . $_FILES["name"]["name"] );
		
		$statement = $dpo->prepare("
			INSERT INTO `images` 
				(`id`, `name`, `orientation`, `style`, `ppl_nb`, `situation`, `date`, `created_at`) 
			VALUES (NULL, :name, :orientation, :style, :ppl_nb, :situation, NOW(), NOW());
		");
		
		$statement->execute([
			'name' => basename($_FILES["name"]["name"], '.jpg'),
			'orientation' => $_POST['orientation'],
			'style' => $_POST['style'],
			'ppl_nb' => $_POST['ppl_nb'],
			'situation' => $_POST['situation']
		]);
		
		
	}

?>
<!DOCTYPE>
<html>
	<head>
		<title>Insert</title>
		<link rel="stylesheet" href="css/main.css?cache=2" />
	</head>
	<body>
		<h1>Insert</h1>
		<a class="back" href="/admin">Retour</a>
		
		<form class="edit" action="" method="post" enctype="multipart/form-data" >
			
			<input name="name" type="file" />
			<input name="orientation" placeholder="orientation" type="text" value="" />
			<input name="style" placeholder="style" type="text" value="" />
			<input name="ppl_nb" placeholder="ppl_nb" type="text" value="" />
			<input name="situation" placeholder="situation" type="text" value="" />
			
			<button>Save</button>
			
		</form>
		
	</body>
</html>