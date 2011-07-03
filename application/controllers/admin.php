<?php
class admin extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load_template('backend/admin/login', $this->data);
	}
	
	function login_submit()
	{
	
		if(!$this->input->post('submit'))
		{
			redirect('admin');
		}
	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required|callback_verify_user');
		
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
		
		if($this->form_validation->run() == false)
		{
			$this->data['has_error'] = true;
			
			$this->load_template('backend/admin/login', $this->data);	
		}
		else
		{
			$this->session->set_userdata('username', $this->input->post('username'));
			
			echo 's';
		}
	}
	
	function verify_user()
	{
		$this->load->model('user_model', 'user');
		
		$username = $this->input->post('username');
		
		$query = $this->user->get('password, salt',array('username'=>$username));
	
		if($query -> num_rows()>0)
		{
			// user exists
			
			$this->load->library('password');
			
			$row = $query->row();
			
			if($this->password->check_password($this->input->post('password').$row->salt, $row->password))
			{
				// set session
				
				return true;
			}
			
		}
		
		$this->form_validation->set_message('verify_user','username or password entered is incorrect');	
		
		return false;
	}
	
}