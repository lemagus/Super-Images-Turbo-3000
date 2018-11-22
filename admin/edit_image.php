<?php
	
	include('database.php');
	
	$id = $_GET['id'];
	
	if(!empty($_GET['del'])) {
		$dpo->query("DELETE FROM images2keywords WHERE keyword_id = " . $_GET['del'] . " AND image_id = " . $id);
	}
	
	if(!empty($_POST['existing_keyword'])) {
		$statement = $dpo->prepare("
			INSERT INTO `images2keywords` (`id`, `image_id`, `keyword_id`, `total`) VALUES (NULL, :image_id, :keyword_id, '1');
		");
		
		$statement->execute([
			'image_id' => $id,
			'keyword_id' => $_POST['existing_keyword']
		]);
	}
	
	if(!empty($_POST['new_keyword'])) {
		$statement = $dpo->prepare("
			INSERT INTO `keywords` (`id`, `name`, `category`, `created_at`) VALUES (NULL, :name, '',  NOW());
		");
		
		$statement->execute([
			'name' => $_POST['new_keyword']
		]);
		
		$kid = $dpo->lastInsertId();
		
		$statement = $dpo->prepare("
			INSERT INTO `images2keywords` (`id`, `image_id`, `keyword_id`, `total`) VALUES (NULL, :image_id, :keyword_id, '1');
		");
		
		$statement->execute([
			'image_id' => $id,
			'keyword_id' => $kid
		]);
	}
	
	if(!empty($_POST)){
		
		// Mise à jour de l'image
		
		$statement = $dpo->prepare("
			
			UPDATE `images` 
			SET 
				`name` = :name, 
				`orientation` = :orientation, 
				`style` = :style,
				`ppl_nb` = :pplnb,
				`situation` = :situation
				 
			WHERE `images`.`id` = :id;
			
		");
		
		$statement->execute([
			'name' => $_POST['name'],
			'orientation' => $_POST['orientation'],
			'style' => $_POST['style'],
			'pplnb' => intval( $_POST['ppl_nb'] ),
			'situation' => $_POST['situation'],
			'id' => $_POST['id']
		]);
		
		
		//-->
		
		// Mise à jour des mots clés
		
		$keywords = [];
		foreach($_POST['keyword'] as $k => $v){
			$keywords[$_POST['keyword_id'][$k]] = $v;
		}
		
	}
	
	$statement = $dpo->prepare("
		SELECT images.*, 
		GROUP_CONCAT(
			CONCAT( keywords.id, ':', keywords.name )
		SEPARATOR ',' ) AS keywords
		FROM images
		JOIN images2keywords ON images2keywords.image_id = images.id
		JOIN keywords ON images2keywords.keyword_id = keywords.id
		WHERE images.id = :id
		GROUP BY images.id
	");
	$statement->execute(['id' => $id]);
	
	$image = $statement->fetch(PDO::FETCH_ASSOC);
	
	$statement = $dpo->query("SELECT id, name, category FROM keywords ORDER BY name");
	$keywordCat = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE>
<html>
	<head>
		<title>Edit</title>
		<link rel="stylesheet" href="css/main.css?cache=2" />
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
				<div class="keyword" >
				<?php list($id, $value) = explode(':', $keyword); ?>
					<input type="text" name="keyword[]" readonly="readonly" value="<?php print $value ?>" />
					<input type="hidden" name="keyword_id[]" value="<?php print $id ?>" />
					<a class="delete" href="?id=<?=$_GET['id']?>&del=<?= $id ?>" >&times;</a>
				</div>
				<?php endforeach;?>
				
				<div class="new">
					
					<select name="existing_keyword">
						<option value="" >Nouveau mot clé</option>
						<?php foreach($keywordCat as $keyword): ?>
						<option value="<?php print $keyword['id'] ?>" ><?php print $keyword['name'] ?></option>
						<?php endforeach ?>
					</select>
		
					<input type="text" name="new_keyword">		
				</div>
				
			</fieldset>
			
			<button>Save</button>
			
		</form>
		
		<script type="text/javascript">
			var deletes = document.querySelectorAll("a.delete");
			deletes.forEach(function(btn){
				btn.addEventListener('click', function(evt){
					if(!confirm("Es-tu certain.e ?")){
						evt.preventDefault();
					}
				});
			});
		</script>
		
	</body>
</html>