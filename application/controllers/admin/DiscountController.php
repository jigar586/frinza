<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DiscountController extends CI_Controller {
	function __construct() 
	{ 
		parent::__construct();
		checkAdminLog();
		$this->load->model('AdminModel');
		$this->load->library('adminlib/Offer');
	}
	   
	public function getForm($id) {
		$cond['is_active'] = 1;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'category_id,category_name';
		$data['categories'] = $this->AdminModel->getCondSelectedArr($cond,$select,'category_mst');

		$join = [];
		$con['childcategory_mst.is_active'] = 1;
		$con['childcategory_mst.deleted_at'] = '0000-00-00 00:00:00';
		$sel = 'subcategory_mst.category_id,child_name,child_id';
		$join[] = [ "table" => 'subcategory_mst', "on" => 'subcategory_mst.subcategory_id = childcategory_mst.subcategory_id', "type" => 'left' ];
		$data['child_categories'] = $this->AdminModel->getSelectWithJoinData($con,'childcategory_mst',$join,$sel);

		$data['offer_id'] = $id;
		
		$co['offer_id'] = $id;
		$co['priority <>'] = 3;
		$data['applied_data'] = $this->AdminModel->getSelectWithJoinData($co, 'offer_submst', array(), 'priority, applied_on');

		$this->load->view('admin/tables/modalApplyoffer',$data);
	}
	function applyOffer($id)
	{
		$data = array();
		$cat = $this->input->post('category_id');
		$child = $this->input->post('child_id');
		
		if ( $id == '') 
		{
			die(json_encode([
				'status' => false,
				'msg' => 'No offer Selected!'
			]));
		}
		$this->offer->removeOfferRelations(['offer_id' => $id]);
		if (count($child)) 
		{
			$data = array_map(function($ar) use ($id){
				$b = [];
				$b['applied_on'] = $ar;
				$b['priority'] = 2;
				$b['offer_id'] = $id;
				return $b;
			}, $child);
		}
		elseif (count($cat)) 
		{
			$data = array_map(function($ar) use ($id){
				$b = [];
				$b['applied_on'] = $ar;
				$b['priority'] = 1;
				$b['offer_id'] = $id;
				return $b;
			}, $cat);
		}
		$result = true;
		if(count($data))
			$result = $this->offer->addOfferDetail($data);
		if ($result) {
			die(json_encode([
				'status' => true,
				'msg' => 'Offer has been Applied Successfully!'
			]));
		}
	}
}
