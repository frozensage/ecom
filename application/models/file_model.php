<?php
class file_model extends MY_Model
{	
	function __construct()
	{
		parent::__construct();
		
		$this->set_table('tbl_files');
	}
	/*
	function create($data)
	{
		$this->db->set('created', date('Y-m-d H:i:s', time()));
		
		$exist_columns = $this->db->list_fields($this->table);
		
		$data = array_intersect_key($data, array_flip($exist_columns));
		
		$this->db->set($data);
		
		$this->db->insert($this->table);
		
		return $this->db->insert_id();
	}*/
}

// end file_model