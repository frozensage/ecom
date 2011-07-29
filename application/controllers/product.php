<?php

class product extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->data['js'][] 	= 'jquery/jquery.filestyle.mini.js';
		$this->data['js'][] 	= 'jquery/jquery.select_skin.js';
		$this->data['js'][] 	= 'jquery/fancybox/jquery.fancybox-1.3.4.pack.js';
		$this->data['js'][] 	= 'jquery/fancybox/jquery.easing-1.3.pack.js';
		$this->data['js'][] 	= 'ajaxupload.js';

		$this->data['css'][] 	= 'js/jquery/fancybox/jquery.fancybox-1.3.4.css';

		$this->_taxonomy_terms();
		$this->_suppliers();
		$this->_locations();
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
		
		$this->data['heading'] 	= 'Create product';
		
		$this->load_template('product/form');
	}
	
	function edit($id=null,$type='standalone')
	{
		
	}
	
	function save()
	{
		if($this->input->post('submit'))
		{
			$options = $this->input->post('options');
			$delivery_schedules = $this->input->post('delivery_schedules');
					
			foreach($options as $index=>$option)
			{
				if($option['option'] or $option['price'])
				{
					$this->form_validation->set_rules("options[$index][option]",'Option','required');
					$this->form_validation->set_rules("options[$index][price]",'Price','required|numeric');
				}
			}
			
			if($this->form_validation->run()) // save
			{
				redirect('product');
			}
			else
			{
				$this->data['type']			= $this->input->post('product[type]');
				$this->data['has_error']	= true;
			}
			
			$this->load_template('product/form');	
		}
	}
	
	function _taxonomy_terms()
	{
		$this->load->model('term_model','term');
		$this->term->set_select('vocabulary, term, tbl_terms.id AS id');
		$this->term->set_join(
			array('tbl_vocabularies'=>'tbl_vocabularies.id=tbl_terms.vocabulary_id'));
		$this->term->set_order_by(array('order'=>'asc'));
		
		$vocabularies = array(1,2,3,4,5,6);
							
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
		$this->load->model('location_model','location');

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