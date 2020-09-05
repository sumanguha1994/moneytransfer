<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('SignupModel', 'admin');
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
			$this->session->unset_userdata('original_admin_id');
			$this->session->sess_destroy();
			log_message('error', "Logout successfully");
			redirect('admin');
		}
	//dashboard
		public function dashboard()
		{
			if($this->session->userdata('adminid') != ''){
				$totaluser = $this->admin->total_user();
				$data['totaluser'] = intval($totaluser) - 1;
				$data['total_trans'] = $this->admin->total_transaction();
				$this->load->view('index', $data);
			}else{
				redirect('login');
			}
		}
	//user
		public function userView()
		{
			if($this->session->userdata('adminid') != ''){
				$data['user'] = $this->admin->getall_user();
				$this->load->view('user', $data);
			}else{
				redirect('login');
			}
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
			if($this->session->userdata('adminid') != ''){
				$data['log'] = $this->admin->get_logs(); 
				$this->load->view('log', $data);
			}else{
				redirect('login');
			}
		}
	//wallet
		public function walletView()
		{
			if($this->session->userdata('adminid') != ''){
				if(!empty($this->session->userdata('original_admin_id'))){
					redirect('wallet-view');
				}
				$this->load->view('walletlogin');
			}else{
				redirect('login');
			}
		}
		public function walletPageView()
		{
			if($this->session->userdata('adminid') != ''){
				$data['user'] = $this->admin->getall_user();
				$this->load->view('wallet', $data);
			}else{
				redirect('login');
			}
		}
		public function walletlogin()
		{
			$check = $this->admin->walletChecking($this->input->post(), true);
			if($check){
				redirect('wallet-view');
			}else {
				redirect('wallet');
			}
		}
		public function walletMoneyAdd()
		{
			$add = $this->admin->add_wallet_money($this->input->post(), true);
			$this->session->set_flashdata('succ', "Money Added Successfully.");
			redirect('wallet-view');
		}
	//change password
		public function changepassword()
		{
			if($this->session->userdata('adminid') != ''){
				$this->load->view('changepass');
			}else{
				redirect('login');
			}
		}
		public function chnagepassform()
		{
			$pass = $this->input->post('newpass');
			$confirm = $this->input->post('confirmpass');
			if($pass == $confirm){
				if($this->admin->changepass($this->input->post(),true)){
					redirect('wallet');
				}else{
					redirect('change-password');
				}
			}else{
				redirect('change-password');
			}
		}
}
