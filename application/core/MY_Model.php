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
	protected $rows;
	protected $offset;

	function __construct()
	{
		parent::__construct();
		
		$this->select = '*';
		$this->where = array();
		$this->like = array();
		$this->join = array();
		$this->order_by = array();
		$this->group_by = array();
		$this->rows = 10;
		$this->offset = 0;
	}

	function create($data)
	{	
		// add updated and created date to input data
		$data['updated'] = $data['created'] = date('Y-m-d H:i:s', time());
		
		// get existing columns from the set table
		$exist_columns = $this->db->list_fields($this->table);
		
		// filter out any columns that doesn't exist in the table from the input
		$data = array_intersect_key($data, array_flip($exist_columns));
	
		$this->db->set($data);
		
		$this->db->insert($this->table);
		
		return $this->db->insert_id();
	}

	function update($data)
	{	
		// add updated date to input data
		$data['updated'] = date('Y-m-d H:i:s', time());
		
		// get existing columns from the set table
		$exist_columns = $this->db->list_fields($this->table);
		
		// filter out any columns that doesn't exist in the table from the input
		$data = array_intersect_key($data, array_flip($exist_columns));		
		
		return $this->db->update($this->table ,$data, $this->where);
	}	
	
	function delete()
	{
		$this->db->delete($this->table, $this->where);
	}
	
	function get()
	{	
		$this->db->select($this->select);
		$this->db->where($this->where);
		//$this->db->like($like);
		
		// join
		if(isset($this->join) and count($this->join)>0)
		{
			foreach($this->join as $table=>$where)
			{
				// ie: $this->db->join('comments', 'comments.id = blogs.id');
				$this->db->join($table, $where); 
			}
		}
		
		// order by
		if(isset($this->order_by) and count($this->order_by)>0)
		{			
			foreach($this->order_by as $field => $direction)
			{
				$this->db->order_by($field, $direction);
			}
		}
		
		// group by
		if(isset($this->group_by) and count($this->group_by)>0)
		{
			$this->db->group_by($this->group_by);		
		}
		
		return $this->db->get($this->table, $this->rows, $this->offset);
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
	
	function set_rows($rows)
	{
		$this->rows = $rows;
	}
	
	function set_offset($offset)
	{
		$this->offset = $offset;
	}
}