<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class ApiCtrl extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get All Data from this method.
     * All metods starts with $controller_method = "index_" . $this->request->method;  //"index_" prefix
     * @return Response
    */
    public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("items", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("items")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('items',$input);
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    } 
}