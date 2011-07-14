<?php
require_once('qqfileuploader/qqfileuploader.php');

// wrapper class for qqfileuploader
class fileupload extends qqFileUploader
{
	protected $extensions;
	protected $sizelimit;
	protected $uploaded;
	
	function __construct(){}
	
	function commit($path='uploads/')
	{		
		$this->uploader = new qqFileUploader($this->extensions, $this->sizelimit);
		
		return $this->uploader->handleUpload($path);
	}
	
	function set_extensions($extensions)
	{
		$this->extensions = $extensions;
	}
	
	function set_sizelimit($sizelimit)
	{
		$this->sizelimit = $sizelimit;
	}
}

// end fileupload.php class