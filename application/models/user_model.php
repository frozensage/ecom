<?php
class user_model extends MY_Model
{	
	function __construct()
	{
		parent::__construct();
		
		$this->set_table('tbl_users');
	}
/*	
	function get($select='*', $where=array())
	{
		$this->db->select($select);
		$this->db->set($where);
		
		return $this->db->get($this->table);
	}
*/
}