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
		$this->data['js'][] 	= 'jquery/jquery.filestyle.mini.js';
		$this->data['js'][] 	= 'jquery/jquery.select_skin.js';
		$this->data['js'][] 	= 'jquery/fancybox/jquery.fancybox-1.3.4.pack.js';
		$this->data['js'][] 	= 'jquery/fancybox/jquery.easing-1.3.pack.js';
		$this->data['js'][] 	= 'ajaxupload.js';

		$this->data['css'][] 	= 'js/jquery/fancybox/jquery.fancybox-1.3.4.css';
		
		$this->data['action'] = site_url("admin/product/add/$type");
		$this->data['type'] = $type;		
		
		$this->data['heading'] 	= 'Upload file(s)';

			
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
		$this->_locations();
		*/
		
		$this->_taxonomy_terms();
		//$this->_locations();
		$this->_suppliers();
		
		
		$this->load_template('product/form');
	}
	
	function edit($id=null,$type='standalone')
	{
		
	}
	
	function _taxonomy_terms()
	{
		$this->load->model('term_model','term');
		$this->term->set_select('vocabulary, term, tbl_terms.id AS id');
		$this->term->set_join(
			array('tbl_vocabularies'=>'tbl_vocabularies.id=tbl_terms.vocabulary_id'));
		$this->term->set_order_by(array('order'=>'asc'));
		
		$vocabularies = array(1,2,3,4,5);
							
		foreach($vocabularies as $id)
		{
			$this->term->set_where(array('vocabulary_id'=>$id));
			$terms = $this->term->get();

			foreach($terms->result() as $term)
			{
				$this->data['taxonomy'][$term->vocabulary][$term->id] = $term->term;
			}
		}
		
		return true;
	}
	
	function _suppliers()
	{	
		$this->load->model('supplier_model','supplier');
		
		$this->data['suppliers'][''] = '-- Please select --';
	
		$suppliers = $this->supplier->get();
		
		foreach($suppliers->result() as $supplier)
		{
			$this->data['suppliers'][$supplier->id] = $supplier->supplier;
		}
	}
	
	function _locations()
	{
		$this->data['locations'][''] = '-- Please Select --';
	
		$locations = $this->location->get();

		foreach($locations->result() as $location)
		{
			$this->data['locations'][$location->id] 
			= $location->location.' ('.$location->colour.') '.substr($location->info,0,10).(strlen($location->info)>10?'...':'');
		}
	}
}

// end product.php