<?php 

class user extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('backend')) // kick back to log in
		{
			redirect('admin');
		}
	}
	
	function index()
	{
		$this->manage();
	}
	
	function create()
	{
		if($this->input->post('submit'))
		{
			$this->load->library('form_validation');
				
			$this->form_validation->set_rules('email','Email','required|valid_email|callback_exist_user');
			$this->form_validation->set_rules('password','Password','required|min_length[6]|matches[password_conf]');
			$this->form_validation->set_rules('password_conf','Confirm password','required|');
				
			$this->form_validation->set_error_delimiters('<span class="error note">','</span>');
			
			if($this->form_validation->run())
			{
				$this->load->model('user_model','user');
				
				$this->user->set_table('tbl_users');
				
				$this->load->library('password');
				
				$salt = $this->_generate_salt();
				
				$password = $this->password->hash($this->input->post('password').$salt);
				
				$this->user->create(array
				(
					'email'		=>$this->input->post('email'),
					'password'	=>$password,
					'salt'		=>$salt
				));
				
				redirect('user');
			}
			else
			{
				$this->data['has_error'] = true;
			}

		}

		$this->data['heading'] = 'Create user';
		$this->load_template('user/create', $this->data);
	}

	function manage()
	{
		$this->load->model('user_model','user');

		$this->data['heading'] = 'Manage users';
		$this->data['query'] = $this->user->get();
		
		$this->load_template('user/manage');
	}
	
	function exist_user($email)
	{
		$this->load->model('user_model', 'user');
				
		$query = $this->user->get('id', array('email'=>$this->input->post('email')));
	
		if($query -> num_rows()>0)
		{
			$this->form_validation->set_message('exist_user','email "'.$this->input->post('email').'" already exists.');	
			return false;
		}
		
		return true;
	}
	
	private function _generate_salt() 
	{
		if (!function_exists('random_string')) 
		{
			$this->CI->load->helper('string');
		}
		
		return random_string('alnum', 8);
	}
	
}