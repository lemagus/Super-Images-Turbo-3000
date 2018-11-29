<?php
	
	include('admin/database.php');
	
	if( !empty($_POST) ) {
		
		$filters = [];
		foreach($_POST['filters'] as $filter){
			if(!empty(trim($filter[0]))){
				$filters[] = $filter[0];
			}
		}
		
		$where = '';
		foreach($filters as $k => $value) {
			$where .= "images2keywords.keyword_id = " . $value . " OR ";
		}
		
		$where = trim(substr($where, 0, -3));
		$counter = $k+1;
				
		$sql = "
			SELECT *
			FROM images
			JOIN images2keywords ON images2keywords.image_id = images.id
			WHERE ( " . $where . ") 
			GROUP BY images.id
			HAVING COUNT(images.id) >= ". $counter .";
		";
		
		$statement = $dpo->query($sql);
		
	} else {
	
		$statement = $dpo->query("
			SELECT * FROM images
		");
	
	}
	
	$images = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$statement = $dpo->query("
		SELECT 
			*, GROUP_CONCAT( CONCAT(keywords.id,'*|*',keywords.name) SEPARATOR ';' ) AS keywords 
		FROM keywords GROUP BY category
	");
	
	$keywords = $statement->fetchAll(PDO::FETCH_ASSOC);
	
?><!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width" >
        
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet" />
        
    </head>
    <body>
	
		<h1> Super images turbo 3000  </h1>
		
		<form method="post" action="">
			<fieldset>
				<legend>Categories</legend>
				
				<?php foreach($keywords as $keyword): ?>
				<?php $list = explode(";", $keyword["keywords"]); ?>
				<label>
					<?php echo $keyword['category'] ?>
					<select name="filters[<?php echo $keyword['category'] ?>][]" >
						<option value=""> --- </option>
						<?php foreach($list as $option): ?>
						<?php list($value, $label) = explode('*|*', $option); ?>
						<option value="<?php echo $value ?>" ><?php echo $label ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<?php endforeach; ?>
				
			</fieldset>
			<button> Filter </button>
		</form>
		
		<div class="gavin">
						
			<?php foreach($images as $image): ?><img src="admin/images/<?php echo $image['name'] ?>.jpg" /><?php endforeach; ?>
			
		</div>
		    
    </body>
</html>