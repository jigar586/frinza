<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class ShopSection extends CI_Controller {
	function __construct() 
	{ 
		parent::__construct();
	}
	public function checkout(){
		resumeCart();
		if (!$this->session->userdata('loggedUser')) {
			redirect(base_url('login'));
		}
		$data['cartData'] = getCartData();
		$data['cartTotal'] = $cartTotal = @getCartTotal();
		$data['shipTotal'] = $shipTotal = @getShippingTotal();
		$wallet = redeemAmount($cartTotal+$shipTotal);
		$payable = $cartTotal+$shipTotal;
		if ($wallet > $payable) {
			$data['payableWal'] = $payable;
			$data['payableAmount'] = 0;
		}else{
			$data['payableWal'] = $wallet;
			$data['payableAmount'] = $payable - $wallet;
		}
		if ($this->input->post('walletpay')) {
			$paywal = $this->input->post('walletpay');
			if ($paywal > $wallet) {
				$data['payableWal'] = $wallet;
				$data['payableAmount'] = $payable - $wallet;
			}else{
				$data['payableWal'] = $paywal;
				$data['payableAmount'] = $payable - $paywal;
			}
		}
		$con2['is_deleted'] = '0';
		$getAdCond['user_id'] = $this->session->userdata('loggedUser');
		$getAdCond['is_billing >='] = 1;
		$billingAds = $this->shop->getUserAddress($getAdCond);
		if (count($billingAds)) {
			$data['billing'] = $billingAds[0];
			if ($billingAds[0]->is_billing == 2) {
				$data['shipping'] = $billingAds[0];
			}else{
				$getAdCond['is_billing <>'] = 1;
				$shippingAds = $this->shop->getUserAddress($getAdCond);
				if (count($shippingAds)) {
					$data['shipping'] = $shippingAds[0];
				}
			}
		}
		$data['states'] = $this->shop->getStates($con2);
		$this->load->view('newcheckout',$data);
	}
	public function compare(){
		$this->load->view('compare');
	}
	
	public function ProductCategory($id,$name){
		if ($this->input->get('ab')) {
			$cond['price >='] = $this->input->get('ab');
		}
		if ($this->input->get('bl')) {
			$cond['price <='] = $this->input->get('bl');
		}
		if ($id == '') {
			$id = 0;
		}else{
			$result = $this->shop->getCategoryName($id);
			$data['catName'] = $result[0]->category_heading ? : $result[0]->category_name;
			$data['description'] = $result[0]->category_heading_desc ? : '';
			$data['static_block'] = $result[0]->static_block ? : '';
			$data['page_meta_title'] = $result[0]->category_title;
			$data['meta_keywords'] = $result[0]->meta_keyword;
			$data['meta_description'] = $result[0]->meta_description;

			$con['is_active'] = 1;
			$con['banner_type <>'] = 'full';
			$con['category_id'] = $id;
			$con['child_id'] = 0;
			$sele = 'banner_name, url, banner_img, banner_type';
			$data['icons'] = $this->UserModel->getCondSelectedData($con,$sele,'banner_mst');
		}
		$cond['status'] = 1;
		$cond['addoncategory_id'] = 0;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['rel.rel_id'] = $id;
		$cond['rel.priority'] = 1;
		$data['productCount'] = $this->UserModel->getProductCount($cond);
		if ($this->input->get('filt')) {
			$cond['sorts'] = $this->input->get('filt');
			$cond['wise'] = 'price';
		}
		$data['newProducts'] = $cond;
		$data['banners'] = $this->shop->getBanner($id);
		$data['OfferBan'] = $this->shop->getOfferBanner();
		$this->load->view('productlist',$data);
	}
	
	public function searchProduct(){
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
		$this->load->view('productlist',$data);
	}
	
	public function loadProductList(){
		$cond = json_decode($this->input->post('arr'),true);
		$sorting = 'asc';
		$wise = "(case when order_no is null then 9999999 else order_no end)";
		if (isset($cond['sorts']) && isset($cond['wise'])) {
			$sorting = $cond['sorts'];
			$wise = $cond['wise'];
			unset($cond['sorts']);
			unset($cond['wise']);
		}
		$page = $this->input->post('pageNo');
		$limit = 12;
		$data['newProducts'] = $this->UserModel->getProductList($cond,$limit,$page,$sorting,$wise);
		$this->load->view('includes/listProduct',$data);
	}
	
	public function ProductChildCategory($id,$name)
	{
		if ($id == '') {
			$id = 0;
		}else{
			$result = $this->shop->getChildName($id);
			$data['catName'] = $result[0]->child_heading ? : $result[0]->child_name;
			$data['description'] = $result[0]->heading_description ? : '';
			$data['page_meta_title'] = $result[0]->child_title;
			$data['meta_keywords'] = $result[0]->meta_keyword;
			$data['meta_description'] = $result[0]->meta_description;
			$data['static_block'] = $result[0]->static_block ? : '';
	
			$con['is_active'] = 1;
			$con['banner_type <>'] = 'full';
			$con['child_id'] = $id;
			$sele = 'banner_name, url, banner_img, banner_type';
			$data['icons'] = $this->UserModel->getCondSelectedData($con,$sele,'banner_mst');
		}
		
		if ($this->input->get('ab')) {
			$cond['price >='] = $this->input->get('ab');
		}
		if ($this->input->get('bl')) {
			$cond['price <='] = $this->input->get('bl');
		}
		
		$cond['status'] = 1;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$temp = $this->shop->getCatofChild($result[0]->subcategory_id);
		$cond['rel.rel_id'] = $id;
		$cond['rel.priority'] = 3;
		$cond['addoncategory_id'] = 0;
		$data['productCount'] = $this->UserModel->getProductCount($cond);
		
		if ($this->input->get('filt')) {
			$cond['sorts'] = $this->input->get('filt');
			$cond['wise'] = 'price';
		}
		$data['newProducts'] = $cond;
		$data['banners'] = $this->shop->getBanner($temp[0]->category_id);
		$data['OfferBan'] = $this->shop->getOfferBanner();
		$this->load->view('productlist',$data);
	}
	
	public function productDetail($id,$name = '')
	{
		$data['product'] = $this->shop->getProductDetail($id);
		if (count($data['product']) == 0) {
			redirect(base_url('404'));
		}
		$cond['product_id !='] = $id;
		$cond['status'] = 1;
		$cond['addoncategory_id'] = 0;
		$data['related'] = $this->shop->getRandomProducts($cond,6);
		$r['product_id'] = $id;
		$data['myReview'] = array();
		if (isset($_SESSION['loggedUser'])) {
			$r['user_id'] = $_SESSION['loggedUser'];
			$data['myReview'] = $this->shop->getReviews($r,1);
			$rev['user_id !='] = $_SESSION['loggedUser'];
		}
		
		$rev['product_id'] = $id;
		$data['customerReview'] = $this->shop->getReviews($rev,3);
		$charge['product_id'] = $id;
		$charge['is_opt'] = 0;
		$data['chargeList'] = $this->shop->getCharges($charge);
		$charge['is_opt'] = 1;
		$data['sizeList'] = $this->shop->getCharges($charge);
		$this->load->view('productDetail',$data);
	}
	
	public function cakeDetail(){
		$this->load->view('cakedetails');
	}
	
	public function myCart(){
		if (isset($_SESSION['loggedUser']) && isset($_SESSION['myCartData']) && count($_SESSION['myCartData']) != 0 ) {
			$this->UserModel->batchInsertData($_SESSION['myCartData'],'cart_mst');
		}
		$this->load->view('shoppingcart');
	}
	
	public function wishlist(){
		checkUserExclusive();
		$data['wishlist'] = array();
		if (isset($_SESSION['loggedUser'])) {
			$data['wishlist'] = $this->shop->getWishlist();
		}
		$this->load->view('wishlist',$data);
	}
	
	public function walletTransaction(){
		$data['walletTxn'] = array();
		if (isset($_SESSION['loggedUser'])) {
			$data['walletTxn'] = $this->shop->getWalletTransaction();
		}
		else{
			redirect(base_url('login'));
		}
		$this->load->view('walletTransaction',$data);
	}
	
	public function insertReview(){
		$stars = $this->input->post('ratings[1]');
		$data['reviewer_name'] = $this->input->post('nickname');
		$data['review_title'] = $this->input->post('title');
		$data['review_desc'] = $this->input->post('detail');
		if (in_array('', $data)) {
			echo "<p style='color:red'>All Fields are necessary!</p>";
			exit();
		}
		
		if (!isset($_SESSION['loggedUser'])) {
			echo "<p style='color:red'>You must Login before adding your Review!</p>";
			exit();
		}
		$cond['user_id'] = $_SESSION['loggedUser'];
		$cond['product_id'] = $this->input->post('validate_rating');
		$check = $this->shop->checkReview($cond);
		if (count($check) != 0) {
			echo "<p style='color:red'>You can review only Once!</p>";
			exit();
		}
		
		$data['user_id'] = $cond['user_id'];
		$data['product_id'] = $cond['product_id'];
		$data['review_stars'] = $stars - 10;
		$result = $this->shop->insertReview($data);
		if ($result) {
			echo "<p style='color:green'>Thank you for your Valuable Review!!</p>";
		}else{
			echo "<p style='color:red'>Sorry, Somthing went wrong!!</p>";
		}
	}
	
	function addCompareProduct(){
		$id = $this->input->post('product_id');
		if($id == 0){
			unset($_SESSION['compareProduct']);
		}
		$check = $this->shop->checkProduct($id);
		if (count($check) != 0) {
			if (isset($_SESSION['compareProduct']) && ($key = array_search($id, $_SESSION['compareProduct'])) !== false) {
				unset($_SESSION['compareProduct'][$key]);
				echo "Product is removed from Compare List!!";
			}else{
				$_SESSION['compareProduct'][] = $id;
				echo "Product is added to Compare List!!";
			}
		}else{
			echo "Compare List is now empty!";
		}
	}
	
	function getCompareBox(){
		$this->load->view('includes/comparebox');
	}
	
	function addWishlistProduct(){
		if (!isset($_SESSION['loggedUser'])) {
			echo "You must Login before adding product in Wishlist!";
			exit();
		}
		$id = $this->input->post('product_id');
		$check = $this->shop->checkProduct($id);
		if (count($check) != 0) {
			$cond['user_id'] = $_SESSION['loggedUser'];
			$cond['product_id'] = $id;
			$result = $this->shop->checkWish($cond);
			if (count($result) != 0) {
				if ($result[0]->is_active) {
					$data['is_active'] = 0;
					$result = $this->shop->updateWish($cond,$data);
					if ($result) {
						echo "Product is removed from your Wishlist!!";
						exit();
					}
				}else{
					$data['is_active'] = 1;
					$result = $this->shop->updateWish($cond,$data);
					if ($result) {
						echo "Product is Added to your Wishlist!!";
						exit();
					}
				}
			}else {
				$cond['is_active'] = 1;
				$result = $this->shop->insertWish($cond);
				if ($result) {
					echo "Product is Added to your Wishlist!!";
					exit();
				}
			}
		}else{
			echo "You are not Allowed!";
		}
	}
	
	function quickViewProduct()
	{
		$id = $this->input->post('product_id');
		$data['product'] = $this->shop->getProductDetail($id);
		$this->load->view('includes/quickview',$data);
	}
	
	function getPriceBox()
	{
		$id = $this->input->post('product_id');
		$qty = $this->input->post('qty');
		$price = $this->shop->getProductPrice($id);
		if (isset($_POST['extra'])) {
			$extra = explode(',', $this->input->post('extra'));
			$ePrice = addedPrice($price[0]->price,$extra);
			$data['price'] = $qty*$ePrice;
			$data['sPrice'] = $qty*(offeredPrice($ePrice,$id,$price[0]->child_id,$price[0]->category_id));
		}else{
			$data['price'] = $qty*$price[0]->price;
			$data['sPrice'] = $qty*offeredPrice($price[0]->price,$id,$price[0]->child_id,$price[0]->category_id);
		}
		$this->load->view('includes/pricebox',$data);
	}
	
	function getTimeSlots()
	{
		$date = $this->input->post('date');
		$data['time_gap'] = $this->input->post('productSpe');
		$co['rate_id'] = $this->input->post('shiptype');
		$response = $this->shop->getShippingRates($co);
		$cond['ship_id'] = $response[0]->shipping_id;
		$data['date'] = $date;
		$data['timeSlots'] = $this->shop->getTimeSlots($cond);
		$this->load->view('includes/timeSlots',$data);
	}
	
	function getShipRates()
	{
		$cond['city_id'] = $this->input->post('city_id');
		if ($this->input->post('courier') == 1) {
			$cond['shipping_rate'] = 0;
		}
		$data['shiprates'] = $this->shop->getShippingRates($cond);
		$this->load->view('includes/shipRates',$data);
	}
	
	function addCartProduct()
	{
		$return_cart_id = 0;
		$config = array(
			'upload_path'   => realpath(FOLDER_ASSETS_PERSONALIZEUPLOAD),
			'allowed_types' => 'jpg|png|pdf|word|docx|doc',
			'max_size'      => '2000',
			'encrypt_name'  => true,
		);
		if (isset($_FILES['personalize_img']) && !@in_array(4, $_FILES['personalize_img']['error'])) {
			$img = [];
			$this->load->library('upload',$config);
			for ($i=0; $i < count($_FILES['personalize_img']['name']); $i++) { 
				$_FILES['userfile']['name']= $_FILES['personalize_img']['name'][$i];
				$_FILES['userfile']['type']= $_FILES['personalize_img']['type'][$i];
				$_FILES['userfile']['tmp_name']= $_FILES['personalize_img']['tmp_name'][$i];
				$_FILES['userfile']['error']= $_FILES['personalize_img']['error'][$i];
				$_FILES['userfile']['size']= $_FILES['personalize_img']['size'][$i];
				if ($this->upload->do_upload('userfile')) {
					$img[] = $this->upload->data('file_name');
				}else{
					$r['err'] = $this->upload->display_errors();
					echo json_encode($r);
					exit();
				}
			}
		}
		if (!isset($_SESSION['loggedUser'])) {
			$tempCartData = $this->input->post();
			if (isset($img) && count($img) > 0) {
				$tempCartData['personalize_img'] = json_encode($img);
			}
			$this->newCart($tempCartData);
			$r['cart_id'] = $tempCartData['product_id'];
			$r['success'] = 'Product is added to your Cart!';
			echo json_encode($r);
			exit();
		}
		
		$date = $this->input->post('ddate');
		$shipR['rate_id'] = $this->input->post('shipping');
		$response = $this->shop->getShippingRates($shipR);
		$cond['ship_id'] = $response[0]->shipping_id;
		$cond['timing_id'] = $this->input->post('timing');
		$timeSlot = $this->shop->getTimeSlots($cond);
		$start_date = strtotime($date.' '.@$timeSlot[0]->start_time);
		$end_date = strtotime($date.' '.@$timeSlot[0]->end_time);
		$data['product_id'] = $this->input->post('product_id');
		$data['user_id'] = $_SESSION['loggedUser'];
		$check = $this->shop->checkCart($data);
		$data['personalize_img'] = json_encode(@$img);
		$data['ship_id'] = $shipR['rate_id'];
		$data['start_date'] = date('Y-m-d H:i:s', $start_date);
		$data['end_date'] = date('Y-m-d H:i:s', $end_date);
		$id = $this->input->post('product_id');
		$data['qty'] = $this->input->post('qty');
		$data['city_id'] = $this->input->post('city');
		$data['pincode'] = $this->input->post('pincode');
		$data['extra'] = $this->input->post('extra');
		
		if (count($check) != 0) {
			$return_cart_id = $cc['cart_id'] = $check[0]->cart_id;
			$result = $this->shop->updateCart($cc,$data);
		}else{
			$result = $this->shop->insertCart($data);
			$return_cart_id = $this->db->insert_id();
		}
		
		if ($result) {
			$r['success'] = 'Product is added to your Cart!';
			$r['cart_id'] = $return_cart_id;
		}else{
			$r['err'] = 'Failed to add in cart!';
		}
		echo json_encode($r);
		exit();
	}
	
	function resumeCart(){
		$tempCartData = $_SESSION['myCartData'];
		foreach ($tempCartData as $key => $cartData) {
			$data['product_id'] = $key;
			$data['user_id'] = $_SESSION['loggedUser'];
			$check = $this->shop->checkCart($data);
			$data['ship_id'] = $cartData['ship_id'];
			$data['end_date'] = date('Y-m-d H:i:s', strtotime($cartData['end_date']));
			$data['start_date'] = date('Y-m-d H:i:s', strtotime($cartData['start_date']));
			$data['qty'] = $cartData['qty'];
			$data['city_id'] = $cartData['city_id'];
			$data['pincode'] = $cartData['pincode'];
			$data['coupon_code'] = $cartData['coupon_code'];
			if (isset($cartData['extra'])) {
				$data['extra'] = $cartData['extra'];
			}
			if (isset($cartData['personalize_img'])) {
				$data['personalize_img'] = $cartData['personalize_img'];
			}
			if (count($check) != 0) {
				$cc['cart_id'] = $check[0]->cart_id;
				$result = $this->shop->updateCart($cc,$data);
			}else{
				$result = $this->shop->insertCart($data);
			}
			unset($_SESSION['myCartData'][$key]);
		}
		unset($_SESSION['myCartData']);
		if ($result) {
			$this->session->set_flashdata('message', 'Product is added to your Cart!');
		}else{
			$this->session->set_flashdata('message', 'Failed to add in cart!');
		}
		
		redirect(base_url('mycart'));
	}
	
	function clearCart(){
		if (isset($_SESSION['loggedUser'])) {
			$cond['user_id'] = $_SESSION['loggedUser'];
			$result = $this->shop->clearCart($cond);
			if ($result) {
				echo "Product has been removed from cart!";
			}else{
				echo "Somthing went Wrong!!";
			}
		}elseif(isset($_SESSION['myCartData'])){
			unset($_SESSION['myCartData']);
			echo "Cart Empty Successfully!";
		}else{
			echo "You Must be Logged In for this Action!";
		}
	}
	
	function removeCart(){
		if (isset($_SESSION['loggedUser'])) {
			$cond['user_id'] = $_SESSION['loggedUser'];
			$cond['product_id'] = $this->input->post('product_id');
			$cartData = $this->shop->checkCart($cond);
			if (count($cartData)) {
				$personalize_img = $cartData[0]->personalize_img;
				if ($personalize_img) {
					$personalize_array = json_decode($personalize_img);
					for ($i=0; $i < count($personalize_array); $i++) { 
						if (file_exists(FOLDER_ASSETS_PERSONALIZEUPLOAD.$personalize_array[$i])) {
							unlink(FOLDER_ASSETS_PERSONALIZEUPLOAD.$personalize_array[$i]);
						}
					}
				}
			}
			$result = $this->shop->clearCart($cond);
			if ($result) {
				echo "Product has been removed from cart!";
			}else{
				echo "Somthing went Wrong!!";
			}
		}elseif(isset($_SESSION['myCartData'])){
			$p_id = $this->input->post('product_id');
			if (isset($_SESSION['myCartData'][$p_id])) {
				if (@$_SESSION['myCartData'][$p_id]['personalize_img']) {
					$personalize_img = $_SESSION['myCartData'][$p_id]['personalize_img'];
					if ($personalize_img) {
						$personalize_array = json_decode($personalize_img);
						for ($i=0; $i < count($personalize_array); $i++) { 
							if (file_exists(FOLDER_ASSETS_PERSONALIZEUPLOAD.$personalize_array[$i])) {
								unlink(FOLDER_ASSETS_PERSONALIZEUPLOAD.$personalize_array[$i]);
							}
						}
					}
				}
				unset($_SESSION['myCartData'][$p_id]);
				echo "Product has been removed from cart!";
			}else{
				echo "Invalid Entry!!";
			}
		}else{
			echo "You Must be Logged In for this Action!";
		}
	}
	
	function saveAddress(){
		$data['name'] =$this->input->post('first_name');
		$data['last_name'] =$this->input->post('last_name');
		$data['address_1'] =$this->input->post('address_1');
		$data['city'] =$this->input->post('city');
		$data['state'] =$this->input->post('state');
		$data['pin_code'] =$this->input->post('pin_code');
		$data['contact'] =$this->input->post('contact');
		$data['user_id'] = $_SESSION['loggedUser'];
		$data['email'] = $this->input->post('email');
		$add_type =$this->input->post('add_type');
		if (in_array('', $data)) {
			$r['err'] = "All Fields are Necessary";
			echo json_encode($r);
			exit();
		}
		$data['address_2'] =$this->input->post('address_2');
		if ($add_type == 1) {
			$data['is_billing'] = 2;
			if ($this->input->post('address_id')) {
				$cc['address_id'] = $this->input->post('address_id');
				$result = $this->shop->updateUserAddress($cc,$data);
				$r['address'] = $cc['address_id'];
			}else{
				$result = $this->shop->insertUserAddress($data);
				$r['address'] = $this->db->insert_id();
			}
			if ($result) {
				$r['success'] = "Address has been Added!";
			}else{
				$r['err'] = "Failed to Add";
			}
		}else{
			$data['is_billing'] = 1;
			if ($this->input->post('address_id')) {
				$cc['address_id'] = $this->input->post('address_id');
				$result = $this->shop->updateUserAddress($cc,$data);
				$r['address'] = $cc['address_id'];
			}else{
				$result = $this->shop->insertUserAddress($data);
				$r['address'] = $this->db->insert_id();
			}
			if ($result) {
				$r['success1'] = "Billing address has been added!!";
				
			}else{
				$r['err'] = "Failed to Add";
			}
		}
		echo json_encode($r);
	}
	
	function saveShipAddress(){
		$data['name'] =$this->input->post('first_name');
		$data['last_name'] =$this->input->post('last_name');
		$data['address_1'] =$this->input->post('address_1');
		$data['city'] =$this->input->post('city');
		$data['state'] =$this->input->post('state');
		$data['pin_code'] =$this->input->post('pin_code');
		$data['contact'] =$this->input->post('contact');
		$data['user_id'] = $_SESSION['loggedUser'];
		$data['email'] = $this->input->post('email');
		if (in_array('', $data)) {
			$r['err'] = "All Fields are Necessary";
			echo json_encode($r);
			exit();
		}
		
		$data['address_2'] =$this->input->post('address_2');
		$data['is_billing'] = 0;
		if ($this->input->post('address_id')) {
			$cc['address_id'] = $this->input->post('address_id');
			$result = $this->shop->updateUserAddress($cc,$data);
			$r['address'] = $cc['address_id'];
		}else{
			$result = $this->shop->insertUserAddress($data);
			$r['address'] = $this->db->insert_id();
		}
		if ($result) {
			$r['success'] = "Shipping address has been added!!";
		}else{
			$r['err'] = "Failed to Add";
		}
		echo json_encode($r);
	}
	
	function getBillAddress(){
		$con2['is_deleted'] = '0';
		$data['states'] = $this->shop->getStates($con2);
		$cond['address_id'] = $this->input->post('address');
		$uid = $_SESSION['loggedUser'];
		
		if ($cond['address_id'] != '') {
			$cond['user_id'] = $uid;
			$data['BillAdd'] = $this->shop->getUserAddress($cond);
		}else{
			$data['user'] = $this->shop->getUserDetail($uid);		
		}
		
		$this->load->view('includes/newAddForm',$data);
	}
	
	function getShipAddress(){
		$con2['is_deleted'] = '0';
		$data['states'] = $this->shop->getStates($con2);
		$cond['address_id'] = $this->input->post('address');
		$uid = $_SESSION['loggedUser'];
		
		if ($cond['address_id'] != '') {
			$cond['user_id'] = $uid;
			$data['ShipAdd'] = $this->shop->getUserAddress($cond);
		}else{
			$data['user1'] = $this->shop->getUserDetail($uid);		
		}
		
		$this->load->view('includes/newAddForm',$data);
	}
	
	function getShipA(){
		$cond['address_id'] = $this->input->post('address_id');
		$result = $this->shop->getUserAddress($cond);
		echo json_encode($result);
	}
	
	function getBillA(){
		$cond['address_id'] = $this->input->post('address_id');
		$result = $this->shop->getUserAddress($cond);
		echo json_encode($result);
	}
	
	function confirmOrder(){
		$this->load->helper('payment'); 
		if ($this->input->post('place_order')) {
			$fillable = ['name','last_name','contact','email','address_1','address_2','pin_code','city','state'];
			$sameAdd = $this->input->post('sameAdd');
			$billing = $this->input->post('billing');
			$pay_method = $this->input->post('payment_method');
			for ($i=0; $i < count($fillable); $i++) { 
				$address_data[$fillable[$i]] = $billing[$fillable[$i]];
			}
			if (@$billing['hdnID']) {
				$address_cond['address_id'] = $billing['hdnID'];
				$address_data['is_billing'] = @$sameAdd ? 1 : 2;
				$address_cond['user_id'] = $this->session->userdata('loggedUser');
				$address_q = $this->shop->updateUserAddress($address_cond,$address_data);
				$shipAdd = $billAdd = $address_cond['address_id'];
			}else{
				$address_data['is_billing'] = @$sameAdd ? 1 : 2;
				$address_data['user_id'] = $this->session->userdata('loggedUser');
				$address_q = $this->shop->insertUserAddress($address_data);
				$shipAdd = $billAdd = $this->db->insert_id();
			}
			if (!@$address_q) {
				$this->session->set_flashdata('txnError','Failed to Insert Address!');
				redirect(base_url('checkout'));
			}
			if ($sameAdd) {
				$shipping = $this->input->post('shipping');
				$address_data['is_billing'] = 0;
				for ($i=0; $i < count($fillable); $i++) { 
					$ship_data[$fillable[$i]] = $shipping[$fillable[$i]];
				}
				if (@$shipping['hdnID']) {
					$ship_cond['address_id'] = $shipping['hdnID'];
					$ship_cond['user_id'] = $this->session->userdata('loggedUser');
					$address_q = $this->shop->updateUserAddress($ship_cond,$ship_data);
					$shipAdd = $ship_cond['address_id'];
				}else{
					$ship_data['user_id'] = $this->session->userdata('loggedUser');
					$address_q = $this->shop->insertUserAddress($ship_data);
					$shipAdd = $this->db->insert_id();
				}
				if (!@$address_q) {
					$this->session->set_flashdata('txnError','Failed to Insert Address!');
					redirect(base_url('checkout'));
				}
			} 
			$walletpay = $this->input->post('walletpay');
			$cardMSG = $this->input->post('msg_card');
			if (payForOrder($walletpay,$billAdd,$shipAdd,$cardMSG, $pay_method)) {
				goto skipPayValidation;
			}else{
				die();
			}
		}
		validatePayment($this->input->post());
		skipPayValidation:
		$cart = getCartData();
		$data['txn_id'] = $this->input->post('txnid');
		$data['payment_detail'] = json_encode($this->input->post());
		$data['billing_ad'] = $this->input->post('udf1');
		$data['shipping_ad'] = $this->input->post('udf2');
		$data['msg_card'] = $this->input->post('udf3');
		$data['amount'] = getShippingTotal() + getCartTotal();
		$data['ship_price'] = getShippingTotal();
		$data['payment_status'] = 1;
		$data['user'] = $CashbackData['user_id'] = $_SESSION['loggedUser'];
		$result = $this->shop->insertOrder($data);
		
		if ($result) {
			$batch['order_id'] = $this->db->insert_id();
			foreach ($cart as $crt) {
				$batch['product_id'] = $crt['product_id'];
				$batch['qty'] = $crt['qty'];
				$batch['price'] = $crt['price'];
				$batch['ship_from'] = $crt['start_date'];
				$batch['ship_till'] = $crt['end_date'];
				$batch['extra'] = $crt['extra'];
				$batch['ship_id'] = $crt['ship_id'];
				$batch['personalize_img'] = $crt['personalize_img'];
				$batch['ship_rate'] = getShippingRate($crt['ship_id']);
				$batch['city_id'] = $crt['city_id'];
				$CashbackData['cashback_coupon'] = $crt['coupon_code'];
				$CashbackData['trn_type'] = 'cashback';
				$CashbackData['amount'] = getCashBackSingle($crt['cart_id']);
				$CashbackData['payment_type'] = 0;
				$this->shop->insertOrderDetail($batch);
				if ($CashbackData['amount'] > 0) {
					$CashbackData['order_id'] = $this->db->insert_id();
					$this->shop->insertCashback($CashbackData);
				}
			}
			$CashbackData['payment_type'] = 1;
			$CashbackData['cashback_coupon'] = '';
			$CashbackData['trn_type'] = 'paid';
			$CashbackData['amount'] = $this->input->post('udf4');
			if ($CashbackData['amount'] > 0) {
				$this->shop->insertCashback($CashbackData);
			}
			$clear['user_id'] = $data['user'];
			$this->shop->clearCart($clear);
			paymentOrderMailForUser($batch['order_id']);
			
			$this->session->set_flashdata('OrderData',$batch['order_id']);
			redirect(base_url('thankyou'));
		}
	}
	
	function applyCoupon(){
		$coupon_code = $this->input->post('coupon_code');
		$CartCondition['cart_id'] = $this->input->post('id');
		$selectCoupon = 'offer_id';
		$response = $this->shop->checkCoupon($coupon_code,$selectCoupon);
		if (!isset($_SESSION['loggedUser'])) {
			$productData = $this->shop->getProductDetail($CartCondition['cart_id']);
			if ($coupon_code == '') {
				$_SESSION['myCartData'][$CartCondition['cart_id']]['coupon_code'] = $coupon_code;
				echo getCashBack();
				die();
			}
		}else{
			$CartCondition['user_id'] = $_SESSION['loggedUser'];
			if ($coupon_code == '') {
				$cartData['coupon_code'] = '';
				$this->shop->updateCart($CartCondition,$cartData);
				echo getCashBack();
				exit();
			}
			$productData = $this->shop->cartProduct($CartCondition['cart_id']);
		}
		
		if (!empty($response) && !empty($productData)) {
			$response1 = newCouponCheck($response[0]->offer_id,$productData[0]->product_id);
			if ($response1) {
				$newcd['coupon_code'] = $coupon_code;
				if (!isset($_SESSION['loggedUser'])) {
					$_SESSION['myCartData'][$CartCondition['cart_id']]['coupon_code'] = $coupon_code;
				}
				$response2 = $this->shop->updateCart($CartCondition,$newcd);
				if ($response2) {
					$output['success'] = 'Coupon Applied';
				}else{
					$output['err'] = 'Coupon is unavailable!';
				}
			}else {
				$output['err'] = 'Coupon is unavailable!';
			}
		}else{
			$output['err'] = 'Coupon is unavailable!';
		}
		$output['cashback'] = getCashBack();
		echo json_encode($output);
	}
	
	function getAddonsProducts(){
		$this->load->model('userModel');
		$select = "addoncategory_id, addoncategory_name";
		$con['is_active'] = 1;
		$categoryArr = $this->userModel->getCondSelectedData($con,$select,'addoncategory_mst');
		$pincode = $this->input->post('pincode');
		$city_id = $this->input->post('city_id');
		$count = 0;
		if($categoryArr){
			$categoryArr = array_map(function($data) use($pincode, $city_id, $count){
				$select = "product_id,product_title,price,product_img";
				$cond['addoncategory_id'] = $data->addoncategory_id;
				$cond['status'] = 1;
				if($city_id) {
					$cond['avail_at LIKE'] = "%\"{$city_id}\"%";
				}
				$cond['deleted_at'] = '0000-00-00 00:00:00';
				if($pincode) {
					$cond['pincode_block NOT LIKE'] = "%{$pincode},%";
				}
				$data->dataArray = $this->userModel->getCondSelectedData($cond,$select,'product_mst');
				return $data;
			},$categoryArr );
		}
		
		$data['categoryArr'] = $categoryArr;
		return $this->load->view('includes/addonProducts', $data);
	}
	
	function newCart($cartData){
		$date = $cartData['ddate'];
		$shipR['rate_id'] = $cartData['shipping'];
		$response = $this->shop->getShippingRates($shipR);
		$cond['ship_id'] = $response[0]->shipping_id;
		$cond['timing_id'] = $cartData['timing'];
		$timeSlot = $this->shop->getTimeSlots($cond);
		$start_date = strtotime($date.' '.$timeSlot[0]->start_time);
		$end_date = strtotime($date.' '.$timeSlot[0]->end_time);
		$data['product_id'] = $cartData['product_id'];
		$data['ship_id'] = $shipR['rate_id'];
		$data['start_date'] = date('Y-m-d H:i:s', $start_date);
		$data['end_date'] = date('Y-m-d H:i:s', $end_date);
		$id = $cartData['product_id'];
		$data['qty'] = $cartData['qty'];
		$data['city_id'] = $cartData['city'];
		$data['extra'] = @$cartData['extra'];
		$data['pincode'] = $cartData['pincode'];
		if (isset($cartData['personalize_img'])) {
			$data['personalize_img'] = $cartData['personalize_img'];
		}
		$_SESSION['myCartData'][$id] = $data;
	}
	
	function GetCityByPincode(){
		$pincode = $this->input->post('pincode');
		$cityData=  $this->shop->GetCityByPincode($pincode);
		$city_id = @$cityData[0]->city_id;
		if(count($cityData)){
			$response['success'] = $city_id;
		}
		else{
			$response['fail'] = 'Invalid Pincode !';
		}
		echo json_encode($response); 
	}
	
	function addoncart() {
		$addon_product_id = $this->input->post('product_id');
		$cart_id = $this->input->post('cart_id');
		if(!is_array($addon_product_id) || !count($addon_product_id) ){
			$this->session->set_flashdata('error_msg', "Not selected any Addon product...");
			goto redirectWithMessage;
		}
		
		if($this->session->userdata('loggedUser')) {
			$cond['cart_id'] = $cart_id;
			$cond['user_id'] = $this->session->userdata('loggedUser');
			$select = 'start_date,end_date, ship_id, city_id, pincode, user_id';
			$cartData = $this->UserModel->getCondSelectedData( $cond, $select, 'cart_mst');
			// print_r($cartData); die;
			
			if(!count($cartData)) {
				$this->session->set_flashdata('error_msg', "Invalid Addon Selected!");
				goto redirectWithMessage;
			}
			$cartData = (array) $cartData[0];
			$batch_insert = array_map(function($ar) use ($cartData){
				$b = [];
				$b['product_id'] = $ar;
				$b['user_id'] = $cartData['user_id'];
				$b['qty'] = 1;
				$b['start_date'] = $cartData['start_date'];
				$b['end_date'] = $cartData['end_date'];
				$b['ship_id'] = $cartData['ship_id'];
				$b['city_id'] = $cartData['city_id'];
				$b['pincode'] = $cartData['pincode'];
				return $b;
			}, $addon_product_id);
			// print_r($batch_insert); die;
			$addonInsert = $this->UserModel->batchInsertData($batch_insert, 'cart_mst' );
			if(!$addonInsert){
				$this->session->set_flashdata('error_msg', "Something want wrong...");
				goto redirectWithMessage;
			}
			$this->session->set_flashdata('success_msg', "Your Product added to your cart.");
			goto redirectWithMessage;
		} else if($this->session->userdata('myCartData')) {
			$cartData = $this->session->userdata('myCartData');
			if(!array_key_exists($cart_id, $cartData)) {
				$this->session->set_flashdata('error_msg', "Invalid Addon Selected!");
				goto redirectWithMessage;
			}
			$cartData = $cartData[$cart_id];
			$b = [];
			$b['start_date'] = $cartData['start_date'];
			$b['end_date'] = $cartData['end_date'];
			$b['ship_id'] = $cartData['ship_id'];
			$b['city_id'] = $cartData['city_id'];
			$b['qty'] = 1;
			$b['pincode'] = $cartData['pincode'];
			foreach($addon_product_id as $pd){
				$b['product_id'] = $pd;
				$_SESSION['myCartData'][$pd] = $b;
			}	
			$this->session->set_flashdata('success_msg', "Your Product added to your cart.");
			goto redirectWithMessage;	
		}

		$this->session->set_flashdata('error_msg', "Your Cart is Empty!");
		redirectWithMessage:
		$this->load->library('user_agent');
		$ref_url = $this->agent->referrer();
		$ref_url = explode('?', $ref_url);
		$ref_url = $ref_url[0];
		redirect($ref_url);
	}
}