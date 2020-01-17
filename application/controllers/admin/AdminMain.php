<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminMain extends CI_Controller {
	function __construct() 
	{ 
         parent::__construct();
         $this->load->model('AdminModel');
         $this->load->library('adminlib/Category');
         $this->load->library('adminlib/State');
         $this->load->library('adminlib/Cities');
         $this->load->library('adminlib/Pincode');
         $this->load->library('adminlib/Offer');
         $this->load->library('adminlib/Blog');
         $this->load->library('adminlib/Addoncategory');
   	}
	function dashboard()
	{
		checkAdminLog();
		$this->load->view('admin/dashboard');
	}
	function login()
	{
		if (isset($_SESSION['adminLog'])) {
			redirect(base_url('admin/dashboard'));
		}
		$this->load->view('admin/login');
	}
	function logOut()
	{
		checkAdminLog();
		unset($_SESSION['adminLog']);
		redirect(base_url('admin'));
	}
	function loginSubmit()
	{
		$this->load->library('user');
		$user = $this->input->post('user');
		$pass = md5($this->input->post('pass'));
		$cond = array('user_email'=> $user,
						'user_pwd'=> $pass,
						'user_role' => 2,
						'is_active' => 1);
		$result = $this->user->loginUser($cond);
   		if (count($result) == 1) {
			$r['success'] = "<p style='color:green'>Welcome to our website!  ".$result[0]->first_name."!!</p>";
			$_SESSION['adminLog'] = $result[0]->uid;
		}else {
			$r['err'] = "<p style='color:red'>Username or Password is incorrect!</p>";
		}
		echo json_encode($r);		
	}
	function aboutUsPage()
	{
		checkAdminLog();
		$data['content'] = $this->blog->getPageData(1);
		$this->load->view('admin/addAboutUs',$data);
	}
	function cancellationPage()
	{
		checkAdminLog();
		if ($this->input->post('txt')) {
			$this->db->where('page_id',3);
			$updateData['page_data'] = $this->input->post('txt');
			$this->db->update('page_mst',$updateData);
			echo 'success';
			exit();
		}
		$data['content'] = $this->blog->getPageData(3);
		$this->load->view('admin/addCancel',$data);
	}
	function privacyPage()
	{
		checkAdminLog();
		if ($this->input->post('txt')) {
			$this->db->where('page_id',5);
			$updateData['page_data'] = $this->input->post('txt');
			$this->db->update('page_mst',$updateData);
			echo 'success';
			exit();
		}
		$data['content'] = $this->blog->getPageData(5);
		$this->load->view('admin/addPrivacy',$data);
	}
	function addTermsPage()
	{
		checkAdminLog();
		$data['content'] = $this->blog->getPageData(2);
		$this->load->view('admin/addTerms',$data);
	}
	function addBannersPage()
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		if ($this->input->post('occ') != '') {
			$pageData['page_data'] = $this->input->post('occ');
			$this->db->where('page_id',4);
			$this->db->update('page_mst',$pageData);
		}
		$data['categories'] = $this->category->getCategory($cond);
		$data['selectedOccassion'] = $this->shop->getContentPage(4)[0];
		$data['occassions'] = $this->shop->getOccassions();

		$join = [];
		$con['childcategory_mst.is_active'] = 1;
		$con['childcategory_mst.is_display'] = 1;
		$con['childcategory_mst.deleted_at'] = '0000-00-00 00:00:00';
		$sel = 'subcategory_mst.category_id,child_name,child_id';
		$join[] = [ "table" => 'subcategory_mst', "on" => 'subcategory_mst.subcategory_id = childcategory_mst.subcategory_id', "type" => 'left' ];
		$data['child_categories'] = $this->AdminModel->getSelectWithJoinData($con,'childcategory_mst',$join,$sel);
		$this->load->view('admin/addBanners',$data);
	}
	function addCategoryPage()
	{
		checkAdminLog();
		$this->load->view('admin/addCategory');
	}
	function addAddonCategoryPage()
	{
		checkAdminLog();
		$this->load->view('admin/addAddonCategory');
	}
	function addSpecials()
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/specialaddtions',$data);
	}
	function addSubCategoryPage()
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/addSubCategory',$data);
	}
	function addChildCategoryPage()
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/addChildCategory',$data);
	}
	function addProductPage($id = null)
	{
		checkAdminLog();
		$sel = 'id,label,rate';
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['taxes'] = $this->AdminModel->getCondSelectedData($cond,$sel,'tax_mst');
		$data['categories'] = $this->category->getCategory($cond);
		$cond2['is_deleted'] = 0;
		$data['states'] = $this->state->getState($cond2);
		$con['is_active'] = 1;
		$data['addoncategories'] = $this->addoncategory->getAddonCategory();
		// print_r($data['addoncategories']); die;
		if ($id != null) {
			$cc['product_id'] = $id;
			$select = 'product_id,product_title,sku_code,avail_at,price,is_personalize,is_courier,product_img,product_desc,order_till,meta_keyword,meta_title,meta_description,search_terms,pincode_block';
			$this->load->library('adminlib/Product');
			$data['editProductData'] = $this->product->getProduct($cc,$select);
			$relCond['priority'] = 1;
			$relCond['product_id'] = $id;
			$select = 'rel_id as key';
			$data['categoryArr'] = $this->product->getRelation($relCond,$select);
			$relCond['priority'] = 2;
			$data['subcategoryArr'] = $this->product->getRelation($relCond,$select);
			$relCond['priority'] = 3;
			$data['childcategoryArr'] = $this->product->getRelation($relCond,$select);
			$this->load->library('adminlib/Extracharges');
			$chargeCond['product_id'] = $id;
			$data['extraCharges'] = $this->extracharges->getCharge($chargeCond);
		}
		$this->load->view('admin/addProduct',$data);
	}
	function sortProductPage()
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/sortProduct',$data);
	}
	function viewProductPage()
	{
		checkAdminLog();
		$this->load->view('admin/viewProduct');
	}
	function availStatesPage()
	{
		checkAdminLog();
		$this->load->view('admin/availStates');
	}
	function availCitiesPage()
	{
		checkAdminLog();
		$cond['is_deleted'] = 0;
		$data['states'] = $this->state->getState($cond);
		$this->load->view('admin/availCities',$data);
	}
	function availPincodesPage()
	{
		checkAdminLog();
		$cond['city_mst.is_deleted'] = 0;
		$cond['state_mst.is_deleted'] = 0;
		$data['state_city_array'] = $this->pincode->getStateCity($cond);
		$this->load->view('admin/availPincodes',$data);
	}
	function addDiscountPage($id = null)
	{
		checkAdminLog();
		$data = array();
		if ($id != '') {
			$cond['offer_id'] = $id;
			$data['offerData'] = $this->offer->getOffer($cond);
		}
		
		$this->load->view('admin/addDiscount',$data);
	}
	function allCustomersPage()
	{
		checkAdminLog();
		$data['customers'] = $this->AdminModel->getAllCustomers();
		$this->load->view('admin/customers',$data);
	}
	function applyDiscountPage()
	{
		checkAdminLog();
		$offer['status'] = 1;
		$offer['deleted_at'] = '0000-00-00 00:00:00';
		$data['offers'] = $this->offer->getOfferList($offer);
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/applyDiscount',$data);
	}
	function viewOrderPage()
	{
		checkAdminLog();
		$cond['is_available'] = 1;
		$select = 'vendor_id,vendor_name,city_id';
		$this->load->library('adminlib/Vendor');
		$data['vendors'] = $this->vendor->getVendor($cond,$select);
		$this->load->view('admin/viewOrder',$data);
	}
	function viewPendingOrderPage()
	{
		checkAdminLog();
		$this->load->view('admin/pendingOrder');
	}
	function viewForwardedOrderPage()
	{
		checkAdminLog();
		$cond['is_available'] = 1;
		$select = 'vendor_id,vendor_name';
		$this->load->library('adminlib/Vendor');
		$data['vendors'] = $this->vendor->getVendor($cond,$select);
		$this->load->view('admin/forwardedOrders',$data);
	}
	function viewAcceptedOrderPage()
	{
		checkAdminLog();
		$this->load->view('admin/acceptedOrders');
	}
	function viewShippedOrderPage()
	{
		checkAdminLog();
		$this->load->view('admin/shippedOrders');
	}
	function sortingProducts()
	{
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
		$status = $this->db->query('INSERT INTO product_sort_dtl (product_id, priority, rel_id, order_no) VALUES(?, ?, ?, ?)'.$valueStr.'  ON DUPLICATE KEY UPDATE order_no = VALUES(order_no)', $values);

		if($status){
			$arr['status'] = "success";
			$arr['message'] = "Successfully set product order.";
		}else{
			$arr['status'] = "failure";
			$arr['message'] = "Something want wrong!";
		}
		echo json_encode($arr);
	}
	function viewDeliveredOrderPage()
	{
		checkAdminLog();
		$this->load->view('admin/deliveredOrders');
	}
	function addVendorPage($id = null)
	{
		checkAdminLog();
		$cond['is_deleted'] = 0;
		$data['states'] = $this->state->getState($cond);
		if ($id != null) {
			$cc['vendor_id'] = $id;
			$select = 'vendor_id,vendor_name,vendor_email,vendor_address,city_id,pin_code,vendor_contact';
			$this->load->library('adminlib/Vendor');
			$data['editVendorData'] = $this->vendor->getVendor($cc,$select);
		}
		$this->load->view('admin/addVendor',$data);
	}
	function viewVendorPage()
	{
		checkAdminLog();
		$this->load->view('admin/viewVendors');
	}
	function addBlogPage($id = null)
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->blog->getCategory($cond);
		if ($id != null) {
			$cc['blog_id'] = $id;
			$data['editBlogData'] = $this->blog->getBlogData($cc);
		}
		$this->load->view('admin/addBlog',$data);
	}
	function addBlogCategory()
	{
		checkAdminLog();
		$this->load->view('admin/blogCategory');
	}
	function viewBlogsPage()
	{
		checkAdminLog();
		$this->load->view('admin/viewBlogs');
	}
	function shippingTypes()
	{
		checkAdminLog();
		$cond2['is_deleted'] = 0;
		$data['states'] = $this->state->getState($cond2);
		$this->load->view('admin/shippingCharges',$data);
	}
	function timeSlots()
	{
		checkAdminLog();
		$this->load->view('admin/timeSlots');
	}
	function corporateOrder()
	{
		checkAdminLog();
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$cond2['is_deleted'] = 0;
		$data['states'] = $this->state->getState($cond2);
		$this->load->view('admin/corporateOrder',$data);
	}
	function cancelledOrderPage()
	{
		checkAdminLog();
		$this->load->view('admin/cancelorder');
	}
	function refundToWalletPage()
	{
		checkAdminLog();
		$this->load->view('admin/refundedToWallet');
	}
	function refundToBankPage()
	{
		checkAdminLog();
		$this->load->view('admin/refundedToBank');
	}
	function extraSettings()
	{
		if ($this->input->post('redeem_rate')) {
			$this->db->where('page_id',6);
			$updateData['page_data'] = json_encode(['redeem_rate' => $this->input->post('redeem_rate')]);
			$this->db->update('page_mst',$updateData);
			$data['successMsg'] = 'Redeem Rate has been updated!';
		}
		if ($this->input->post('occ') != '') {
			$pageData['page_data'] = $this->input->post('occ');
			$this->db->where('page_id',4);
			$this->db->update('page_mst',$pageData);
		}
		$data['record'] = $this->blog->getPageData(6)[0];
		
		$data['selectedOccassion'] = $this->shop->getContentPage(4)[0];
		$data['occassions'] = $this->shop->getOccassions();
		$this->load->view('admin/additionalSettings',$data);
	}
	function listTax(){
		$this->load->view('admin/addTax');
	}
	function tableTax(){
		$con['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'id,label, rate';
		$data['taxes'] = $this->AdminModel->getCondSelectedData($con, $select, 'tax_mst');
		return $this->load->view('admin/tables/taxtable',$data);
	}
	function fromTax($id = 0){
		$data = [];
		$data['tax_id'] = $id;
		if($id != 0){
			$select = 'label,rate,id';
			$con['id'] = $id;
			$data['singleTax'] = $this->AdminModel->getCondSelectedArr($con, $select, 'tax_mst');
		}
		return $this->load->view('admin/tables/formTax',$data);
	}
}