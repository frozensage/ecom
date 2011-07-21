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
	
	function commit()
	{	
		$config['upload_path'] 		= 'uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= 2 * 1024; // in kb
		$config['max_width'] 		= 1024;
		$config['max_height']  		= 768;
		$config['remove_spaces']	= true;

		$this->load->library('upload', $config);
		
		// upload failed
		if ( ! $this->upload->do_upload('file'))
		{		
			$error = array('error' => $this->upload->display_errors('',''));
		
			echo json_encode($error);
		}
		// upload successful
		else
		{
			$this->load->model('file_model','file');
			
			$data = $this->upload->data();
			
			$last_ins = $this->file->create($data);
			
			echo json_encode($data);
		}						
	}
	
	function delete()
	{
		if($filename = $this->input->post('delete'))
		
		//if($filename)
		{
			$this->load->model('file_model','file');
			$this->file->set_where(array('file_name'=>$filename));
			$query = $this->file->get();
						
			// file exists in db
			if($query->num_rows()>0)
			{
				$row = $query->row();
				
				// physical file deleted successfully
				if(unlink($row->file_path.$row->file_name))
				{
					$this->file->delete(); // delete record

					echo json_encode(array('filename'=>$filename));
				}
				else
				{
					echo json_encode(array('error'=>"physical file: $filename could not be deleted"));
				}
				
			}
			else
			{
				echo json_encode(array('error'=>"file: $filename record does not exist in database"));
			}
		}
		else
		{
			echo json_encode(array('error'=>'no file selected'));
		}
	}
}
// end file class