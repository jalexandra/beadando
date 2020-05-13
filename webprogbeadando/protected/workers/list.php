<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
	<?php
		if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
			$query = "DELETE FROM workers WHERE id = :id";
			$params = [':id' => $_GET['d']];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba törlés közben!";
			}
		}
		else if(array_key_exists('a', $_GET)) {
			$query = "DELETE FROM workers";
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query)) {
				echo "Hiba törlés közben!";
			}
		}
	?>
<?php
	$query = "SELECT id, first_name, last_name, email, gender, nationality, company FROM workers ORDER BY first_name ASC";
	require_once DATABASE_CONTROLLER;
	$workers = getList($query);
?>
	
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Gender</th>
					<th scope="col">Nationality</th>
					<th scope="col">Company</th>
					<th scope="col">Szerkesztés</th>
					<th scope="col">Törlés</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($workers as $w) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><a class="btn btn-light" href="?P=profile&id=<?=$w['id']?>"><?=$w['first_name']." ".$w['last_name'] ?></a></td>
						<td><?=$w['email'] ?></td>
						<td><?=$w['gender'] == 0 ? 'Female' : ($w['gender'] == 1 ? 'Male' : 'Other') ?></td>
						<td><?=$w['nationality'] ?></td>
						<td><?=$w['company'] == 0 ? 'Penny' : ($w['company'] == 1 ? 'CBA' : 'Bella')?></td>
						<td><a href="?P=update&id=<?=$w['id']?>" class="btn btn-primary">Edit</a></td>
						<td><a href="?P=list_workers&d=<?=$w['id']?>" class="btn btn-danger">Delete</a></td>
					</tr>
				<?php endforeach;?>
					<tr>
						<th scope="col">#</th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"><a href="?P=add_worker" class="btn btn-success">+</a></th>
						<th scope="col"><a href="?P=list_workers&a" class="btn btn-danger">Delete All</a></th>
					</tr>
			</tbody>
		</table>
	<?php endif; ?>
