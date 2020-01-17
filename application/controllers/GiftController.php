<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GiftController extends CI_Controller {

	function __construct() 
	{ 
		parent::__construct();
		$this->load->model('UserModel');
	}
	   
	function index()
	{
		if (!$this->session->userdata('loggedUser')) {
			redirect(base_url('login'));
		}
		if ($this->input->get('ab')) {
			$cond['price >='] = $this->input->get('ab');
		}
		
		if ($this->input->get('bl')) {
			$cond['price <='] = $this->input->get('bl');
		}
		if ($this->input->post('search')) {
			$this->session->set_userdata('search',$this->input->post('search'));
		}
		
		$search = $this->session->userdata('search');
		$cond['product_title LIKE'] = '%'.$search.'%';
		$data['catName'] = 'Search Results for "'.$search.'"';
		$cond['status'] = 1;
		$cond['addoncategory_id'] = 0;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['productCount'] = $this->shop->getProductCount($cond);
		if ($this->input->get('filt')) {
			$cond['sorts'] = $this->input->get('filt');
			$cond['wise'] = 'price';
		}
		$data['newProducts'] = $cond;
		$data['banners'] = array();
		$data['OfferBan'] = $this->shop->getOfferBanner();
		$this->load->view('gift');
	}

}
