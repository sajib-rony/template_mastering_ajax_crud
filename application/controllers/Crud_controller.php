<?php


class Crud_controller extends CI_Controller
{
	public function index()
	{
		$data['abc'] = '';
		$data['content'] = $this->load->view('crud/index', $data, TRUE);
		$this->load->view('template/header', $data);
		$this->load->view('template/js_link_datatable');
	}

	public function view()
	{
		$data['abc'] = '';
		$data['content'] = $this->load->view('crud/index', $data, TRUE);
		$this->load->view('template/header', $data);
		$this->load->view('template/js_link_datatable');
	}

	public function insert()
	{
		$data['abc'] = '';
		$data['content'] = $this->load->view('crud/create', $data, TRUE);
		$this->load->view('template/header', $data);
		$this->load->view('template/template_js');
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'name', 'required|min_length[3]|max_length[12]');
		$this->form_validation->set_rules('description', 'description', 'required');
		if ($this->form_validation->run()) {
			$data_insert = [
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
			];
			$data_insert = $this->Crud_model->insert($data_insert);
			$value = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Success alert preview. This alert is dismissable.
                </div>';
			$this->session->set_flashdata('item', $value);

			redirect('Insert');
//			$this->insert();
		} else {
			$data = array(
				'error' => true,
				'name_error' => form_error('name'),
				'description_error' => form_error('description'),

			);
//			$this->load->view('crud / create');
			$this->insert();
//			redirect('Insert');
		}


	}


	public function personal_data()
	{
		$data = $this->Crud_model->index();
		if (is_array($data) || is_object($data)) {
			$count = 1;
			foreach ($data as $key => $value) {
				$result['data'][$key] = [
					$count++,
					$value['name'],
					$value['description'],

					'<button type="button" name="btn_edit" id="' . $value['id'] . '" class="btn btn-xs btn-danger btn-edit">Edit</button>
                    &nbsp; <button type="button" name="delete_btn" id="' . $value['id'] . '" class="btn btn-xs btn-danger btn_delete">
                     <span class="glyphicon glyphicon-remove"></span></button>',
				];
			}
		}
		echo json_encode($result);
	}

	public function save()
	{
		$this->form_validation->set_rules('name', 'name', 'required | min_length[3] | max_length[12]');
		$this->form_validation->set_rules('description', 'description', 'required');

		if ($this->form_validation->run()) {
			$data_insert = [
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
			];
			$this->Crud_model->insert($data_insert);
			$data = array(
				'success' => ' < div class="alert alert-success" > Data has been insert successfully </div > '
			);
		} else {
			$data = array(
				'error' => true,
				'name_error' => form_error('name'),
				'description_error' => form_error('description'),

			);
		}
		echo json_encode($data);
	}


	public function delete()
	{
		$this->Crud_model->delete($this->input->post('id'));
		$data = array(
			'success' => ' < div class="alert alert-success" > Data has been insert successfully </div > '
		);
		echo json_encode($data);

	}

	public function edit()
	{
		$data = $this->Crud_model->edit($this->input->post('id'));

		echo json_encode($data);

	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name', 'required | min_length[3] | max_length[12]');
		$this->form_validation->set_rules('description', 'description', 'required');

		if ($this->form_validation->run()) {

			$id = $this->input->post('id');
			$data_update = [
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
			];
			$this->Crud_model->update($data_update, $id);
			$data = array(
				'success' => ' < div class="alert alert-success" > Data has been update successfully </div > '
			);
		} else {
			$data = array(
				'error' => true,
				'name_error' => form_error('name'),
				'description_error' => form_error('description'),

			);
		}
		echo json_encode($data);
	}
}
