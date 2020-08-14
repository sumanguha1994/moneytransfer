<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('SignupModel', 'admin');
		if(empty($this->session->userdata('adminid'))){
			$this->load->view('login');
		}
	}
	//login initialize
		public function index()
		{
			$this->load->view('login');
		}
		//login
		public function login(){
			if(empty($this->session->userdata('adminid'))){
				if($this->admin->loginCheck($this->input->post(), true)){
					redirect('dash');
				}else{
					$this->session->set_flashdata('fail', "Email Or Password Not Matched");
					redirect('admin');
				}
			}else{
				redirect('dash');
			}
		}
		//logout
		public function logout(){
			$this->session->unset_userdata('adminid');
			$this->session->unset_userdata('adminemail');
			$this->session->sess_destroy();
			log_message('error', "Logout successfully");
			redirect('admin');
		}
	//dashboard
		public function dashboard()
		{
			$this->load->view('index');
		}
	//
}
