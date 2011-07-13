<?php
class supplier extends MY_Controller
{
	private $rules;
	
	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('backend')) // kick back to log in
		{
			redirect('admin');
		}
		
		$this->rules = array
		(
			array(
				'field'	=>	'supplier[supplier]',
				'label'	=>	'Supplier',
				'rules'	=>	'trim|required'
			),
			array(
				'field'	=>	'supplier[email]',
				'label'	=>	'Email',
				'rules'	=>	'trim|valid_email|required'
			),
		);
	}
	
	function index()
	{
		$this->manage();
	}
	
	function manage()
	{
		$this->load->model('supplier_model','supplier');
		
		$this->data['heading'] = 'Manage Suppliers';
		$this->data['query'] = $this->supplier->get();
		
		$this->load_template('supplier/manage');
	}
	
	function results()
	{
		$this->load->model('supplier_model','supplier');
		
		$order_by = $this->input->post('order_by')?$this->input->post('order_by'):'supplier';
		$direction = $this->input->post('direction')?$this->input->post('direction'):'asc';
		$per_page = $this->input->post('per_page')?$this->input->post('per_page'):10;
		$current_page = $this->input->post('current_page')?$this->input->post('current_page'):1;
				
		$total_rows = $this->supplier->get()->num_rows();
		$total_pages = ceil($total_rows/$per_page);
	
		$has_next = true;
		if($current_page === $total_pages)
			$has_next = false;
	
		$has_prev = true;
		if($current_page <= 1)
			$has_prev = false;
	
		$pagination['per_page']		= $per_page;
		$pagination['current_page']	= $current_page;
		$pagination['total_rows'] 	= $total_rows;
		$pagination['total_pages'] 	= $total_pages;
		$pagination['has_prev'] 	= $has_prev;
		$pagination['has_next'] 	= $has_next;
		$pagination['prev_page'] 	= $current_page-1;
		$pagination['next_page'] 	= $current_page+1;
		$pagination['start_row'] 	= $start_row = ($current_page - 1)*$per_page + 1;
		$pagination['end_row'] 		= min(($current_page - 1)*$per_page+$per_page, $total_rows);
	
		$data['pagination'] = $pagination;
		
		$this->supplier->set_order_by(array($order_by=>$direction));
		$this->supplier->set_rows($per_page);
		$this->supplier->set_offset($current_page-1);
		
		$data['result'] = $this->supplier->get()->result();
				
		echo json_encode($data);
	}
	
	function create()
	{
		$this->data['heading'] = 'Create Supplier';
		$this->data['saved'] = NULL;
		$this->load_template('supplier/form');
	}
	
	function edit($id=NULL)
	{
		if(empty($id))
		{
			redirect('supplier/manage');
		}
		
		$this->load->model('supplier_model','supplier');
		
		$this->supplier->set_where(array('id'=>$id));
		$query = $this->supplier->get();

		if($query->num_rows() < 1)
		{
			redirect(site_url('supplier/manage'));
		}

		$this->data['heading'] = 'Edit Supplier';
		$this->data['saved'] = $query->row();

		$this->load_template('supplier/form');		
	}
	
	function save()
	{
		if($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules($this->rules);
			$this->form_validation->set_error_delimiters('<span class="error note">','</span>');
						
			if($this->form_validation->run()) // save
			{
				$this->load->model('supplier_model', 'supplier');
				
				if($this->input->post('id')) // edit
				{
					$this->supplier->set_where(array('id'=>$this->input->post('id')));
					$this->supplier->update($this->input->post('supplier'));			
					$this->session->set_flashdata('success', 'Supplier "'.set_value('supplier[supplier]').'" has been updated');	
				}
				else // create
				{
					$this->supplier->create($this->input->post('supplier'));			
					$this->session->set_flashdata('success', 'Supplier "'.set_value('supplier[supplier]').'" has been created');
				}
								
				redirect(site_url('supplier'));
			} // end validation
			
			$this->data['has_error'] = true;
		} // end submit

		$this->load_template('supplier/form');		
	} // end save

}

// end product.php