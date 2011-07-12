<?php
class MY_Model extends CI_Model
{
	protected $table;
	protected $select;
	protected $where;
	protected $like;
	protected $join;
	protected $order_by;
	protected $group_by;
	protected $direction;
	protected $rows;
	protected $offset;

	function __construct()
	{
		parent::__construct();
		
		$this->select = '*';
		$this->where = array();
		$this->like = array();
		$this->join = array();
		$this->order_by = NULL;
		$this->group_by = NULL;
		$this->direction = 'asc';
		$this->rows = 10;
		$this->offset = 0;
	}

	function create($data)
	{
		$this->db->set('updated', date('Y-m-d H:i:s', time()));
		$this->db->set('created', date('Y-m-d H:i:s', time()));
		$this->db->set($data);
		
		$this->db->insert($this->table);
		
		return $this->db->insert_id();
	}

	function update($data)
	{			
		$this->db->set('updated', date('Y-m-d H:i:s', time()));		
		
		return $this->db->update($this->table ,$data, $this->where);
	}	
	
	function delete()
	{
		$this->where = $where;
		$this->db->delete($this->table, $this->where);
	}
	
	function get()
	{	
		$this->db->select($this->select);
		$this->db->set($this->where);
				
		if(isset($this->order_by) and !empty($this->order_by))
		{	
			$this->db->order_by($this->order_by, $this->direction);
		}
		
		return $this->db->get($this->table);
	}
	
	function set_table($table)
	{
		$this->table = $table;
	}
	
	function set_select($select)
	{
		$this->select = $select;
	}
	
	function set_where($where)
	{
		$this->where = $where;
	}
	function set_like($like)
	{
		$this->like = $like;
	}
	function set_join($join)
	{
		$this->join = $join;
	}
	
	function set_order_by($order_by)
	{
		$this->order_by = $order_by;
	}
	
	function set_group_by($group_by)
	{
		$this->group_by = $group_by;
	}
	
	function set_direction($direction)
	{
		$this->direction = $direction;
	}
	
	function set_rows($rows)
	{
		$this->rows = $rows;
	}
	
	function set_offset($offset)
	{
		$this->offset = $offset;
	}
}