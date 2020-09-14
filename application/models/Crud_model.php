<?php


class Crud_model extends CI_Model
{
	public function index()
	{
		$this->db->select('id,name,description');
		$query = $this->db->get_where('crud', ['state' => '0']);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array('error');
		}
	}

	public function insert($data_insert)
	{
		$insert = $this->db->insert('crud', $data_insert);
		return $insert;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete_data = $this->db->delete('crud');
		return $delete_data;
	}

	public function edit($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('crud');
		return $data->row();
	}

	public function update($data_update, $id)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('crud', $data_update);
		return $update;
	}
}
