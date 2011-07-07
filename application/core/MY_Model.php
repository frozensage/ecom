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
	
	function get($select='*', $where=array())
	{
		$this->db->select($select);
		$this->db->set($where);
		
		return $this->db->get($this->table);
	}
	
	function set_table($table)
	{
		$this->table = $table;
	}
	
}