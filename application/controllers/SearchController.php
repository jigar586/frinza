<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class SearchController extends CI_Controller {
	function __construct() 
	{ 
        parent::__construct();
   	}
	function searchProduct(){
		$this->load->model('SearchModel');
		if ($this->input->get('ab')) {
			$cond['price >='] = $this->input->get('ab');
		}

		if ($this->input->get('bl')) {
			$cond['price <='] = $this->input->get('bl');
		}
		if ($this->input->get('term')) {
			$search = $this->input->get('term');
		}

		$cond['term'] = '%'.@$search.'%';
		$cond['addoncategory_id'] = 0;
		$data['catName'] = 'Search Results for "'.@$search.'"';
		$cond['status'] = 1;
		$cond['deleted_at'] = '0000-00-00 00:00:00';

		$data['productCount'] = $this->SearchModel->getProductCount($cond);
		if ($this->input->get('filt')) {
			$cond['sorts'] = $this->input->get('filt');
			$cond['wise'] = 'price';
		}
		$data['newProducts'] = $cond;
		$data['banners'] = array();

		$this->load->view('searchresult',$data);
	}

	function searchList(){
		$this->load->model('SearchModel');
		$cond = json_decode($this->input->post('arr'),true);
		$sorting = 'DESC';
		$wise = 'created_at';
		if (isset($cond['sorts']) && isset($cond['wise'])) {
			$sorting = $cond['sorts'];
			$wise = $cond['wise'];
			unset($cond['sorts']);
			unset($cond['wise']);
		}
		$page = $this->input->post('pageNo');
		$limit = 12;
		$data['newProducts'] = $this->SearchModel->getSearchedProduct($cond,$limit,$page,$sorting,$wise);
		$this->load->view('includes/listProduct',$data);
	}
}