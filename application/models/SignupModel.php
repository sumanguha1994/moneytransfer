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
                $admin = $this->db->select('id')->where('name', 'admin')->get('user')->row();
                $this->session->set_userdata('adminid', $admin->id);
                $this->session->set_userdata('adminemail', $sql->email);
                log_message('info', "Login matched");
                return true;
            }else{
                log_message('error', "email Or password Not Matched OR Table Not Exists");
                return false;
            }
        }
    }

    //dashboard
    public function total_user()
    {
        return $this->db->select('*')->get('user')->num_rows();
    }
    public function total_transaction()
    {
        return $this->db->select("SUM(ramount) as total")->get('payment')->row();
    }

    //user
    public function getall_user()
    {
        return $this->db->select('u.*, w.money')->from('user as u')
                        ->join('wallet as w', 'w.uid = u.id')
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
        return $this->db->select('p.*, u.name as sendername, u.mobileno as senderph')->from('payment as p')
                        ->join('user as u', 'u.id = p.sid')
                        ->get()->result_array();
    }

    //wallet
    public function add_wallet_money($wallet)
    {
        $uid = $wallet['userid'];
        $exists = $this->wallet_money($uid);
        $upamt = $exists + floatval($wallet['amount']);
        $wlt = $this->db->where('uid', $uid)
                            ->update('wallet', array('money' => $upamt));
        if($wlt){
            $receiver = $this->receiver($uid);
            $pay = array(
                'sid' => $this->session->userdata('adminid'),
                'rname' => $receiver->name,
                'rmobile' => $receiver->mobileno,
                'ramount' => floatval($wallet['amount']),
                'rtoken' => $receiver->receive_token,
            );
            $this->db->insert('payment', $pay);
        }
        return true;
    }
    public function wallet_money($uid)
    {
        $money = $this->db->where('uid', $uid)
                                ->select('money')->from('wallet')
                                ->get()->row();
        return floatval($money->money);
    }
    public function receiver($uid)
    {
        return $this->db->select('u.*, w.receive_token')
                            ->from('user as u')
                            ->where('u.id', $uid)
                            ->join('wallet as w', 'w.uid = u.id')
                            ->get()->row();
    }
    public function walletChecking($check)
    {
        $sql = $this->db->select('*')
                    ->from('admin')
                        ->where('email', $this->db->escape_str(trim($check['email'])))
                        ->where('password', $this->db->escape_str(trim($check['password'])))
                        ->where('loginfor', $this->db->escape_str(trim($check['loginfor'])))
                            ->get()
                                ->row();
        if(!empty($sql)){
            $this->session->set_userdata('original_admin_id', $sql->id);
            return true;
        }else{
            return false;
        }
    }
    //change password
    public function changepass($change)
    {
        $data = array(
            'password' => $change['newpass']
        );
        return $this->db->where('password', $change['oldpass'])
                        ->update('admin', $data);
    }
}