<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
//post apis	
	public function signup_api($signup)
	{
		//$this->form_validation->set_rules('name', 'Name', 'trim|required');
        //$this->form_validation->set_rules('adharno', 'Adhar No', 'trim|required');
        //$this->form_validation->set_rules('mobileno', 'Mobile No', 'trim|required');
        //$this->form_validation->set_rules('yourid', 'YourID', 'trim|required');
        //if($this->form_validation->run() != FALSE){
		if($this->get_wallet_money($this->db->escape_str(trim($signup['mobileno']))) == false){
            $userdata = array(
                'name' => $this->db->escape_str(trim($signup['name'])),
                'adharno' => $this->db->escape_str(trim($signup['adharno'])),
                'mobileno' => $this->db->escape_str(trim($signup['mobileno'])),
                'yourid' => $this->db->escape_str(trim($signup['yourid']))
            );
			if($this->db->insert('user', $userdata)){
				$inserted_id = $this->db->insert_id();
				$last_receive_token;
				$last = $this->db->order_by('id', 'desc')->limit(1)->get('wallet')->row();
				if(!empty($last)){
					$last_receive_token = intval($last->receive_token);
				}
				$receive_token = !empty($last_receive_token) ? $last_receive_token + 1 : 1000;
				$walletdata = array(
					'uid' => $inserted_id,
					'money' => 100,
					'total_transfer_money' => 0,
					'receive_token' => $receive_token
				);
				if($this->db->insert('wallet', $walletdata)){
					$user = $this->db->select('*')->from('user')->where('id', $inserted_id)->get()->row();
					return $user;
				}else{
					return "Wallet not created !!";
				}
			}else{
				return "Something Went Wrong !!";
			}
		}else{
			return "Mobile NO Already Exists !!";
		}
		//}else{
		//	return "Validation Error !!";
		//}
	}

	public function login_api($login)
	{
		//$this->form_validation->set_rules('mobileno', 'Mobile No', 'trim|required');
        //$this->form_validation->set_rules('yourid', 'YourID', 'trim|required');
        //if($this->form_validation->run() != FALSE){
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
		//}else{
		//	return "validationerror";
		//}
	}
	
	public function payment_api($pay)
	{
		//$this->form_validation->set_rules('sid', 'Sender ID', 'trim|required');
		//$this->form_validation->set_rules('rname', 'Receiver Name', 'trim|required');
        //$this->form_validation->set_rules('rmobile', 'Receiver Mobile', 'trim|required');
        //$this->form_validation->set_rules('ramount', 'Receiver Amount', 'trim|required');
        //$this->form_validation->set_rules('rtoken', 'Receiver Token', 'trim|required');
        //if($this->form_validation->run() != FALSE){
			$patdata = array(
				'sid' => $this->db->escape_str(trim($pay['sid'])),
				'rname' => $this->db->escape_str(trim($pay['rname'])),
				'rmobile' => $this->db->escape_str(trim($pay['rmobile'])),
				'ramount' => $this->db->escape_str(trim($pay['ramount'])),
				'rtoken' => $this->db->escape_str(trim($pay['rtoken'])),
			);
			if($this->db->insert('payment', $patdata)){
				$walletdata = $this->wallet_data($this->db->escape_str(trim($pay['sid'])));
				if($walletdata){
					$wallet_money = $walletdata[0] - floatval($pay['ramount']);
					$wallet_transfer_money = $walletdata[1] + floatval($pay['ramount']);
					$updatedata = array(
						'money' => $wallet_money,
						'total_transfer_money' => $wallet_transfer_money
					);
					$update = $this->db->where('uid', $this->db->escape_str(trim($pay['sid'])))
											->update('wallet', $updatedata);
					if($update){
						$r_wallet_money = $this->get_wallet_money($this->db->escape_str(trim($pay['rmobile'])));
						if($r_wallet_money){
							$up_money = $r_wallet_money[0] + floatval($pay['ramount']);
							$uparray = array(
								'money' => $up_money,
							);
							$up = $this->db->where('uid', $this->db->escape_str(trim($r_wallet_money[1])))
											->update('wallet', $uparray);
							if($up){
								return "Paymeny Successfull.";
							}else{
								return "Sender Send But Receiver Not Received !!";
							}
						}else{
							return "Receiver Not Found !!";
						}
					}else{
						return "Payment Not Done !!";
					}
				}else{
					return "Wallet Not Found !!";
				}
			}else{
				return "Something Went Wrong !!";
			}
		//}else{
		//	return "validation error";
		//}
	}

	public function wallet_data($id)
	{
		$data = array();
		$wallet = $this->db->select('*')
							->from('wallet')->where('uid', $id)
							->get()->row();
		if(!empty($wallet)){
			$data[0] = floatval($wallet->money);
			$data[1] = floatval($wallet->total_transfer_money);
			return $data;
		}else{
			return false;
		}
	}

	public function get_wallet_money($mobileno)
	{
		$data = array();
		$uid = $this->db->select('id')->from('user')
							->where('mobileno', $mobileno)->get()->row();
		if(!empty($uid)){
			$money = $this->db->select('money')->from('wallet')
							->where('uid', $uid->id)->get()->row();
			$data[0] = floatval($money->money);
			$data[1] = $uid->id;
			return $data;
		}else{
			return false;
		}
	}
//get apis
	public function wallet_api($uid)
	{
		if(!empty($uid)){
			$wallet = $this->db->select('*')->from('wallet')
								->where('uid', $this->db->escape_str(trim($uid)))
								->get()->row();
			return $wallet;
		}else{
			return "User Id required !!";
		}
	}

	public function all_log_api($uid)
	{
		if(!empty($uid)){
			$pay = $this->db->select('*')->from('payment')
							->where('sid', $this->db->escape_str(trim($uid)))->get()->result_array();
			return $pay;
		}else{
			return "User ID required !!";
		}
	}

	public function log_api($uid)
	{
		if(!empty($uid)){
			$pay = $this->db->select('p.*, u.*, pd.user_profile')->from('payment as p')
							->where('p.sid', $this->db->escape_str(trim($uid)))
							->join('user as u', 'u.id = p.sid')
							->join('user as pd', 'pd.id = p.sid')
							->order_by('p.id', 'desc')->limit(5)
							->get()->result_array();
			return $pay;
		}else{
			return "User ID required !!";
		}
	}
	
	public function user_api($uid)
	{
		if(!empty($uid)){
			$user = $this->db->select('u.*, w.receive_token')->from('user as u')
								->join('wallet as w', 'w.uid = u.id')
								->where('u.id', $this->db->escape_str(trim($uid)))->get()->row();
			return $user;
		}else{
			return "User ID required !!";
		}
	}
	
	public function receiver_api($rtoken)
	{
	    if(!empty($rtoken)){
	        $receiver = $this->db->select('w.receive_token, u.*')
	                            ->from('wallet as w')
	                            ->where('w.receive_token', $this->db->escape_str(trim($rtoken)))
	                            ->join('user as u', 'u.id = w.uid')
	                            ->get()->row();
	       if(!empty($receiver)){
	           return $receiver;
	       }else{
	           return "NO User Found !!";
	       }
	    }else{
			return "User ID required !!";
		}
	}
//put apis
	public function update_api($udata)
	{
		$uid = $udata['uid'];
		if(!empty($uid)){
			$up_pass = $this->db->escape_str(trim($udata['yourid']));
			$up_conf_pass = $this->db->escape_str(trim($udata['conf_yourid']));
			if($up_pass == $up_conf_pass){
				$updata = array(
					'name' => $this->db->escape_str(trim($udata['name'])),
					'yourid' => $up_pass
				);
				$up = $this->db->where('id', $uid)
								->update('user', $updata);
				if($up){
					return "Profile Updated !!";
				}else{
					return "Something Went Wrong !!";
				}
			}else{
				return "Your ID && Retype ID Not Same !!";
			}
		}else{
			return "User Id required !!";
		}
	}

	public function profile_pic_change($udata)
	{
	    $uid = $udata['uid'];
	    $url = $udata['fileurl'];
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSLVERSION, 3);
		$file_data = curl_exec($curl);
		curl_close($curl);
		$file_path = 'upload/' . $uid . '.jpg';
		$file = fopen($file_path, 'wb');
        fputs($file, $file_data);
        fclose($file);
        $updata = array(
			'user_profile' => $file_path,
		);
		$up = $this->db->where('id', $uid)
						->update('user', $updata);
		if($up){
		    return $file_path;
		}else{
		    return "Profile pic not update !!";
		}
	}
}