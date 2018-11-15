<?php
	
	include('database.php');
	
	$id = $_GET['id'];
	
	$statement = $dpo->prepare("
		SELECT *, 
		GROUP_CONCAT(
			CONCAT( keywords.id, ':', keywords.name )
		SEPARATOR ',' ) AS keywords
		FROM images
		JOIN images2keywords ON images2keywords.image_id = images.id
		JOIN keywords ON images2keywords.keyword_id = keywords.id
		WHERE images.id = :id
		GROUP BY images.name
	");
	$statement->execute(['id' => $id]);
	
	$image = $statement->fetch();
	
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
			
			<input type="hidden" name="id" value="<?php echo $image['id'] ?>" />
			
			<input name="name" placeholder="name" type="text" value="<?php echo $image['name'] ?>" />
			<input name="orientation" placeholder="orientation" type="text" value="<?php echo $image['orientation'] ?>" />
			<input name="style" placeholder="style" type="text" value="<?php echo $image['style'] ?>" />
			<input name="ppl_nb" placeholder="ppl_nb" type="text" value="<?php echo $image['ppl_nb'] ?>" />
			<input name="situation" placeholder="situation" type="text" value="<?php echo $image['situation'] ?>" />
			
			<fieldset>
				<legend>Keywords</legend>
				<?php 
					$keywords = explode(",", $image['keywords']);
				?>
				<?php foreach($keywords as $keyword): ?>
				<?php list($id, $value) = explode(':', $keyword); ?>
				<input type="text" name="keyword[]" value="<?php print $value ?>" />
				<input type="hidden" name="keyword_id[]" value="<?php print $id ?>" />
				<?php endforeach;?>
			</fieldset>
			
			<button>Save</button>
			
		</form>
		
	</body>
</html>