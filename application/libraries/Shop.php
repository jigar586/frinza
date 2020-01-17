<?php
class Shop
{
	function __construct()
	{
	    $this->CI =& get_instance();
	    $this->CI->load->model('UserModel');
	    $this->CI->load->model('BlogModel');
	}
	function getUserDetail($id)
	{
		$this->tableName = 'user_mst';
		$cond['uid'] = $id;
		$select = 'user_email,first_name,last_name,user_contact';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getUserAddress($cond)
	{
		$this->tableName = 'address_mst';
		$select = 'address_id,user_id,name,last_name,contact,email,address_1,address_2,pin_code,city,state,is_billing';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,0,$this->tableName);
	}
	function updateUserAddress($cond,$data)
	{
		$this->tableName = 'address_mst';
		return $this->CI->UserModel->updateData($cond,$data,$this->tableName);
	}
	function updateUser($cond,$data)
	{
		$this->tableName = 'user_mst';
		return $this->CI->UserModel->updateData($cond,$data,$this->tableName);
	}
	function getStates($cond)
	{
		$this->tableName = 'state_mst';
		$select = 'state_id,state_name';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function insertUserAddress($data)
	{
		$this->tableName = 'address_mst';
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function getBanner($id, $is_child=0)
	{
		$this->tableName='banner_mst';
		if($is_child) {
			$cond['category_id'] = 0;
			$cond['child_id'] = $id;
		} else{
			$cond['category_id'] = $id;
			$cond['child_id'] = 0;
		}
		
		$cond['is_active'] = 1;
		$cond['banner_type'] = 'full';
		$select = 'banner_img, url';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function insertOrder($data)
	{
		$this->tableName = 'order_mst';
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function insertOrderDetail($data)
	{
		$this->tableName = 'order_submst';
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function getMyOrders($uid)
	{
		$cond['user'] = $uid;
		return $this->CI->UserModel->getMyOrders($cond);
	}
	function getOfferBanner()
	{
		$this->tableName = 'offer_mst';
		$cond['status'] = 1;
		$cond['banner !='] = '';
		$cond['start_date <='] = date('Y-m-d');
		$cond['end_date >='] = date('Y-m-d');
		$select = 'offer_name,offer_type,amount,banner,is_coupon';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getOffer()
	{
		$this->tableName = 'offer_mst';
		$cond['status'] = 1;
		$cond['start_date <='] = date('Y-m-d');
		$cond['end_date >='] = date('Y-m-d');
		$select = 'offer_name,offer_type,amount,banner,is_coupon';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCategory()
	{
		$this->tableName = 'category_mst';
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['is_active'] = 1;
		$select = 'category_id,category_name,IFNULL(category_heading, category_name) as category_heading,category_desc';
		return $this->CI->UserModel->getLatestUpdatedData($cond,$select,0,$this->tableName);
	}
	function getSubCategory($id)
	{
		$this->tableName = 'subcategory_mst';
		$cond['category_id'] = $id;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['is_active'] = 1;
		$select = 'subcategory_id,subcategory_name';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getChildCategory($id, $is_display = 0)
	{
		$this->tableName = 'childcategory_mst';
		$cond['subcategory_id'] = $id;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['is_active'] = 1;
		$extraFilters = array();
		if($is_display){
			$cond['is_display'] = 1;
		}
		$extraFilters['result_type'] = 'object';
		$select = 'child_id,child_name,IFNULL(child_heading, child_name) as child_heading';
		return $this->CI->UserModel->getSelectWithJoinData($cond,$this->tableName, [],$select, $extraFilters);
	}
	
	function getHiddenChildCount($id)
	{
		$this->tableName = 'childcategory_mst';
		$cond['subcategory_id'] = $id;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['is_active'] = 1;
		$cond['is_display'] = 0;
		$select = 'count(*) as count';
		$extraFilters['result_type'] = 'object';
		$count = $this->CI->UserModel->getSelectWithJoinData($cond,$this->tableName, [],$select, $extraFilters);
		return $count[0]->count;

	}
	function getChildName($id)
	{
		$this->tableName = 'childcategory_mst';
		$cond['child_id'] = $id;
		$select = 'child_name,is_random,subcategory_id,child_title,IFNULL(child_heading, child_name) as child_heading,heading_description, meta_keyword, meta_description, static_block';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,1,$this->tableName);
	}
	function getCatofChild($id)
	{
		$this->tableName = 'subcategory_mst';
		$cond['subcategory_id'] = $id;
		$select = 'category_id';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,1,$this->tableName);
	}
	function getCategoryName($id)
	{
		$this->tableName = 'category_mst';
		$cond['category_id'] = $id;
		$select = 'category_name,category_title,category_heading,category_heading_desc, meta_keyword, meta_description, static_block';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,1,$this->tableName);
	}
	function getCityName($id)
	{
		$this->tableName = 'city_mst';
		$cond['city_id'] = $id;
		$cond['is_deleted'] = 0;
		$select = 'city_name';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getProductCount($cond)
	{
		$this->tableName = 'product_mst';
		$select = 'COUNT(product_id) as count';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getNewProduct($cond,$limit)
	{
		$this->tableName = 'product_mst';
		$select= 'product_id,category_id,child_id,product_title,price,product_img,product_desc,created_at,addoncategory_id,tax_id';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,$limit,$this->tableName);
	}
	function checkProduct($id)
	{
		$this->tableName = 'product_mst';
		$cond['product_id'] = $id;
		$cond['status'] = 1;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'product_id,product_title';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,1,$this->tableName);
	}
	function getRandomProducts($cond,$limit)
	{
		$this->tableName = 'product_mst';
		$select= 'product_id,category_id,child_id,product_title,price,product_img,created_at';
		return $this->CI->UserModel->getRandomLimitedData($cond,$select,$limit,$this->tableName);
	}
	function getProductDetail($id)
	{
		$this->tableName = 'product_mst';
		$cond['product_id'] = $id;
		$cond['status'] = 1;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'product_id,product_title,category_id,child_id,product_img,price,order_till,sku_code,avail_at,product_desc,created_at,is_personalize,is_courier, meta_keyword, meta_description, meta_title, pincode_block';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,1,$this->tableName);
	}
	function getAppliedOffer($prior,$id)
	{
		$cond['omst.status'] = 1;
		$cond['omst.is_coupon'] = 0;
		$cond['omst.start_date <='] = date('Y-m-d');
		$cond['omst.end_date >='] = date('Y-m-d');
		$cond['osmst.priority'] = $prior;
		$cond['osmst.applied_on'] = $id;
		$select = 'omst.offer_type, omst.amount';
		return $this->CI->UserModel->getCurrentOffer($select,$cond);
	}
	function checkReview($cond)
	{
		$select = 'review_id';
		$this->tableName = 'review_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function insertReview($data)
	{
		$this->tableName = 'review_mst';
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function getReviews($cond,$limit)
	{
		$select = 'review_id,review_title,review_desc,reviewer_name,review_stars,created_at';
		$this->tableName = 'review_mst';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,$limit,$this->tableName);
	}
	function getAvgReview($cond)
	{
		$select = 'AVG(review_stars) as avg';
		$this->tableName = 'review_mst';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,0,$this->tableName);
	}
	function getReviewCount($cond)
	{
		$select = 'review_id';
		$this->tableName = 'review_mst';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,0,$this->tableName);
	}
	function checkWish($cond)
	{
		$select = 'wish_id,is_active';
		$this->tableName = 'wishlist_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function insertWish($data)
	{
		$this->tableName = 'wishlist_mst';
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function updateWish($cond,$data)
	{
		$this->tableName = 'wishlist_mst';
		return $this->CI->UserModel->updateData($cond,$data,$this->tableName);
	}
	function getWishlist()
	{
		return $this->CI->UserModel->getWishlistData();
	}
	function checkCart($cond)
	{
		$select = 'cart_id,qty,personalize_img';
		$this->tableName = 'cart_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function insertCart($data)
	{
		$this->tableName = 'cart_mst';
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function updateCart($cond,$data)
	{
		$this->tableName = 'cart_mst';
		return $this->CI->UserModel->updateData($cond,$data,$this->tableName);
	}
	function clearCart($cond)
	{
		$this->tableName = 'cart_mst';
		return $this->CI->UserModel->deleteData($cond,$this->tableName);
	}
	function quickViewProduct($id)
	{
		$cond['product_id'] = $id;
		$this->tableName = 'product_mst';
		$select = 'product_id,product_title';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCart()
	{
		$cond['user_id'] = $_SESSION['loggedUser'];
		$cond['qty !='] = 0;
		$this->tableName = 'cart_mst';
		$select = 'cart_id,product_id,qty,start_date,end_date,extra,ship_id,city_id,coupon_code,pincode,personalize_img';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCartData($cond,$select)
	{
		return $this->CI->UserModel->getCondSelectedData($cond,$select,'cart_mst');
	}
	function getCartShip()
	{
		return $this->CI->UserModel->getCartShip();
	}
	function getBlogCount($id)
	{
		return $this->CI->BlogModel->getBlogCount($id);
	}
	function getCommentCount($cond)
	{
		$select = 'c_id';
		$this->tableName = 'comment_mst';
		return $this->CI->UserModel->getLatestLimitedData($cond,$select,0,$this->tableName);
	}
	function getContentPage($id)
	{
		$cond['page_id'] = $id;
		$select = 'page_data';
		$this->tableName = 'page_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCharges($cond)
	{
		$select = 'charge_id,charge_type,charge_amount,charge_name';
		$this->tableName = 'charge_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getProductPrice($id)
	{
		$cond['product_id'] = $id;
		$select = 'price,category_id,child_id';
		$this->tableName = 'product_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getShippingRates($cond)
	{
		$select = 'rate_id,shipping_id,shipping_rate';
		$this->tableName = 'shipping_mst';
		return $this->CI->UserModel->getSortedData($cond,$select,$this->tableName,'shipping_rate','ASC');
	}
	function getTimeSlots($cond)
	{
		$select = 'timing_id,ship_id,start_time,end_time';
		$this->tableName = 'timing_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function checkCoupon($coupon,$select)
	{
		$cond['offer_name'] = $coupon;
		$cond['status'] = 1;
		$cond['is_coupon'] = 1;
		$cond['start_date <='] = date('Y-m-d');
		$cond['end_date >='] = date('Y-m-d');
		$this->tableName = 'offer_mst';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function cartProduct($cart_id)
	{
		return $this->CI->UserModel->getCartProduct($cart_id);
	}
	function getCouponSub($offer_id)
	{
		$cond['offer_id'] =$offer_id;
		$select = 'offer_id,priority,applied_on';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,'offer_submst');
	}
	function insertCashback($data)
	{
		return $this->CI->UserModel->insertData($data,'user_wallet');
	}
	function getWallet()
	{
		$select = 'amount,payment_type';
		$cond['user_id'] = $_SESSION['loggedUser'];
		return $this->CI->UserModel->getCondSelectedData($cond,$select,'user_wallet');
	}
	function getWalletTransaction()
	{
		$select = 'amount,payment_type,txn_id,order_id';
		$cond['user_id'] = $_SESSION['loggedUser'];
		$cond['amount >'] = 0;
		return $this->CI->UserModel->getCondSelectedData($cond,$select,'user_wallet');
	}
	function getOccassions()
	{
		$this->CI->db->select('child_id,child_name');
		$this->CI->db->where('category_id',8);
		$this->CI->db->from('subcategory_mst as smt');
		$this->CI->db->join('childcategory_mst as cmt','smt.subcategory_id = cmt.subcategory_id','left');
		return $this->CI->db->get()->result();
	}
	function GetCityByPincode($pincode)
	{
		$this->CI->db->select('pincode_id,pincode_mst.city_id');
		$this->CI->db->where('pincode',$pincode);
		$this->CI->db->where('city_mst.is_deleted',0);
		$this->CI->db->from('pincode_mst');
		$this->CI->db->join('city_mst','city_mst.city_id = pincode_mst.city_id');
		$this->CI->db->limit(1);
		return $this->CI->db->get()->result();
	}
}