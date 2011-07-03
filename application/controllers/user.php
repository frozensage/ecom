<?php 

class user extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->view('user/list');
	}
	
	function create()
	{
		$this->load_template('backend/user/create', $this->data);
	}
	
	function create_submit()
	{
		if(!$this->input->post('submit'))
		{
			redirect('user/create');
		}
		
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('username','Username','required|valid_email|callback_exist_user');
		$this->form_validation->set_rules('password','Password','required|min_length[6]|matches[password_conf]');
		$this->form_validation->set_rules('password_conf','Confirm password','required|');
			
		$this->form_validation->set_error_delimiters('<span class="error note">','</span>');
		
		if($this->form_validation->run() == false)
		{
			$this->data['has_error'] = true;
			
			$this->load_template('backend/user/create', $this->data);
		}
		else
		{
			$this->load->model('user_model','user');
			
			$this->user->set_table('tbl_users');
			
			$this->load->library('password');
			
			$salt = $this->_generate_salt();
			
			$password = $this->password->hash($this->input->post('password').$salt);
			
			$this->user->create(array(
				'username'=>$this->input->post('username'),
				'password'=>$password,
				'salt'=>$salt
			));
			
			echo 's';
		}
		
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