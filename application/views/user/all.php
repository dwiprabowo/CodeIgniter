<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<table class="table table-hover">
			<tr>
				<th>Name</th>
				<th>Username</th>
				<th>Password</th>
			</tr>
			<?php foreach($users as $k => $v): ?>
				<tr>
					<td><?=$v->name?></td>
					<td><?=$v->username?></td>
					<td>******</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>