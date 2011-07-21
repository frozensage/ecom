<?php
class Taxonomy extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('vocabulary_model', 'vocabulary');
		$this->load->model('term_model', 'term');
		
		// validation rules
		$this->rules = array(
			array(
				'field'	=> 'term[term]',
				'label'	=> '"Term"',
				'rules'	=> 'trim|required'
			)
		);
	}
	
	function index()
	{
	}
	
	function vocabulary($vocabulary_id)
	{
		
		if($terms = $this->input->post('terms'))
		{							
			foreach($terms as $index=>$id)
			{							
				$this->term->set_where(array('id'=>$id));								
				$this->term->update(array('order'=>$index+1));
			}

			$this->session->set_flashdata('success', 'Terms order has been updated');

			redirect('taxonomy/vocabulary/'.$vocabulary_id);
		}
		
		$this->term->set_order_by(array('order'=>'asc'));
		$this->term->set_where(array('vocabulary_id'=>$vocabulary_id));
		
		$this->data['terms'] = $this->term->get();
		$this->data['id'] = $vocabulary_id;
		$this->load_template('taxonomy/vocabulary');
	}
	
	function term($perform=null, $id=null)
	{
		if(!isset($perform) or !isset($id))
		{
			show_404();
			return;
		}
	
		// default values
		$this->data['values'] = array(
			"term"	=> array(
				"id" 			=> '',
				"term" 			=> '',
				"description"	=> '',
				"vocabulary_id"	=> '',
			)
		);
		
		$this->form_validation->set_rules($this->rules);
	
		switch($perform)
		{
			/******** start add ********/
			case "add":
			
			// check vocabulary id is valid	
			$query = $this->vocabulary->get(array('id'=>$id));
				
			if(!$query->row())
			{
				show_404();
				return;
			}
			
			$this->data['values']['term']['vocabulary_id'] = $id;
			
			$this->data['action'] = site_url("taxonomy/term/$perform/$id");	
			
			// perform validation
			if ($this->form_validation->run()) // validation success
			{
				if($this->term->save($_POST)) //save successful
				{
					redirect("taxonomy/vocabulary/$id");
				}
				else //save failed
				{
					$this->data['values'] = $_POST; // repopulate with submitted data
				}				
			}
			else // validation failed
			{
				if($_POST) // repopulate with submitted data
				{
					$this->data['values'] = $_POST;
				}
			}
			
			break;
			/******** end add ********/
			
			/******** start edit ********/
			case "edit":
			
			$this->term->set_where(array('id'=>$id));
			$query = $this->term->get();
			
			// check if term id is valid
			if($query->num_rows()<0)
			{
				show_404();
				return;
			}
			
			$this->data['saved'] = $query->row();	
			$this->data['action'] = site_url("taxonomy/term/$perform/$id");	
			
			// perform validation
			if ($this->form_validation->run()) // validation success
			{
				if($this->term->save($_POST)) //save successful
				{
					redirect("taxonomy/vocabulary/$term->vocabulary_id");
				}
				else //save failed
				{
				//	$this->data['values'] = $_POST; // repopulate with submitted data
				}
			}
			else // validation failed
			{
			/*	if($_POST) // repopulate with submitted data
				{
					$this->data['values'] = $_POST;
				}
				else
				{
					$this->data['values']['term'] = (array) $term;
				}*/
			}
			
			break;
			/******** end edit ********/
		}
				
		$this->load_template('taxonomy/term');
		
	}
}
// end taxonomy.php