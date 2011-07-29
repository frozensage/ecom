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
		
		$this->form_validation->set_rules($this->rules);
	
		switch($perform)
		{
			/******** start add ********/
			case "add":
						
			// check vocabulary id is valid			
			$this->vocabulary->set_where(array('id'=>$id));
			$query = $this->vocabulary->get();
			
			if($query->num_rows<1)
			{
				show_404();
				return;
			}
							
			$this->data['vid'] = $id;
			$this->data['action'] = site_url("taxonomy/term/$perform/$id");	
			
			// perform validation
			if ($this->form_validation->run()) // validation success
			{
				if($this->term->create($this->input->post('term'))) //save successful
				{
					redirect("taxonomy/vocabulary/$id");
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
			
			$this->data['saved'] = $term = $query->row();	
			$this->data['action'] = site_url("taxonomy/term/$perform/$id");	
			
			// perform validation
			if ($this->form_validation->run()) // validation success
			{				
				if($this->term->update($this->input->post('term'))) //save successful
				{
					redirect("taxonomy/vocabulary/$term->vocabulary_id");
				}
			}
			
			break;
			/******** end edit ********/
		}
		
		$this->load_template('taxonomy/term');
		
	}
}
// end taxonomy.php