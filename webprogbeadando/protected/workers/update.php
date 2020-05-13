<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'GET' && array_key_exists('id', $_GET) && !empty($_GET['id']))
	{	
		$query = "SELECT first_name, last_name, email, gender, nationality, company FROM workers WHERE id = :id";
		$params = [':id' => $_GET['id']];
		require_once DATABASE_CONTROLLER;
		$worker = getRecord($query,$params);
		if(!$worker) {
			echo "Nincs ilyen id-vel rendelkező munkás!";
		}
		else{
			$postData = [
			'first_name' => $worker['first_name'],
			'last_name' => $worker['last_name'],
			'email' => $worker['email'],
			'gender' => $worker['gender'],
			'nationality' => $worker['nationality'],
			'company' => $worker['company']
		];}
	}
	else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateWorker'])) {
		$postData = [
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
			'gender' => $_POST['gender'],
			'nationality' => $_POST['nationality'],
			'company' => $_POST['company'],
			'id' => $_GET['id']
		];
		if(empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['email']) || empty($postData['nationality']) || $postData['gender'] < 0 && $postData['gender'] > 2) {
			echo "Hiányzó adat(ok)!";
		} else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Hibás email formátum!";
		} else {
			$query = "UPDATE workers SET first_name=:first_name, last_name=:last_name, email=:email, gender=:gender, nationality=:nationality, company=:company WHERE id=:id";
			$params = [
				':first_name' => $postData['first_name'],
				':last_name' => $postData['last_name'],
				':email' => $postData['email'],
				':gender' => $postData['gender'],
				':nationality' => $postData['nationality'],
				':company' => $postData['company'],
				':id' => $postData['id']
			];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php?P=list_workers');
		}
	}
	?>

	<form method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="workerFirstName">First Name</label>
				<input type="text" class="form-control" id="workerFirstName" name="first_name" value="<?= isset($postData) ? $postData['first_name'] : '';?>">
			</div>
			<div class="form-group col-md-6">
				<label for="workerLastName">Last Name</label>
				<input type="text" class="form-control" id="workerLastName" name="last_name" value="<?= isset($postData) ? $postData['last_name'] : '';?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="workerEmail">Email</label>
				<input type="email" class="form-control" id="workerEmail" name="email" value="<?= isset($postData) ? $postData['email'] : '';?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="workerGender">Gender</label>
		    	<select class="form-control" id="workerGender" name="gender" >
		      		<option value="0" <?=$worker['gender'] == 0 ? 'selected' : '' ?> >Female</option>
		      		<option value="1" <?=$worker['gender'] == 1 ? 'selected' : '' ?> >Male</option>
		      		<option value="2" <?=$worker['gender'] == 2 ? 'selected' : '' ?> >Other</option>
		    	</select>
		  	</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="workerNationality">Nationality</label>
				<input type="text" class="form-control" id="workerNationality" name="nationality" value="<?= isset($postData) ? $postData['nationality'] : '';?>">
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="workerCompany">Company</label>
				<select class="form-control" id="workerCompany" name="company" >
		      		<option value="0" <?=$worker['company'] == 0 ? 'selected' : '' ?> >Penny</option>
		      		<option value="1" <?=$worker['company'] == 1 ? 'selected' : '' ?> >CBA</option>
		      		<option value="2" <?=$worker['company'] == 2 ? 'selected' : '' ?> >Bella</option>
		    	</select>
			</div>
		</div>

		<button type="submit" class="btn btn-primary" name="updateWorker">Update Worker</button>
	</form>
<?php endif; ?>