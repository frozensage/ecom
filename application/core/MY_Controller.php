<?php
class MY_Controller extends CI_Controller
{
	protected $data;

	function __construct()
	{
		parent::__construct();
		
		$this->data = array();
	
		$this->data['css'] = array
		(
			'css/jquery-ui.css',
			//'css/jquery.wysiwyg.css',
			//'css/facebox.css',
			//'css/visualize.css',
			'css/date_input.css',
		 	'css/style.css',
		);
		
		$this->data['js'] = array
		(
			'jquery/jquery-1.6.2.min.js',
			'jquery/jquery-ui-1.8.2.min.js',
			'jquery/jquery.ba-bbq.js',
			'jquery/jquery.tmpl.min.js',
		);
		
		
		$this->data['nav'] = array
		(
			"Product manager" => array(
				"List products" => "admin/product",
				"Organise products" => "admin/product/organise",
				"Add product" => "admin/product/add",
				"Add (gift) product" => "admin/product/add/associated",
			),
			"User manager" => array(
				"List users" => "admin/user",
				"Add user" => "admin/user/add" 
			),
			"Filters manager" => array(
				"Product category" => "admin/taxonomy/vocabulary/1",
				"Shop by person" => "admin/taxonomy/vocabulary/2",
				"Shop by occasion" => "admin/taxonomy/vocabulary/3",
				"Shop by price" => "admin/taxonomy/vocabulary/4"
			),
			"Misc manager" => array(
				"List offercodes" => "admin/offercode",
				"Add offercode" => "admin/offercode/add",
				"Manufacturers" => "admin/manufacturer",
				"Add manufacturer" => "admin/manufacturer/add"
			),
		);
		
		$this->data['heading'] = 'Admin';
		
		if(!$this->session->userdata('backend')) // kick back to log in
		{
			redirect('admin');
		}
	}	
	
	function load_template($view=NULL, $menu=true)
	{				
		$this->data['title'] = $view;
		$this->load->view('backend/header', $this->data);

		// load content
		if($view)
		{
			$this->load->view('backend/'.$view, $this->data);
		}
		
		$this->load->view('backend/footer');
	}
}