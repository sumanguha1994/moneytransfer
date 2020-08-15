<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class ApiCtrl extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('ApiModel', 'api');
    }
    /**
     * Get All Data from this method.
     * All metods starts with $controller_method = "index_" . $this->request->method;  //"index_" prefix
     * @return Response
    */
    public function index_get()
    {
        $input = $this->input;
        if($input->get('wallet') == '1'){
            $data = $this->api->wallet_api($this->input->get('uid'), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif($input->get('alllog') == '1'){
            $data = $this->api->all_log_api($this->input->get('uid'), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif($input->get('log') == '1'){
            $data = $this->api->log_api($this->input->get('uid'), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif($input->get('userdata') == '1'){
            $data = $this->api->user_api($this->input->get('uid'), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response(['Validation Error.'], REST_Controller::HTTP_NON_AUTHORITATIVE_INFORMATION);
        }
    }

    public function index_post()
    {
        $input = $this->input;
        if($input->post('signup') == '1'){
            $data = $this->api->signup_api($this->input->post(), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif($input->post('login') == '1'){
            $data = $this->api->login_api($this->input->post(), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif($input->post('payment') == '1'){
            $data = $this->api->payment_api($this->input->post(), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif($input->post('update') == '1'){
            $data = $this->api->update_api($this->input->post(), true);
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response(['Validation Error.'], REST_Controller::HTTP_NON_AUTHORITATIVE_INFORMATION);
        }
    }
}