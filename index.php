<?php 
	
	
	define('DATABASE', 'super_images_turbo_3000');
	define('USER', 'root');
	define('PASSWD', 'root');
	
	$dpo = new PDO('mysql:host=localhost;dbname=' . DATABASE, USER, PASSWD);
		
	$rows = file('db.csv');
	
	foreach($rows as $row){
		
		$cols 		= explode(";", $row);
		$keywords 	= explode(",", $cols[1]); 
		
		$name		= trim($cols[0]);
		
		$stmt = $dpo->prepare("SELECT id FROM images WHERE name = :name");
		$stmt->execute(['name' => trim($name)]); 
		$id = $stmt->fetchColumn();
		
		if(!$id) {
				
			$dpo	->prepare("INSERT INTO images (name) VALUES (:name)")
					->execute(['name' => trim($name)]);
					
			$image_id = $dpo->lastInsertId();
		
		} else {
			$image_id = $id;
		}
		
		foreach($keywords as $keyword){
			
			if(empty(trim($keyword))) continue;
			
			$stmt = $dpo->prepare("SELECT id FROM keywords WHERE name = :name");
			$stmt->execute(['name' => trim($keyword)]); 
			$id = $stmt->fetchColumn();
			
			var_dump($id);
			
			if(!$id) {
			
				$dpo	->prepare("INSERT INTO keywords (name) VALUES (:name)")
						->execute(['name' => trim($keyword)]);
						
				$keyword_id = $dpo->lastInsertId();
			
			} else {
				$keyword_id = $id;
			}
			
			
			$stmt = $dpo->prepare("SELECT id FROM images2keywords 
									WHERE image_id = :image_id
										AND keyword_id = :keyword_id ");
										
			$stmt->execute(['image_id' => $image_id, 'keyword_id' => $keyword_id]); 
			$id = $stmt->fetchColumn();
			
			if(!$id) {
			
				$dpo	->prepare("INSERT INTO images2keywords (image_id, keyword_id) 
									VALUES (:image_id, :keyword_id)")
						->execute([
							'image_id' => $image_id, 
							'keyword_id' => $keyword_id]);
							
				echo "Insert keyword : " . $keyword . "\n<br>";	
			
			} else {
				
				$dpo->query("UPDATE images2keywords 
					SET total = total+1 WHERE id = " . $id );
					
				echo "Updated keyword " . $keyword . "\n<br>";
			}		
		}
		
		
		echo "Insert image : " . $name . "\n<br>";
		
	}
	
	
	
	
	
	
	
	
	
	
	
	