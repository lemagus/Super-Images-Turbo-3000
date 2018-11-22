<?php
	
	include('database.php');
	
	$statement = $dpo->query("
		SELECT images.*, GROUP_CONCAT( keywords.name SEPARATOR ', ' ) AS keywords
		FROM images
		JOIN images2keywords ON images2keywords.image_id = images.id
		JOIN keywords ON images2keywords.keyword_id = keywords.id
		GROUP BY images.id
	");
	
	$images = $statement->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE>
<html>
	<head>
		<title>Images</title>
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>
		<h1>Images</h1>
		
		
		<form class="listing" method="post" action="" >			
			<table>
				<tr>
					<th>Image</th>
					<th>Verso</th>
					<th>Name</th>
					<th>Keywords</th>
					<th>Actions</th>
				</tr>
			<?php foreach($images as $image): ?>
				<tr>
					<td> <img src="images/<?php echo $image['name'] ?>.jpg" width="80" /> </td>
					<td>
						<?php if( file_exists('images/' . $image['name'] . '_verso.jpg' )): ?>
						<img src="images/<?php print $image['name'] ?>_verso.jpg" width="80" />
						<?php endif; ?>
						</td>
					<td><?php print $image['name'] ?></td>
					<td><?php print $image['keywords'] ?></td>
					<td><a href="/admin/edit_image.php?id=<?= $image['id'] ?>" >Edit</a></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</form>
	</body>
</html>