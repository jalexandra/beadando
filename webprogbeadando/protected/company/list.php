<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
<?php
	$query = "SELECT id, name, phone, email FROM company ORDER BY name ASC";
	require_once DATABASE_CONTROLLER;
	$workers = getList($query);
?>
	
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Phone</th>
					<th scope="col">Email</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($workers as $w) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><?=$w['name'] ?></td>
						<td><?=$w['phone'] ?></td>
						<td><?=$w['email'] ?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>