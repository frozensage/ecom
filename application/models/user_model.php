<?php
class user_model extends MY_Model
{
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'tbl_users';
	}
	
	function get($select='*', $where=array())
	{
		$this->db->select($select);
		$this->db->set($where);
		
		return $this->db->get($this->table);
	}
}