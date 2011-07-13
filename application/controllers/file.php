<?php
class file extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
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
		$this->data['js'][] 	= 'fileuploader.js';
		
		$this->data['heading'] 	= 'Upload file(s)';
		$this->load_template('file/form');
	}
	
	function commit()
	{
		echo 'sadsad';
	}
}
// end file class