<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">CRUD</h3>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="col-md-12">
									<br>
									<span id="success_message"></span>
									<span id="success_message_delete"></span>
									<span id="success_message_edit"></span>
									<br>

								</div>
							</div>
						</div>
						<!--	<div class="table-responsive">-->
						<table class="table table-bordered table-striped" id="mydata">
							<thead>
							<tr>
								<th>sl</th>
								<th>Name</th>
								<th>description</th>
								<th>Action</th>

							</tr>
							</thead>

						</table>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!--</div>-->
<!-- MODAL ADD -->
<form id="cform">
	<div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog"
		 aria-labelledby="exampleModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Personal Info </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Name</label>
						<div class="col-md-10">
							<input type="text" name="name" id="name" class="form-control"
								   placeholder="name">
							<span id="name_error" class="text-danger"></span>

						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Description</label>
						<div class="col-md-10">
							<input type="text" name="description" id="description"
								   class="form-control"
								   placeholder="description">
							<span id="description_error" class="text-danger"></span>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn_close" data-dismiss="modal">
						Close
					</button>
					<button type="button" id="btn_save" class="btn btn-primary btn_save">Save
					</button>

				</div>
			</div>
		</div>
	</div>
</form>

<!--END MODAL ADD-->
<!-- MODAL edit -->
<form id="eform">
	<div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog"
		 aria-labelledby="exampleModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Personal Info </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-10">
							<input type="hidden" name="id_edit" id="id_edit">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Name</label>
						<div class="col-md-10">
							<input type="text" name="name_edit" id="name_edit" class="form-control"
								   placeholder="name">
							<span id="name_error_edit" class="text-danger"></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Description</label>
						<div class="col-md-10">
							<input type="text" name="description_edit" id="description_edit"
								   class="form-control"
								   placeholder="description">
							<span id="description_error_edit" class="text-danger"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn_close" id="btn_close"
							data-dismiss="modal">
						Close
					</button>
					<button type="button" type="submit" id="btn_update" class="btn btn-info">Edit
					</button>
				</div>
			</div>
		</div>
	</div>
</form>


<?php $this->load->view('template/js_link_datatable'); ?>
<!--END MODAL edit-->

<script type="text/javascript">

	$(document).ready(function () {


		$('#mydata').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				url: "<?php echo base_url() . 'Crud_controller/personal_data'; ?>",
				type: "POST"
			},
			'order': [],
		});

		$('#mydata').DataTable().ajax.reload();

		// insert data start
		$(document).on('click', '.btn_save', function () {
			// $('#btn_save').on('click', function () {
			var name = $('#name').val();
			var description = $('#description').val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Crud_controller/save')?>",
				dataType: "JSON",
				data: {name: name, description: description},
				success: function (data) {
					if (data.error) {
						if (data.name_error != '') {
							$('#name_error').html(data.name_error);

						} else {
							$('#name_error').html('');
						}
						if (data.description_error != '') {
							$('#description_error').html(data.description_error);

						} else {
							$('#description_error').html('');
						}
					}
					if (data.success) {
						$('#name_error').html('');
						$('#description_error').html('');
						$('#success_message').html(data.success);
						var duration = 4000; // 4 seconds
						setTimeout(function () {
							$('#success_message').hide();
						}, duration);
						document.getElementById("cform").reset();
						$('#Modal_Add').modal('toggle');

					}
					// $('#mydata').DataTable().ajax.reload();
				}
			});
		});

		// insert end

		// delete start
		$(document).on('click', '.btn_delete', function () {
			var id = $(this).attr('id');
			if (confirm("Are you sure you want to delete this?")) {
				$.ajax({
					url: "<?php echo base_url(); ?>Crud_controller/delete",
					method: "POST",
					data: {id: id},
					success: function (data) {
						$('#success_message_delete').html('<div class="alert alert-danger">Data has been delete successfully</div>');

						var duration = 4000; // 4 seconds
						setTimeout(function () {
							$('#success_message_delete').hide();
						}, duration);

						$('#mydata').DataTable().ajax.reload();
					}
				})
			}
		});

		// delete end

		// Edit start

		// information view start
		$(document).on('click', '.btn-edit', function () {
			var id = $(this).attr('id');
			$.ajax({
				url: "<?php echo base_url(); ?>Crud_controller/edit",
				method: "POST",
				data: {id: id},
				success: function (data) {
					var res = jQuery.parseJSON(data);
					var id = res.id;
					var name = res.name;
					var description = res.description;
					// console.log(res);
					$('[name="id_edit"]').val(id);
					$('[name="name_edit"]').val(name);
					$('[name="description_edit"]').val(description);
					$('#Modal_edit').modal('show');
				}
			})
		});
		// information view end

		//update record to database
		$('#btn_update').on('click', function () {
			var name_edit = $('#name_edit').val();
			var description_edit = $('#description_edit').val();
			var id_edit = $('#id_edit').val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Crud_controller/update')?>",
				dataType: "JSON",
				data: {id: id_edit, name: name_edit, description: description_edit},
				success: function (data) {
					// console.log(data.success);
					if (data.error) {
						if (data.name_error != '') {
							$('#name_error_edit').html(data.name_error);

						} else {
							$('#name_error_edit').html('');
						}
						if (data.description_error != '') {
							$('#description_error_edit').html(data.description_error);
						} else {
							$('#description_error_edit').html('');
						}
					}
					if (data.success) {
						// alert('ok');
						$('#name_error_edit').html('');
						$('#description_error_edit').html('');
						$('#success_message_edit').html(data.success);
						var duration = 4000; // 4 seconds
						setTimeout(function () {
							$('#success_message_edit').hide();
						}, duration);
						document.getElementById("eform").reset();
						$('#Modal_edit').modal('toggle');

					}
					$('#mydata').DataTable().ajax.reload();
				}
			});
			return false;
		});
		// update end
		// Edit end

	});


	// btn_close button start
	$('.btn_close').on('click', function () {
		$('#name_error').html('');
		$('#description_error').html('');
		$('#name_error_edit').html('');
		$('#description_error_edit').html('');
	});
	// close button end
</script>
</body>
</html>
