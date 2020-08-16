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
			$data['totaluser'] = $this->admin->total_user();
			$data['total_trans'] = $this->admin->total_transaction();
			$this->load->view('index', $data);
		}
	//user
		public function userView()
		{
			$data['user'] = $this->admin->getall_user();
			$this->load->view('user', $data);
		}
		public function userDelete()
		{
			$id = $this->input->get('id', TRUE);
			if(!empty($id)){
				$this->admin->user_delete($id);
				redirect('user');
			}else{
				redirect('user');
			}
		}
		public function upserUpdate()
		{
			$this->admin->update_user($this->input->post(), true);
			redirect('user');
		}
	//log
		public function logView()
		{
			$data['log'] = $this->admin->get_logs(); 
			$this->load->view('log', $data);
		}
	//wallet
		public function walletView()
		{
			$data['user'] = $this->admin->getall_user();
			$this->load->view('wallet', $data);
		}
		public function walletMoneyAdd()
		{
			$add = $this->admin->add_wallet_money($this->input->post(), true);
			$this->session->set_flashdata('succ', "Money Added Successfully.");
			redirect('wallet');
		}
}
