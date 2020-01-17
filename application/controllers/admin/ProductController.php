<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProductController extends CI_Controller {
	function __construct() 
	{ 
		parent::__construct();
		checkAdminLog();
		$this->load->model('AdminModel');
		$this->load->library('adminlib/Category');
	}
	   
	public function formShiftProduct($priority,$rel_id) {
		$data = [];
		$data['priority'] = $priority;
		$data['rel_id'] = $rel_id;
		$this->load->view('admin/shiftingProduct',$data);
	}

	public function searchproskuname(){
		$term = '%'.$this->db->escape_like_str($this->input->get('term', true)).'%';
		$result = $this->db->query("SELECT product_id as id, CONCAT(product_title, ' (', sku_code, ')') as label FROM product_mst WHERE deleted_at = 0 AND (product_title LIKE ? OR sku_code LIKE ?) LIMIT 10;", [$term, $term])->result();
		echo json_encode($result);
		exit();
	}

	public function storeShifted($priority,$rel_id){
		$prods = $this->input->post('prods');
		if(!count($prods)) {
			die(json_encode([
				'status' => false,
				'msg' => 'No Products selected!'
			]));
		}

		$batch = array_map(function($ar) use($priority, $rel_id) {
			$b = [];
			$b['product_id'] = $ar;
			$b['priority'] = $priority;
			$b['rel_id'] = $rel_id;
			return $b;
		}, $prods);

		$insertData = $this->AdminModel->batchInsert($batch,'product_category_rel');
		if($insertData){
			die(json_encode([
				'status' => true,
				'msg' => 'Product Shift Successfully'
			]));
		}
		die(json_encode([
			'status' => false,
			'msg' => 'Something went wrong!'
		]));
	}

	public function category_transfer(){
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/transferCategory',$data);
	}

	public function apply_transfer_category(){
		if($this->input->post('subcategory_id')){
			$con['priority'] = 2;
			$rel_array = $this->input->post('subcategory_id');
		}elseif($this->input->post('child_id')){
			$con['priority'] = 3;
			$rel_array = $this->input->post('child_id');
		}else{
			$con['priority'] = 1;
			$rel_array = $this->input->post('category_id');
		}

		$select = '*';
		$product_array = $this->AdminModel->getSelectedCatProductsArray($con,$select,'product_category_rel',$rel_array);
		
		if($product_array){
			if($this->input->post('tran_child_id')){
				$priority = 3;
				$rel_id = $this->input->post('tran_child_id');
			}elseif($this->input->post('tran_subcategory_id')){
				$priority = 2;
				$rel_id = $this->input->post('tran_subcategory_id');
			}else{
				$priority = 1;
				$rel_id = $this->input->post('tran_category_id');
			}
			foreach($rel_id as $id){
				$values = call_user_func_array('array_merge', array_map(function($ar) use($priority,$id) {
					$b = [];
					$b[0] = $ar['product_id'];
					$b[1] = $priority;
					$b[2] = $id;
					return $b;
				}, json_decode(json_encode($product_array), true)));
			
		
				$valueStr = str_repeat(', (?, ?, ?) ',(count($product_array) -1 ) );

				$status = $this->db->query('INSERT INTO product_category_rel (product_id, priority, rel_id) VALUES(?, ?, ?)'.$valueStr.'  ON DUPLICATE KEY UPDATE rel_id = VALUES(rel_id)', $values);
			}

			if($status){
				die('Successfully transfer products to category.');
			}else{
				die('Something wents wrong');
			}

		}else{
			die('No Products Found!');
		}
	}

	function homeSortPage(){
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/homeSort',$data);
	}

	function homeSort(){
		$string = $this->input->post('array');
		$array = json_decode($string, true);
		$values = call_user_func_array('array_merge', array_map(function($ar)
		{
			$b = [];
			$b[0] = $ar['product_id'];
			$b[1] = $ar['priority'];
			$b[2] = $ar['rel_id'];
			$b[3] = $ar['order_no'];
			return $b;
		}, $array));
		$valueStr = str_repeat(', (?, ?, ?, ?) ',(count($array) -1 ) );
		$status = $this->db->query('INSERT INTO home_sort_dtl (product_id, priority, rel_id, order_no) VALUES(?, ?, ?, ?)'.$valueStr.'  ON DUPLICATE KEY UPDATE order_no = VALUES(order_no)', $values);

		if($status){
			$arr['status'] = "success";
			$arr['message'] = "Successfully set product order.";
		}else{
			$arr['status'] = "failure";
			$arr['message'] = "Something want wrong!";
		}
		echo json_encode($arr);
	}
}
