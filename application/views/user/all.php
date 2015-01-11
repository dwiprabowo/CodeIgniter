<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<table class="table table-hover">
			<tr>
				<th>Name</th>
				<th>Username</th>
				<th>Password</th>
				<th>Access</th>
				<th>Active</th>
			</tr>
			<?php foreach($users as $k => $v): ?>
				<tr>
					<td><?=$v->name?></td>
					<td><?=$v->username?></td>
					<td>******</td>
					<td><?=$v->administration->data?></td>
					<td><?=bool_icon($v->administration->is_active)?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>