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
    //user
    public function getall_user()
    {
        return $this->db->select('*')->from('user')
                        ->get()->result_array();
    }
    public function user_delete($id)
    {
        return $this->db->where('id', $this->db->escape_str(trim($id)))->delete('user');
    }
    public function update_user($updata)
    {
        $uparray = array(
            'name' => $this->db->escape_str(trim($updata['username'])),
            'adharno' => $this->db->escape_str(trim($updata['addharno'])),
            'mobileno' => $this->db->escape_str(trim($updata['usermobile'])),
            'yourid' => $this->db->escape_str(trim($updata['yourid'])),
        );
        return $this->db->where('id', $this->db->escape_str(trim($updata['id'])))
                            ->update('user', $uparray);
    }

    //logs
    public function get_logs()
    {
        return $this->db->select('p.*, u.name as sendername')->from('payment as p')
                        ->join('user as u', 'u.id = p.sid')
                        ->get()->result_array();
    }

    //wallet
    public function add_wallet_money($wallet)
    {
        $uid = $wallet['userid'];
        $exists = $this->wallet_money($uid);
        $upamt = $exists + floatval($wallet['amount']);
        return $this->db->where('uid', $uid)
                            ->update('wallet', array('money' => $upamt));
    }
    public function wallet_money($uid)
    {
        $money = $this->db->where('uid', $uid)
                                ->select('money')->from('wallet')
                                ->get()->row();
        return floatval($money->money);
    }
}