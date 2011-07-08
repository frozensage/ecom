<?php

class product extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
	}
	
	function manage()
	{
	}
	
	function create($type='standalone')
	{
		$this->data['action'] = site_url("admin/product/add/$type");
		$this->data['type'] = $type;
			
		// remove the last item in a list (ie: ...[0])
	/*	unset($_POST['options'][0]);
		unset($_POST['delivery_schedules'][0]);

		$f_val = $this->f_val;
		$rules = $this->_form_rules();
		$f_val->set_rules($rules);

		if ($f_val->run())
		{
			$this->product->save($_POST);
			redirect('admin/product#order_by=created&direction=desc');
		}
		
		// re populate with data submitted
		if($_POST) 
		{			
			$this->data['values'] = $_POST;
		
			if(!$this->input->post('term_id'))
				$this->data['values']['term_id'] = array();
				
			if(!$this->input->post('options'))
				$this->data['values']['options'] = array();	
				
			if(!$this->input->post('delivery_schedule'))
				$this->data['values']['delivery_schedules'] = array();	
		}
		
		$this->_taxonomy_terms();
		$this->_manufacturers();
		$this->_locations();
		*/
		$this->load_template('product/form');
	}
	
	function edit($id=null,$type='standalone')
	{
		
	}
}

// end product.php