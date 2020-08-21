<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FireCtrl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library('firebase');
        $firebase = $this->firebase->init();
        $database = $firebase->getDatabase();
        $array = $database->getReference('test')->getSnapshot()->getValue();

        echo '<pre>';
        print_r($array);
    }
}

        