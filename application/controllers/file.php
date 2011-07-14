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
		$this->data['js'][] 	= 'fileuploader.js';

		$this->data['css'][] 	= 'js/jquery/fancybox/jquery.fancybox-1.3.4.css';

		
		$this->data['heading'] 	= 'Upload file(s)';
		$this->load_template('file/form');
	}
	
	function commit()
	{	
		$this->load->library('fileupload');
		
		$extensions = array('jpg');
		$sizelimit  = 1024*1024;
		
		// set some validations
		$this->fileupload->set_extensions($extensions);
		$this->fileupload->set_sizelimit($sizelimit);
		
		$result = $this->fileupload->commit($this->upload_path);
		
		if(isset($result['success']))
		{
			$response = array('path'=>base_url().$this->upload_path);
		}
		else
		{
			$response = $result;
		}
		
		echo htmlspecialchars(json_encode($response), ENT_NOQUOTES);				
	}
	
	function delete()
	{
		$file = $this->input->post('delete');
		
		unlink($this->upload_path.$file); // delete file
		
		echo json_encode(array('path'=>base_url().$this->upload_path, 'filename'=>$file));
	}
}
// end file class