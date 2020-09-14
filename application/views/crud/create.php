<form action="<?php echo base_url('') ?>ADD" method="post">

	<div class="content-wrapper">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<div class="container">

									<?php echo $this->session->flashdata('item');?>


									<h2> Basic Information </h2>

									<div class="form-group">
										<label for="name">Name:</label>
										<input type="text" class="form-control" id="name" placeholder="Enter full name"
											   name="name">
										<label style="color: red"><?php echo form_error('name'); ?></label>
									</div>
									<div class="form-group">
										<label for="pwd">Description:</label>

										<textarea name="description" class="textarea" placeholder="Place some text here"
												  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>


										<label style="color: red"><?php echo form_error('description'); ?></label>
									</div>


									<div class="row">
										<div class="col-md-12">
											<div class="col-md-10"></div>
											<div class="col-md-2 align-right">
												<button type="submit" class="btn btn-block btn-primary btn-lg">Submt
												</button>
											</div>
										</div>
									</div>


								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
	</div>
</form>


<script>
	$(function () {
		// Summernote
		$('.textarea').summernote()
	})
</script>





