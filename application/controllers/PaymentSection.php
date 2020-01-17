<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentSection extends CI_Controller {
	function __construct() 
	{ 
         parent::__construct();
         // $this->load->model('UserModel');
   	}
   	function index()
   	{
   		if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
		  //Request hash
   		  $salt = 'yVIDqF7RoW';
		  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : ''; 
		  if(strcasecmp($contentType, 'application/json') == 0){
		    $data = json_decode(file_get_contents('php://input'));
		    //print_r($data);
		    $hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$salt);
		    $json=array();
		    $json['success'] = $hash;
		      	echo json_encode($json);
			}
				else{
				exit(0);
			}
		}
 
   	}
   	   	
}