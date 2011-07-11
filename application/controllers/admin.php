<?php
class admin extends CI_Controller
{
	protected $data;
	
	function __construct()
	{
		parent::__construct();
		
		$this->data['css'] = array
		(
		 	'css/style.css',
			'css/jquery.wysiwyg.css',
			'css/facebox.css',
			'css/visualize.css',
			'css/date_input.css'
		);
	}
	
	function index()
	{
		if($this->session->userdata('backend')) // send to user list
		{
			redirect('user');
		}
	
		if($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required|callback_verify_user');
			
			$this->form_validation->set_error_delimiters('<p class="error">','</p>');
			
			if($this->form_validation->run())
			{
				$this->load->model('user_model', 'user');
				
				$this->user->set_select('id,email');
				$this->user->set_where(array('email'=>$this->input->post('email')));			
				
				$row = $this->user->get()->row();
				
				$this->session->set_userdata('backend', $row);
				
				redirect('user/manage');
			}
			else
			{
				$this->data['has_error'] = true;				
			}
		}

		$this->load->view('backend/admin/header', $this->data);
		$this->load->view('backend/admin/login', $this->data);
		$this->load->view('backend/admin/footer', $this->data);
	}
	
	function logout()
	{		
		$this->session->unset_userdata('backend');
		
		redirect('admin');
	}
	
	function verify_user()
	{
		$this->load->model('user_model', 'user');
		
		$email = $this->input->post('email');
		
		$this->user->set_where(array('email'=>$email));
		
		$query = $this->user->get();
	
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