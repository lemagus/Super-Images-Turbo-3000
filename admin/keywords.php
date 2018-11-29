<?php
	
	include('database.php');
	
	if(!empty($_GET['del'])) {
		$dpo->query("DELETE FROM images2keywords WHERE keyword_id = " . $_GET['del']);
		$dpo->query("DELETE FROM keywords WHERE id = " . $_GET['del']);
	}
	
	if(!empty($_POST)){
		
		foreach($_POST['id'] as $key => $id){
			$category = $_POST['category'][$key];
			if(!empty($category)) {
				
				$statement = $dpo->prepare("UPDATE `keywords` SET `category` = :category WHERE `keywords`.`id` = :id");
				$statement = $statement->execute(
					array(	'category' 	=> $category, 
							'id' 		=> $id));
				
				
			}
		}
		
	}
	
	$statement = $dpo->query("SELECT id, name, category FROM keywords ORDER BY name");
	$keywords = $statement->fetchAll();
	
	$statement = $dpo->query("
		SELECT DISTINCT category 
		FROM keywords 
		WHERE category IS NOT NULL
		ORDER BY category
	");
		
	$category = $statement->fetchAll(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE>
<html>
	<head>
		<title>Keywords</title>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<h1>Keywords</h1>
		
		
		<form class="listing" method="post" action="" >
			<button class="fixed" >SAVE</button>
			
			<table>
			<?php foreach($keywords as $keyword): ?>
				<tr>
					<td><?php echo $keyword['name'] ?></td>
					<td>
						<input type="hidden" name="id[]" value="<?php print $keyword['id'] ?>" />
						<select name="category[]" >
						<option value="" >...</option>
						<?php foreach($category as $item): ?>
						<?php 
							
							$selected = false;
							if( $item['category'] == $keyword['category'] ) {
								$selected = true;
							}
						?>	
						<option value="<?php echo $item['category'] ?>" <?php if($selected) print 'selected="selected"' ?> ><?php echo $item['category'] ?></option>
						<?php endforeach; ?>
						</select>
					</td>
					<td>
						<a href="/admin/edit_keyword.php?id=<?= $keyword['id'] ?>" >Edit</a>
						-
						<a class="removeme" href="keywords.php?id=<?= $keyword['id'] ?>&del=<?= $keyword['id'] ?>" >Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		</form>
		
		<script type="text/javascript">
			var deletes = document.querySelectorAll("a.removeme");
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