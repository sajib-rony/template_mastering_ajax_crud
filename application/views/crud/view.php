

<div class="container">
	<center><h2>Basic Information </h2></center>
	<a href="<?php echo base_url('') ?>Crud_controller/create">
		<button type="button" class="btn btn-danger">Create</button>
	</a><br><br><br>
	<table id="" class="table table-bordered table-striped table-hover">
		<thead>
		<tr>
			<th>SL</th>
			<th>Name</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		//		$crud_info = '';
		if ($results != '') {
			$count = 1;
			foreach ($results as $value) {
				?>
				<tr>
					<td><?php echo $count++ ?></td>
					<td><?php echo $value->name ?></td>
					<td><?php echo $value->description ?></td>
					<td><a href="<?php echo base_url('Crud_controller/delete?id=' . $value->id) ?>">Delete</a> || <a
							href="<?php echo base_url('Crud_controller/edit?id=' . $value->id) ?>">Edit</a></td>

				</tr>

				<?php

			}
		} else {

		}

		?>


		</tbody>
	</table>


	<?php if (isset($links)) { ?>
		<?php echo $links ?>
	<?php } ?>







</div>

</body>

<script type="text/javascript">
	$(document).ready(function () {
		$('#item-list').DataTable();
	});
</script>

</html>
<?php
