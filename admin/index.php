<?php
	
	define('DATABASE', 'super_images_turbo_3000');
	define('USER', 'root');
	define('PASSWD', 'root');
	
	$dpo = new PDO('mysql:host=localhost;dbname=' . DATABASE, USER, PASSWD);
	
	if(!empty($_POST)){
		var_dump($_POST);
		exit();
	}
	
	$statement = $dpo->query("SELECT id, name, category FROM keywords");
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
					<td><a href="/admin/edit.php?id=<?= $keyword['id'] ?>" >Edit</a></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</form>
	</body>
</html>