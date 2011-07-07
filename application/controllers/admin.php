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
		
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required|callback_verify_user');
		
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
		
		if($this->form_validation->run() == false)
		{
			$this->data['has_error'] = true;
			
			$this->load_template('backend/admin/login', $this->data);	
		}
		else
		{
			$this->load->model('user_model', 'user');
			
			$row = $this->user->get('id, email', array('email'=>$this->input->post('email')))->row();
			
			$this->session->set_userdata($row);
						
			echo 's';
		}
	}
	
	function verify_user()
	{
		$this->load->model('user_model', 'user');
		
		$email = $this->input->post('email');
		
		$query = $this->user->get('password, salt', array('email'=>$email));
	
		if($query -> num_rows()>0)
		{
			// user exists
			
			$this->load->library('password');
			
			$row = $query->row();
			
			if($this->password->check_password($this->input->post('password').$row->salt, $row->password))
			{
				// user verified
				
				return true;
			}
			
		}
		
		$this->form_validation->set_message('verify_user','username or password entered is incorrect');	
		
		return false;
	}
	
}