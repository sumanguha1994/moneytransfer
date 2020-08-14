<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignupModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//login check
    public function loginCheck($loginArray){
        $this->form_validation->set_rules('email', 'Mobile No Required', 'trim|required');
        $this->form_validation->set_rules('password', 'YourID Required', 'trim|required|min_length[4]');
        if($this->form_validation->run() == FALSE){
            log_message('error', "email Or password Minimum 4 characters long");
            return false;
        }else{
            if($sql = $this->db->select('*')
                                    ->from('admin')
                                        ->where('email', $this->db->escape_str(trim($loginArray['email'])))
                                        ->where('password', $this->db->escape_str(trim($loginArray['password'])))
                                            ->get()
                                                ->row()){
                $this->session->set_userdata('adminid', $sql->id);
                $this->session->set_userdata('adminemail', $sql->email);
                log_message('info', "Login matched");
                return true;
            }else{
                log_message('error', "email Or password Not Matched OR Table Not Exists");
                return false;
            }
        }
    }
    
}