<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
	<?php else : ?>
		<?php 
			if(array_key_exists('id', $_GET) && !empty($_GET['id'])) {
				$query = "SELECT first_name, last_name, email, gender, nationality FROM workers WHERE id = :id";
				$params = [':id' => $_GET['id']];
			require_once DATABASE_CONTROLLER;
			$worker = getRecord($query,$params);
			if(!$worker) {
			echo "Nincs ilyen id-vel rendelkező munkás!";
			}
			else{
				echo "<h2>". $worker['first_name']." ".$worker['last_name']. "</h2>";
				echo "<h3>". $worker['email'] ."</h3>";
				echo "<p>".$worker['gender'] == 0 ? 'Female' : ($worker['gender'] == 1 ? 'Male' : 'Other')."</p>";
				echo "<p>".$worker['nationality']."</p>";
			}
			}
		?>
		

	<?php endif; ?>
	