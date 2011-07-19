<?php
class file extends MY_Controller
{
	private $upload_path;	

	function __construct()
	{
		parent::__construct();
		
		$this->upload_path = 'uploads/';	
	}
	
	function index()
	{
	}
	
	function manage()
	{
	}
	
	function results()
	{
		$this->load->model('file_model','file');
	}
	
	function upload()
	{
		$this->data['js'][] 	= 'jquery/jquery.filestyle.mini.js';
		$this->data['js'][] 	= 'jquery/fancybox/jquery.fancybox-1.3.4.pack.js';
		$this->data['js'][] 	= 'jquery/fancybox/jquery.easing-1.3.pack.js';
		$this->data['js'][] 	= 'ajaxupload.js';

		$this->data['css'][] 	= 'js/jquery/fancybox/jquery.fancybox-1.3.4.css';
		
		$this->data['heading'] 	= 'Upload file(s)';
		$this->load_template('file/form');
	}
	
	function commit()
	{	
		$config['upload_path'] 		= 'uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '10 * 1024 * 1024';
		$config['max_width'] 		= '1024';
		$config['max_height']  		= '768';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('file'))
		{		
			$error = array('error' => $this->upload->display_errors('<span class="error note">','</span>'));
		
			echo htmlspecialchars(json_encode($error));
			//echo json_encode($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			echo json_encode($data);
		}						
	}
	
	function delete()
	{
		$file = $this->input->post('delete');
		
		unlink($this->upload_path.$file); // delete file
		
		echo json_encode(array('path'=>base_url().$this->upload_path, 'filename'=>$file));
	}
}
// end file class