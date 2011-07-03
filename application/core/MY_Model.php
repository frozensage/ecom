<?php
class MY_Model extends CI_Model
{
	private $table;

	function __construct()
	{
		parent::__construct();
		
		$data = array();
	}
	
	function create($data)
	{
		$this->db->set('updated', date('Y-m-d H:i:s', time()));
		$this->db->set('created', date('Y-m-d H:i:s', time()));
		$this->db->set($data);
		
		$this->db->insert($this->table);
		
		return $this->db->insert_id();
	}
	
	function set_table($table)
	{
		$this->table = $table;
	}
	
}