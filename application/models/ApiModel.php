<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function signup_api($signup)
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('adharno', 'Adhar No', 'trim|required');
        $this->form_validation->set_rules('mobileno', 'Mobile No', 'trim|required');
        $this->form_validation->set_rules('yourid', 'YourID', 'trim|required');
        if($this->form_validation->run() != FALSE){
            $userdata = array(
                'name' => $this->db->escape_str(trim($signup['name'])),
                'adharno' => $this->db->escape_str(trim($signup['adharno'])),
                'mobileno' => $this->db->escape_str(trim($signup['mobileno'])),
                'yourid' => $this->db->escape_str(trim($signup['yourid']))
            );
			if($this->db->insert('user', $userdata)){
				return "User created successfully";
			}else{
				return "Something Went Wrong";
			}
		}else{
			return "Validation Error";
		}
	}

	public function login_api($login)
	{
		$this->form_validation->set_rules('mobileno', 'Mobile No', 'trim|required');
        $this->form_validation->set_rules('yourid', 'YourID', 'trim|required');
        if($this->form_validation->run() != FALSE){
			$user = $this->db->select('*')
							->from('user')
							->where('mobileno', $this->db->escape_str(trim($login['mobileno'])))
							->where('yourid', $this->db->escape_str(trim($login['yourid'])))
							->get()
							->row();
			if(!empty($user)){
				return $user;
			}else{
				return "No Data Found";
			}
		}else{
			return "validationerror";
		}
	}
    
}