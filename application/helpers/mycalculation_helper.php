<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function offeredPrice($price,$pro,$child = 0,$cat = 0)
{
	return newOfferedPrice($price,$pro);
}
function newOfferedPrice($price,$product_id)
{
	$CI =& get_instance();
	$cond['ofm.start_date <='] = date('Y-m-d');
	$cond['ofm.end_date >='] = date('Y-m-d');
	$cond['ofm.status'] = 1;
	$cond['ofm.is_coupon'] = 0;
	$cond['ofm.deleted_at'] = '0000-00-00 00:00:00';
	$CI->db->select('ofm.offer_type,ofm.amount');
	$CI->db->where($cond);
	$CI->db->where('ofs.priority',3);
	$CI->db->where('ofs.applied_on',$product_id);
	$CI->db->from('offer_mst as ofm');
	$CI->db->join('offer_submst as ofs','ofs.offer_id = ofm.offer_id');
	$CI->db->limit(1);
	$offer = $CI->db->get()->result();
	if (count($offer) != 0) {
		return priceCalc($price,$offer[0]->offer_type,$offer[0]->amount);
	}
	$CI->db->select('ofm.offer_type,ofm.amount');
	$CI->db->where('ofs.priority',2);
	$CI->db->where($cond);
	$CI->db->where('rel.product_id',$product_id);
	$CI->db->where('rel.priority',3);
	$CI->db->from('offer_mst as ofm');
	$CI->db->join('offer_submst as ofs','ofs.offer_id = ofm.offer_id');
	$CI->db->join('product_category_rel as rel','rel.rel_id = ofs.applied_on');
	$CI->db->limit(1);
	$offer = $CI->db->get()->result();
	if (count($offer) != 0) {
		return priceCalc($price,$offer[0]->offer_type,$offer[0]->amount);
	}
	$CI->db->select('ofm.offer_type,ofm.amount');
	$CI->db->where('ofs.priority',1);
	$CI->db->where($cond);
	$CI->db->where('rel.product_id',$product_id);
	$CI->db->where('rel.priority',1);
	$CI->db->from('offer_mst as ofm');
	$CI->db->join('offer_submst as ofs','ofs.offer_id = ofm.offer_id');
	$CI->db->join('product_category_rel as rel','rel.rel_id = ofs.applied_on');
	$CI->db->limit(1);
	$offer = $CI->db->get()->result();
	if (count($offer) != 0) {
		return priceCalc($price,$offer[0]->offer_type,$offer[0]->amount);
	}
	return $price;
}
function priceCalc($price,$offer_type,$amount)
{
	if ($offer_type == 1) {
		return $price-$amount;
	}elseif ($offer_type == 2) {
		return round($price-($price*$amount/100));
	}
	return $price;	
}
function getAvgRating($pro)
{
	$cond['product_id'] = $pro;
	$CI =& get_instance();
	$result = $CI->shop->getAvgReview($cond);
	return round($result[0]->avg,1)*20;
}
function getRatingCount($pro)
{
	$cond['product_id'] = $pro;
	$CI =& get_instance();
	$result = $CI->shop->getReviewCount($cond);
	return count($result);
}
function getCategoryName($cat)
{
	$CI =& get_instance();
	$result = $CI->shop->getCategoryName($cat);
	return $result[0]->category_name;
}
function getChildName($child)
{
	$CI =& get_instance();
	$result = $CI->shop->getChildName($child);
	return $result[0]->child_name;
}
function compareDate($date,$day)
{
	$newDate = date('Y-m-d',strtotime('-'.$day.' days'));
	if (strtotime($date) > strtotime($newDate)) {
		return 1;
	}else {
		return 0;
	}
}
function getCityName($id)
{
	$CI =& get_instance();
	$result = $CI->shop->getCityName($id);
	return $result[0]->city_name;
}
function getAvailCities($array)
{
	$CI =& get_instance();
	$CI->db->select('city_id,city_name');
	$CI->db->where_in('city_id',$array);
	$CI->db->order_by('city_name');
	return $CI->db->get('city_mst')->result_array();
}
function getCartCount()
{
	if(isset($_SESSION['loggedUser'])){
		$CI =& get_instance();
		$result = $CI->shop->getCart();
		return count($result);
	}elseif(isset($_SESSION['myCartData'])){
		return count($_SESSION['myCartData']);
	}
	return 0;
}
function getCartValue()
{	
	$total = 0;
	// if(isset($_SESSION['loggedUser'])){
		$CI =& get_instance();
		$result = getCartData();
		foreach ($result as $r) {
			$cond['product_id'] = $r['product_id'];
			$cond['status'] = 1;
			$pro = $CI->shop->getNewProduct($cond,1);
			$sPrice = offeredPrice($pro[0]->price,$pro[0]->product_id,$pro[0]->child_id,$pro[0]->category_id);
			$total = $total + ($sPrice*$r['qty']);
		}
	// }
	return $total;
}
function getCartData()
{
	$cart = array();
	if(isset($_SESSION['loggedUser'])){
		$CI =& get_instance();
		$result = $CI->shop->getCart();
		foreach ($result as $r) {
			$cond['product_id'] = $r->product_id;
			$cond['status'] = 1;
			$time = date('d-m-Y h:i A',strtotime($r->start_date)).' - '.date('h:i A',strtotime($r->end_date));
			$extra = explode(',', $r->extra);
			$pro = $CI->shop->getNewProduct($cond,1);
			$img = json_decode($pro[0]->product_img);
			$ePrice = addedPrice($pro[0]->price,$extra);
			$price = offeredPrice($ePrice,$pro[0]->product_id,$pro[0]->child_id,$pro[0]->category_id);
			$cart[] = array('product_id' => @$pro[0]->product_id,
							'child_id' => @$pro[0]->child_id,
							'category_id' => @$pro[0]->category_id,
							'qty' => @$r->qty,
							'product_title' => @$pro[0]->product_title,
							'addoncategory_id' => @$pro[0]->addoncategory_id,
							'product_img' => @$img[0],
							'price' => @$price,
							'time' => @$time,
							'cart_id' => @$r->cart_id,
							'extra' => @$r->extra,
							'ship_id' => @$r->ship_id, 
							'city_id' => @$r->city_id,
							'pincode' => @$r->pincode,
							'personalize_img' => @$r->personalize_img,
							'start_date' => @$r->start_date,
							'end_date' => @$r->end_date,
							'tax_id' => @$pro[0]->tax_id, 
							'coupon_code' => @$r->coupon_code); 
		}
	}elseif(isset($_SESSION['myCartData'])){
		$CI =& get_instance();
		$result = $_SESSION['myCartData'];
		foreach ($result as $kas => $r) {
			$cond['product_id'] = $r['product_id'];
			$cond['status'] = 1;
			$time = date('d-m-Y h:i A',strtotime($r['start_date'])).' - '.date('h:i A',strtotime($r['end_date']));
			$extra = explode(',', $r['extra']);
			$pro = $CI->shop->getNewProduct($cond,1);
			if(count($pro))
			{
				$img = @json_decode($pro[0]->product_img);
				$ePrice = @addedPrice($pro[0]->price,$extra);
				$price = @offeredPrice($ePrice,$pro[0]->product_id,$pro[0]->child_id,$pro[0]->category_id);
				$cart[] = array('product_id' => @$pro[0]->product_id,
								'child_id' => @$pro[0]->child_id,
								'category_id' => @$pro[0]->category_id,
								'qty' => @$r['qty'],
								'product_title' => @$pro[0]->product_title,
								'addoncategory_id' => @$pro[0]->addoncategory_id,
								'product_img' => @$img[0],
								'price' => $price,
								'time' => $time,
								'cart_id' => $kas,
								'extra' => @$r['extra'],
								'ship_id' => @$r['ship_id'], 
								'city_id' => @$r['city_id'],
								'pincode' => @$r['pincode'],
								'personalize_img' => @$r['personalize_img'],
								'start_date' => @$r['start_date'],
								'end_date' => @$r['end_date'],
								'coupon_code' => @$r['coupon_code'],
								'tax_id' => @$pro[0]->tax_id); 
			}
		}
	}
	return $cart;
}
function getCartTotal(){
	$cart = getCartData();
	$total = 0;
	foreach ($cart as $r) {
		$total += ($r['price']*$r['qty']);
	}
	return $total;
}
function getShippingTotal()
{
	if (isset($_SESSION['loggedUser']) || isset($_SESSION['myCartData'])) {
		$CI =& get_instance();
		$r = 0;
		$r1 = $CI->shop->getCartShip();
		foreach ($r1 as $r2) {
			$r += $r2->shipping_rate;
		}
		return $r;
	}else{
		return 0;
	}
}
function getShippingRate($id)
{
	$cond['rate_id'] = $id;
	$CI =& get_instance();
	$r1 = $CI->shop->getShippingRates($cond);
	if (count($r1) != 0) {
		return $r1[0]->shipping_rate;
	}
	return 0;
}
function catBlogCount($id)
{
	$CI =& get_instance();
	$result = $CI->shop->getBlogCount($id);
	return $result[0]->count;
}
function countBlogComment($id)
{
	$cond['blog_id'] = $id;
	$CI =& get_instance();
	$result = $CI->shop->getCommentCount($cond);
	return count($result);
}
function addedPrice($price,$extra)
{
	$CI =& get_instance();
	$price1 = 0;
	foreach ($extra as $e) {
		$cond['charge_id'] = $e;
		$r = $CI->shop->getCharges($cond);
		if (count($r) != 0) {
			if ($r[0]->charge_type == 1) {
				$price1 += $r[0]->charge_amount;
			}else{
				$price1 += ($r[0]->charge_amount*$price/100);
			}
		}
		
	}
	return round($price+$price1);
}
function checkVendorLog()
{
	if (!isset($_SESSION['vendorLog'])) {
		redirect(base_url('vendor'));
	}
}
function checkAdminLog()
{
	if (!isset($_SESSION['adminLog'])) {
		redirect(base_url('admin'));
	}
}
function checkUserLog()
{
	if (isset($_SESSION['loggedUser']) && isset($_SESSION['myCartData'])) {
		redirect(base_url('user/resumecart'));
	}
	elseif (isset($_SESSION['loggedUser'])) {
		redirect(base_url('dashboard'));
	}
}
function resumeCart()
{
	if (isset($_SESSION['loggedUser']) && isset($_SESSION['myCartData'])) {
		redirect(base_url('user/resumecart'));
	}
}
function checkUserExclusive()
{
	if (!isset($_SESSION['loggedUser'])) {
		redirect(base_url('login'));
	}
}
function getVendorBalance($id)
{
	$CI =& get_instance();
	$CI->load->library('adminlib/Vendor');
	$cond['vendor_id'] = $id;
	$cond['payment_type'] = 0;
	$r = $CI->vendor->getVendorBal($cond);
	$cond['payment_type'] = 1;
	$r2 = $CI->vendor->getVendorBal($cond);
	return $r[0]->addi - $r2[0]->addi;
}
function couponCheck($offer_id,$product_id,$child_id,$category_id)
{
	$CI =& get_instance();
		$offers = $CI->shop->getCouponSub($offer_id);
		if (count($offers) != 0) {
			for ($i=0; $i < count($offers); $i++) { 
				if (($offers[$i]->applied_on == $product_id && $offers[$i]->priority == 3) || 
					($offers[$i]->applied_on == $child_id && $offers[$i]->priority == 2) ||
					($offers[$i]->applied_on == $category_id && $offers[$i]->priority == 1) 
					) {
					return true;
					break;
				}
			}
		}
		return false;
}
function newCouponCheck($offer_id,$product_id)
{
	$CI =& get_instance();
	$CI->db->where('offer_id',$offer_id);
	$CI->db->where('applied_on',$product_id);
	$CI->db->where('priority',3);
	$coupon = $CI->db->get('offer_submst')->num_rows();
	if ($coupon > 0) {
		return true;
	}
	$CI->db->where('offer_id',$offer_id);
	$CI->db->where('ofs.priority',2);
	$CI->db->where('rel.product_id',$product_id);
	$CI->db->where('rel.priority',3);
	$CI->db->from('offer_submst as ofs');
	$CI->db->join('product_category_rel as rel','rel.rel_id = ofs.applied_on');
	$coupon = $CI->db->get()->num_rows();
	if ($coupon > 0) {
		return true;
	}
	$CI->db->where('offer_id',$offer_id);
	$CI->db->where('ofs.priority',1);
	$CI->db->where('rel.product_id',$product_id);
	$CI->db->where('rel.priority',1);
	$CI->db->from('offer_submst as ofs');
	$CI->db->join('product_category_rel as rel','rel.rel_id = ofs.applied_on');
	$coupon = $CI->db->get()->num_rows();
	if ($coupon > 0) {
		return true;
	}
	return false;
}
function getCashBack()
{
	$cart = getCartData();
	$total = 0;
	foreach ($cart as $r) {
		$subtotal = ($r['price']*$r['qty']);
		$CI =& get_instance();
		$select = 'offer_id,offer_type,amount';
		if ($r['coupon_code'] != '') {
			$coupon = $CI->shop->checkCoupon($r['coupon_code'],$select);
			if ($coupon[0]->offer_type == 2) {
				
				$total += round((($subtotal*$coupon[0]->amount)/100),2);
			}else {
				$total += $coupon[0]->amount;
			}
		}	
	}
	return $total;
}
function getCashBackSingle($id)
{
	$cart = getCartData();
	foreach ($cart as $r) {
		if ($r['cart_id'] == $id) {
			$subtotal = ($r['price']*$r['qty']);
			$CI =& get_instance();
			$select = 'offer_id,offer_type,amount';
			if ($r['coupon_code'] != '') {
				$coupon = $CI->shop->checkCoupon($r['coupon_code'],$select);
				if ($coupon[0]->offer_type == 2) {
					return round((($subtotal*$coupon[0]->amount)/100),2);
				}else {
					return $coupon[0]->amount;
				}
			}
		}
	}
	return 0;
}
function calculatePayable($orderValue = 0)
{

}
function UserWallet()
{
	$CI =& get_instance();
	$total = 0;
	if (@$_SESSION['loggedUser']) {
		$wallet = $CI->shop->getWallet();
		for ($i=0; $i < count($wallet); $i++) { 
			if ($wallet[$i]->payment_type == 1) {
				$total -= $wallet[$i]->amount;
			}else{
				$total += $wallet[$i]->amount;
			}
		}
	}
	return $total;
}
function getRedeemRate()
{
	$CI =& get_instance();
	$CI->db->where('page_id',6);
	$result = $CI->db->get('page_mst')->result_array();
	return @json_decode($result[0]['page_data'])->redeem_rate;
}
function getUserEmail($id)
{
	$CI =& get_instance();
	if (@$_SESSION['loggedUser']) {
		$wallet = $CI->shop->getUserDetail($id);
		return $wallet[0]->user_email;
	}
	return '';
}

// Email User when Order Status changes
// Email When Vendor Accept Order
function acceptanceMailForUser($detail_id)
{
	$CI =& get_instance();
	$CI->db->select('os.detail_id,os.qty,os.price,os.ship_from,os.ship_till,os.ship_rate,pm.product_title,pm.product_img,am.name,am.last_name,am.email,am.contact,am.address_1,am.address_2,am.pin_code,am.city,os.created_at');
	$CI->db->from('order_submst as os');
	$CI->db->where('os.detail_id',$detail_id);
	$CI->db->join('order_mst as om','os.order_id = om.order_id');
	$CI->db->join('product_mst as pm','os.product_id = pm.product_id');
	$CI->db->join('address_mst as am','om.billing_ad = am.address_id');
	$userInfo = $CI->db->get()->result_array();
	if (count($userInfo)) {
		$reciever_email = @$userInfo[0]['email'];
	   	$subject = 'New Order #'.@$userInfo[0]['detail_id'].' accepted at Frinza';
	   	$emailTemplate['restData'] = $userInfo[0];
	   	$msg = $CI->load->view('email_templates/order_accept',$emailTemplate,TRUE);
	   	SendEmail($reciever_email,$subject,$msg);
	   	sendSMS(@$userInfo[0]['contact'],smsTemplate('orderaccept',@$userInfo[0]['detail_id']));
	}
}
function shippedMailForUser($detail_id)
{
	$CI =& get_instance();
	$CI->db->select('os.detail_id,am.name,am.last_name,am.email,am.contact,os.created_at');
	$CI->db->where('os.detail_id',$detail_id);
	$CI->db->from('order_submst as os');
	$CI->db->join('order_mst as om','os.order_id = om.order_id');
	$CI->db->join('address_mst as am','om.billing_ad = am.address_id');
	$userInfo = $CI->db->get()->result_array();
	if (count($userInfo)) {
		$reciever_email = @$userInfo[0]['email'];
	   	$subject = 'Your Frinza Order No. #'.@$userInfo[0]['detail_id'].' has been shipped!';
	   	$emailTemplate['restData'] = $userInfo[0];
	   	$msg = $CI->load->view('email_templates/order_shipped',$emailTemplate,TRUE);
	   	SendEmail($reciever_email,$subject,$msg);
	   	sendSMS(@$userInfo[0]['contact'],smsTemplate('ordershipped',@$userInfo[0]['detail_id']));
	}
}
function deliveredMailForUser($detail_id)
{
	$CI =& get_instance();
	$CI->db->select('os.detail_id,am.name,am.last_name,am.contact,am.email,os.created_at');
	$CI->db->where('os.detail_id',$detail_id);
	$CI->db->from('order_submst as os');
	$CI->db->join('order_mst as om','os.order_id = om.order_id');
	$CI->db->join('address_mst as am','om.billing_ad = am.address_id');
	$userInfo = $CI->db->get()->result_array();
	if (count($userInfo)) {
		$reciever_email = @$userInfo[0]['email'];
	   	$subject = 'Your Frinza Order No. #'.@$userInfo[0]['detail_id'].' has been Delivered!';
	   	$emailTemplate['restData'] = $userInfo[0];
	   	$msg = $CI->load->view('email_templates/order_delivered',$emailTemplate,TRUE);
	   	SendEmail($reciever_email,$subject,$msg);
	   	sendSMS(@$userInfo[0]['contact'],smsTemplate('orderdelivered',@$userInfo[0]['detail_id']));
	}
}
function paymentOrderMailForUser($ord_id)
{
	$CI =& get_instance();
	$CI->db->select('os.order_id,om.amount,om.msg_card,os.detail_id,os.qty,os.price,os.ship_from,os.ship_till,om.ship_price,pm.product_title,pm.product_img,am.name,am.last_name,am.email,am.address_1,am.address_2,am.contact,am.pin_code,am.city,os.created_at');
	$CI->db->where('om.order_id',$ord_id);
	$CI->db->from('order_submst as os');
	$CI->db->join('order_mst as om','os.order_id = om.order_id');
	$CI->db->join('product_mst as pm','os.product_id = pm.product_id');
	$CI->db->join('address_mst as am','om.billing_ad = am.address_id');
	$userInfo = $CI->db->get()->result_array();
	if (count($userInfo)) {
		$reciever_email = @$userInfo[0]['email'];
	   	$subject = 'Payment confirmation from Frinza!';
	   	$emailTemplate['restData'] = $userInfo;
	   	$msg = $CI->load->view('email_templates/payment',$emailTemplate,TRUE);
	   	$order_nos = array_map(function($ar){
	   		return '#'.$ar['detail_id'];
	   	}, $userInfo);
	   	$ord_id = implode(', ', $order_nos);
	   	SendEmail($reciever_email,$subject,$msg);
	   	$subject = 'New Order '.$ord_id.' placed at Frinza';
	   	$emailTemplate['restData'] = $userInfo;
	   	$msg = $CI->load->view('email_templates/order_placed',$emailTemplate,TRUE);
	   	SendEmail($reciever_email,$subject,$msg);
	   	sendSMS(@$userInfo[0]['contact'],smsTemplate('orderplaced',@$ord_id));
	}
}
function assigneeMail($detail_id)
{
	$CI =& get_instance();
	$CI->db->select('va.detail_id,va.vendor_price,va.vendor_msg,vm.vendor_email,os.qty,os.ship_from,os.ship_till,os.extra,om.msg_card,am.name,am.last_name,am.contact,am.email,am.address_1,am.address_2,am.pin_code,am.city,pm.product_title,pm.product_img,pm.product_desc,pm.sku_code');
	$CI->db->where_in('va.detail_id',$detail_id);
	$CI->db->from('vendor_assign as va');
	$CI->db->join('vendor_mst as vm','va.vendor_id = vm.vendor_id');
	$CI->db->join('order_submst as os','os.detail_id = va.detail_id');
	$CI->db->join('order_mst as om','os.order_id = om.order_id');
	$CI->db->join('address_mst as am','om.shipping_ad = am.address_id');
	$CI->db->join('product_mst as pm','pm.product_id = os.product_id');
	$CI->db->order_by('va.updated_at','DESC');
	$orderData = $CI->db->get()->result_array();
	if (count($orderData)) {
		for ($em=0; $em < count($orderData); $em++) { 
			$emailTemplate['restData'] = $orderData[$em];
			$reciever_email = $orderData[$em]['vendor_email'];
			$subject = 'Process Order #'.@$orderData[$em]['detail_id'].' for '.date('M jS Y (l)',strtotime(@$orderData[$em]['ship_from']));
			$msg = $CI->load->view('email_templates/vendor_assign',$emailTemplate,TRUE);
		   	SendEmail($reciever_email,$subject,$msg);
		}
	}
}
function getExtraTitle($str,$prefix = '- ',$suffix = '<br>')
{
	if ($str == '') {
		return '';
	}
	$extras = array_values(array_filter(explode(',', $str)));
	$CI =& get_instance();
	$CI->db->select('charge_name');
	$CI->db->where_in('charge_id',$extras);
	$charges = $CI->db->get('charge_mst')->result_array();
	$returnStr = '';
	if (count($charges)) {
		for ($i=0; $i < count($charges); $i++) { 
			$returnStr .= $prefix.$charges[$i]['charge_name'].$suffix;
		}
	}
	return $returnStr;
}

function smsTemplate($type,$data)
{
	switch ($type) {
	    case "register":
	        return "Dear Customer,\nWelcome to Frinza!\nYou have successfully logged in.\nYour Login ID is ".$data.".\nThank You";
	        break;
	    case "orderplaced":
	        return "Dear Customer,\nThank you for placing an order with Frinza!\nYour order id is #".$data.".\nTrack your order here: https://goo.gl/M7eusu\nThank You";
	        break;
	    case "orderaccept":
	        return "Dear Customer,\nYour order #".$data." is in Process. Thank You!";
	        break;
        case "ordershipped":
	        return "Dear Customer,\nYour order #".$data." is Shipped.\nThank You";
	        break;
        case "orderdelivered":
        	return "Your order #".$data." is successfully delivered.\n Click here to give your valuable feedback:  https://goo.gl/tvGioC \nThank You";
        	break;
	    default:
	        return "Dear Customer, Welcome to Frinza!";
	}
}
function sendSMS($number,$msg)
{
	$messegeData = rawurlencode($msg);
	$user = 'siliconbrain';
	$password = 'demo54321';
	$senderid = 'FRINZA';
	$res = file_get_contents("http://login.arihantsms.com/vendorsms/pushsms.aspx?user=".$user."&password=".$password."&msisdn=".$number."&sid=".$senderid."&msg=".$messegeData."&fl=0&gwid=2");
}

function currentCartCity()
{
	$currentCity = array();
	$cart = getCartData();
	if (count($cart)) {
		$currentCity[0] = $cart[0]['city_id'];
		$currentCity[1] = $cart[0]['pincode'];
	}
	return $currentCity;
}


function redeemAmount($orderValue = '')
{
	if (isset($_SESSION['loggedUser'])) {
		$redeemRate = getRedeemRate() / 100;
		$redeemableAmount = $orderValue * $redeemRate;
		$CI =& get_instance();
		$CI->db->select('SUM(CASE WHEN payment_type = 1 THEN amount END) as paid_amount,
						SUM(CASE WHEN trn_type = "refund" THEN amount END) as refund_amount,
						SUM(CASE WHEN trn_type = "cashback" THEN amount END) as cashback_amount');
		$CI->db->where('user_id',$_SESSION['loggedUser']);
		$array = $CI->db->get('user_wallet')->result_array();
		if (count($array)) {
			$fullAmount = $array[0]['refund_amount'] - $array[0]['paid_amount'];
			if ($fullAmount < 0) {
				$currentAmount = ($fullAmount + $array[0]['cashback_amount']);
				if ($currentAmount > $redeemableAmount) {
					$payableAmount = $redeemableAmount;
				}else{
					$payableAmount = $currentAmount;
				}
			}else{
				$currentAmount = ($array[0]['cashback_amount']);
				if ($currentAmount > $redeemableAmount) {

					$payableAmount = $redeemableAmount + $fullAmount;

				}else{
					$payableAmount = $currentAmount + $fullAmount;

				}
			}

			$Wallet = $fullAmount + $array[0]['cashback_amount'];
			if ($orderValue > $payableAmount) {
				return $payableAmount;
			}else{
				return $orderValue;
			}
		}
	}
	return 0;
}
function getTaxRates($tax_ids) {
	$CI =& get_instance();
	$CI->db->select('id, rate');
	$CI->db->where_in('id', $tax_ids);
	$CI->db->where('deleted_at', 0);
	$result = $CI->db->get('tax_mst')->result_array();
	$tax_rates = array();
	foreach($result as $tax) {
		$tax_rates[$tax['id']] = $tax['rate'];
	}
	return $tax_rates;
}