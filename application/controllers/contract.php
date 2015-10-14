<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contract extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('contract_message');
	}

	public function give_info()
	{		
		$name = $this->input->post('name');		
		$file = fopen(APPPATH.'contracts.csv', 'r');
		while (($line = fgetcsv($file)) !== FALSE) {		  		
		 	if(strcmp($line[0],$name)==0) 
		 	{
		 			$result['values'] = $line;
		 	} 
		}		
		fclose($file);	   
	    $result['success']='true';
	   	echo json_encode($result);	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */