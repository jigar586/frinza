<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminModel extends CI_Model 
{
	function insertData($data,$tableName)
	{
		return $this->db->insert($tableName,$data);
	}
	function getCondSelectedData($cond,$select,$tableName)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select($select);
		$sql = $this->db->get($tableName);
		return $sql->result();
	}
	function getCondSelectedArr($cond,$select,$tableName)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select($select);
		return $this->db->get($tableName)->result_array();
	}
	function updateData($cond,$newData,$tableName)
	{
		$this->db->where($cond);
		return $this->db->update($tableName,$newData);
	}
	function deleteData($cond,$tableName)
	{
		$this->db->where($cond);
		return $this->db->delete($tableName);
	}
	function batchInsert($data,$tableName)
	{
		return $this->db->insert_batch($tableName,$data);
	}
	function getCityState($id)
	{
		if ($id != '') {
			$cond['ctm.city_id'] = $id;
		}
		$cond['ctm.is_deleted'] = 0;
		$this->db->where($cond);
		$this->db->select('ctm.city_id,ctm.state_id,ctm.city_name,stm.state_name');
		$this->db->from('city_mst as ctm');
		$this->db->join('state_mst as stm','stm.state_id = ctm.state_id','left');
		$sql = $this->db->get();
		return $sql->result();
	}
	function getPincodeCityState($id)
	{
		$this->db->where('sm.state_id', $id);
		$this->db->select('state_name,sm.state_id,cm.city_name,cm.city_id,pm.pincode_id,pincode');
		$this->db->from('pincode_mst as pm');
		$this->db->join('city_mst as cm','cm.city_id = pm.city_id','left');
		$this->db->join('state_mst as sm','cm.state_id = sm.state_id','left');
		$sql = $this->db->get();
		return $sql->result();
	}
	function getSubcatCat($id)
	{
		if ($id != '') {
			$cond['sub.subcategory_id'] = $id;
		}
		$cond['sub.deleted_at'] = '0000-00-00 00:00:00';
		$this->db->where($cond);
		$this->db->select('sub.subcategory_id,sub.category_id,sub.subcategory_name,sub.is_active,cat.category_name');
		$this->db->from('subcategory_mst as sub');
		$this->db->join('category_mst as cat','sub.category_id = cat.category_id');
		$sql = $this->db->get();
		return $sql->result();
	}
	function getChildSubCat($id)
	{
		if ($id != '') {
			$cond['child.child_id'] = $id;
		}
		$cond['child.deleted_at'] = '0000-00-00 00:00:00';
		$this->db->where($cond);
		$this->db->select('child.child_id,sub.subcategory_id,sub.category_id,child.child_name,child.child_title,sub.subcategory_name,child.is_active,cat.category_name,child.child_heading,child.heading_description,child.meta_keyword,child.meta_description,child.static_block,is_display');
		$this->db->from('childcategory_mst as child');
		$this->db->join('subcategory_mst as sub','sub.subcategory_id = child.subcategory_id','left');
		$this->db->join('category_mst as cat','sub.category_id = cat.category_id','left');
		$sql = $this->db->get();
		return $sql->result();
	}
	function getChildbyCat($cat)
	{
		if ($cat != '') {
			$cond['cat.category_id'] = $cat;
		}
		$cond['child.is_random'] = 0;
		$cond['child.deleted_at'] = '0000-00-00 00:00:00';
		$this->db->where($cond);
		$this->db->select('child.child_id,child.child_name');
		$this->db->from('category_mst as cat');
		$this->db->join('subcategory_mst as sub','sub.category_id = cat.category_id','right');
		$this->db->join('childcategory_mst as child','sub.subcategory_id = child.subcategory_id','right');
		$sql = $this->db->get();
		return $sql->result();
	}
	function getProductDetail($id)
	{
		if ($id != '') {
			$cond['product_id'] = $id;
		}
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['status <'] = 2;
		$this->db->where($cond);
		$this->db->select('product_id,product_title,sku_code,price,status,meta_keyword');
		$this->db->order_by('created_at','DESC');
		return $this->db->get('product_mst')->result();
	}
	function getBlogList($id)
	{
		$cond = array();
		if ($id != '') {
			$cond['blog.blog_id'] = $id;
		}
		$this->db->where($cond);
		$this->db->select('blog.blog_id,blog.title,cat.category_name as category,is_live,updated_at');
		$this->db->from('blog_mst as blog');
		$this->db->join('blogcategory_mst as cat','blog.category = cat.category_id','left');
		$sql = $this->db->get();
		return $sql->result();
	}
	function newOrderDetailList($cond)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select('ord.order_id,ord.user,usr.first_name,usr.last_name,usr.user_contact,ordsm.detail_id,pmt.product_title,ordsm.qty,ordsm.price,ord.amount,ord.created_at,ordsm.ship_from,ordsm.ship_till,adr.name as billFname,adr.last_name as billLname,adr.contact,adr.address_1,adr.address_2,adr.pin_code,adr.city');
		$this->db->from('order_mst as ord');
		$this->db->join('address_mst as adr','ord.shipping_ad = adr.address_id','left');
		$this->db->join('order_submst as ordsm','ord.order_id = ordsm.order_id');
		$this->db->join('product_mst as pmt','ordsm.product_id = pmt.product_id');
		$this->db->join('shipping_mst as sht','sht.rate_id = ordsm.ship_id','left');
		$this->db->join('user_mst as usr','ord.user = usr.uid');
		$this->db->order_by('ord.created_at','DESC');
		return $this->db->get()->result();
	}
	function newOrderList($cond)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select('ord.order_id,usr.first_name,usr.last_name,usr.user_contact,ord.amount,ord.created_at');
		$this->db->from('order_mst as ord');
		$this->db->join('user_mst as usr','ord.user = usr.uid');
		$this->db->join('order_submst as ordsm','ord.order_id = ordsm.order_id');
		$this->db->order_by('ord.created_at','DESC');
		return $this->db->get()->result();
	}
	function subOrderCount($id)
	{
		if ($id != '' && $id != 0) {
			$cond['order_id'] = $id;
			$cond['suborder_status'] = 0;
			$this->db->where($cond);
		}
		$this->db->select('COUNT(detail_id) as pcount');
		return $this->db->get('order_submst')->result();
	}
	function pendingOrderList($cond)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select('crt.cart_id,usr.first_name,usr.user_contact,usr.last_name,pmt.product_title,crt.qty,crt.updated_at,crt.start_date,crt.end_date');
		$this->db->from('cart_mst as crt');
		$this->db->join('product_mst as pmt','crt.product_id = pmt.product_id');
		$this->db->join('user_mst as usr','crt.user_id = usr.uid');
		$this->db->order_by('crt.updated_at','DESC');
		return $this->db->get()->result();
	}
	function orderDetails($cond)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select('ord.order_id,usr.first_name,usr.last_name,ordsm.detail_id,ordsm.extra,pmt.product_title,pmt.product_img,ordsm.qty,ordsm.price,ord.amount,ord.created_at,ordsm.personalize_img,ordsm.ship_from,ordsm.ship_till,ord.msg_card');
		$this->db->from('order_submst as ordsm');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('product_mst as pmt','ordsm.product_id = pmt.product_id');
		$this->db->join('user_mst as usr','ord.user = usr.uid');
		$this->db->order_by('ord.created_at','DESC');
		return $this->db->get()->result();
	}
	function assignedOrderDetails($id,$data)
	{
		if ($id != '') {
			$this->db->where_in('detail_id',$id);
		}
		return $this->db->update('order_submst',$data);
	}
	function getChildCategoryData($cond,$array)
	{
		$array[]= 0;
		$this->db->select('child_id as id, child_name as text');
		$this->db->from('childcategory_mst');
		$this->db->where($cond);
		// if ($array != '') {
			$this->db->where_in('subcategory_id',$array);
		// }
		//echo $this->db->last_query(); 
		return $this->db->get()->result_array();
	}
	function getChildCategory($cond)
	{
		$this->db->select('child_id as id, child_name as text');
		$this->db->from('childcategory_mst');
		$this->db->where($cond);
		return $this->db->get()->result_array();
	}
	function getSubCategoryData($cond,$array)
	{
		$array[]= 0;
		$this->db->select('subcategory_id as id, subcategory_name as text');
		$this->db->from('subcategory_mst');
		$this->db->where($cond);
		// if ($array != '') {
			$this->db->where_in('category_id',$array);
		// }
		return $this->db->get()->result_array();
	}
	function getSubCategory($cond)
	{
		$this->db->select('subcategory_id as id, subcategory_name as text');
		$this->db->from('subcategory_mst');
		$this->db->where($cond);
		return $this->db->get()->result_array();
	}
	function acceptedOrderList($cond)
	{
		$this->db->where($cond);
		$this->db->select('ord.order_id,usr.first_name,pmt.product_title,ordsm.qty,usr.last_name,va.vendor_price,usr.user_contact,ordsm.suborder_status,ordsm.detail_id,vmt.vendor_name,ord.amount,ord.created_at,ordsm.ship_from,ordsm.ship_till,,adr.address_1,adr.address_2,adr.pin_code,adr.city');
		$this->db->from('order_submst as ordsm');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('address_mst as adr','ord.shipping_ad = adr.address_id','left');
		$this->db->join('product_mst as pmt','pmt.product_id = ordsm.product_id');
		$this->db->join('user_mst as usr','ord.user = usr.uid');
		$this->db->join('vendor_assign as va','va.detail_id = ordsm.detail_id');
		$this->db->join('vendor_mst as vmt','va.vendor_id = vmt.vendor_id');
		$this->db->join('shipping_mst as sht','sht.rate_id = ordsm.ship_id','left');
		$this->db->order_by('va.updated_at','DESC');
		return $this->db->get()->result();
	}
	function forwardedOrderList($cond)
	{
		$this->db->where($cond);
		$this->db->select('ord.order_id,va.detail_id,usr.first_name,pmt.product_title,ordsm.qty,usr.last_name,va.vendor_price,va.demand_price,va.vendor_status,usr.user_contact,vmt.vendor_name,ord.amount,ord.created_at,ordsm.ship_from,ordsm.ship_till,adr.address_1,adr.address_2,adr.pin_code,adr.city');
		$this->db->from('order_submst as ordsm');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('address_mst as adr','ord.shipping_ad = adr.address_id','left');
		$this->db->join('product_mst as pmt','pmt.product_id = ordsm.product_id');
		$this->db->join('user_mst as usr','ord.user = usr.uid');
		$this->db->join('vendor_assign as va','va.detail_id = ordsm.detail_id');
		$this->db->join('vendor_mst as vmt','va.vendor_id = vmt.vendor_id');
		$this->db->join('shipping_mst as sht','sht.rate_id = ordsm.ship_id','left');
		$this->db->order_by('va.updated_at','DESC');
		return $this->db->get()->result();
	}
	function checkShipRate($id,$city)
	{
		$this->db->where_in('city_id',$city);
		$this->db->where('shipping_id',$id);
		$this->db->select('rate_id,city_id');
		return $this->db->get('shipping_mst')->result();
	}
	function updateShippingRate($id,$newData)
	{
		$this->db->where_in('rate_id',$id);
		return $this->db->update('shipping_mst',$newData);
	}
	function getShipRates($cond)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select('shp.shipping_id,cmt.city_name,shp.shipping_rate,shp.rate_id');
		$this->db->from('shipping_mst as shp');
		$this->db->join('city_mst as cmt','cmt.city_id = shp.city_id','left');
		return $this->db->get()->result();
	}
	function getAllCustomers()
	{
		$this->db->select('usr.uid,usr.first_name,usr.last_name,usr.user_contact,count(omst.order_id) as order_count,uw.wallet_add,uw2.wallet_deduct');
		$this->db->from('user_mst as usr');
		$this->db->group_by('usr.uid');
		$this->db->join('order_mst as omst','usr.uid = omst.user','left');
		$this->db->join('(select user_id, sum(amount) as wallet_add from user_wallet  where payment_type = 0 group by user_id) as uw','usr.uid = uw.user_id','left');
		$this->db->join('(select user_id, sum(amount) as wallet_deduct from user_wallet where payment_type = 1 group by user_id) as uw2','usr.uid = uw2.user_id','left');
		return $this->db->get()->result();
	}
	function customerOrder($cond = 1)
	{
		$this->db->where($cond);
		$this->db->select('ord.order_id,pmt.product_title,ordsm.price,ordsm.qty,ord.amount,ord.created_at');
		$this->db->from('order_mst as ord');
		$this->db->join('order_submst as ordsm','ord.order_id = ordsm.order_id');
		$this->db->join('product_mst as pmt','ordsm.product_id = pmt.product_id');
		$this->db->order_by('ord.created_at','DESC');
		return $this->db->get()->result();
	}
	function updateOrderStatus($cond,$data)
	{
		$this->db->where($cond);
		return $this->db->update('order_submst',$data);
	}
	function getProductGridList($cond, $page)
	{
		$this->db->select('pm.product_id, pm.product_title, pm.product_img, pm.price, ps.order_no');
		$this->db->distinct('pm.product_id');
		$this->db->where($cond);
		$this->db->join('product_mst as pm','pr.product_id = pm.product_id','inner');
		$this->db->join('product_sort_dtl as ps','ps.product_id = pr.product_id and pr.rel_id = ps.rel_id and ps.priority = pr.priority','left');
		$this->db->from('product_category_rel as pr');
		$this->db->order_by('(case when order_no is null then 9999999 else order_no end) ASC', false);
		$page = (int)$page;
		$this->db->limit(24, $page*24);
		return $this->db->get()->result();
	
	}
	function getHomeProductGridList($cond, $page)
	{
		$this->db->select('pm.product_id, pm.product_title, pm.product_img, pm.price, ps.order_no');
		$this->db->distinct('pm.product_id');
		$this->db->where($cond);
		$this->db->join('product_mst as pm','pr.product_id = pm.product_id','inner');
		$this->db->join('home_sort_dtl as ps','ps.product_id = pr.product_id and pr.rel_id = ps.rel_id and ps.priority = pr.priority','left');
		$this->db->from('product_category_rel as pr');
		$this->db->order_by('(case when order_no is null then 9999999 else order_no end) ASC', false);
		$page = (int)$page;
		$this->db->limit(24, $page*24);
		return $this->db->get()->result();
	
	}
	function addPayment($id)
	{
		$cond['detail_id'] = $id;
		$cond['vendor_status'] = 1;
		$this->db->select('vendor_id,detail_id,vendor_price');
		$this->db->where($cond);
		$response = $this->db->get('vendor_assign')->result();
		if (!empty($response)) {
			$data['amount'] = $response[0]->vendor_price;
			$data['detail_id'] = $response[0]->detail_id;
			$data['vendor_id'] = $response[0]->vendor_id;
			$data['payment_type'] = 0;
			return $this->db->insert('vendor_payment',$data);
		}
	}
	function refundOrder($id)
	{
		$cond['ordsm.detail_id'] = $id;
		$this->db->select('ord.user,ordsm.ship_rate,ordsm.price,ordsm.qty');
		$this->db->where($cond);
		$this->db->from('order_submst as ordsm');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$response = $this->db->get()->result();
		$qty = $response[0]->qty;
		$price = $response[0]->price;
		$ship_rate = $response[0]->ship_rate;
		$user = $response[0]->user;
		
		$data['user_id'] = $user;
		$data['order_id'] = $id;
		$this->db->where($data);
		$this->db->where('payment_type',0);
		$this->db->delete('user_wallet');
		$refundAmount = ($price*$qty) + $ship_rate;
		$data['amount'] = $refundAmount;
		$data['payment_type'] = 0;
		$data['trn_type'] = 'refund';
		return $this->db->insert('user_wallet',$data);
	}
	function deleteCashbackOrder($id)
	{
		$cond['ordsm.detail_id'] = $id;
		$this->db->select('ord.user,ordsm.ship_rate,ordsm.price,ordsm.qty');
		$this->db->where($cond);
		$this->db->from('order_submst as ordsm');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$response = $this->db->get()->result();
		$qty = $response[0]->qty;
		$price = $response[0]->price;
		$ship_rate = $response[0]->ship_rate;
		$user = $response[0]->user;
		
		$data['user_id'] = $user;
		$data['order_id'] = $id;
		$this->db->where($data);
		$this->db->where('payment_type',0);
		return $this->db->delete('user_wallet');
	}
	function cancelledOrderList($cond)
	{
		$this->db->where($cond);
		$this->db->select('ord.order_id,usr.first_name,usr.last_name,ordsm.qty,ordsm.suborder_status,ordsm.detail_id,ordsm.price,ordsm.ship_rate,ord.created_at,pmt.product_title');
		$this->db->from('order_submst as ordsm');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('product_mst as pmt','pmt.product_id = ordsm.product_id');
		$this->db->join('user_mst as usr','ord.user = usr.uid');
		$this->db->order_by('ordsm.updated_at','DESC');
		return $this->db->get()->result();
	}
	function getUserInfo($cond = 1)
	{
		$this->db->where($cond);
		$this->db->select('
			usr.user_email,usr.first_name,usr.last_name,usr.user_contact,
			ad.name as bill_name,ad.last_name  as bill_lastname, ad.contact as bill_contact, 
			ad.email as bill_email ,ad.address_1,ad.address_2,ad.pin_code,ad.city,st.state_name,
			uw.wallet_add,uw2.wallet_deduct,count(ord.user) as order_count,usr.registered_at');
		$this->db->from('user_mst as usr');
		$this->db->group_by('usr.uid');
		$this->db->join('(select user_id, sum(amount) as wallet_add from user_wallet  where payment_type = 0 group by user_id) as uw','usr.uid = uw.user_id','left');
		$this->db->join('(select user_id, sum(amount) as wallet_deduct from user_wallet where payment_type = 1 group by user_id) as uw2','usr.uid = uw2.user_id','left');
		$this->db->join('(select user,billing_ad from order_mst order by created_at) as ord','ord.user = usr.uid','left');
		$this->db->join('address_mst as ad','ord.billing_ad = ad.address_id','left');
		$this->db->join('state_mst as st','ad.state = st.state_id','left');
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	function vendorOrders($cond = 1)
	{
		$this->db->where($cond);
		$this->db->select('va.vendor_price,ordsm.detail_id,pmt.product_title,amt.name as first_name,ordsm.qty,amt.last_name,ordsm.suborder_status,va.last_bargain,va.updated_at');
		$this->db->from('vendor_assign as va');
		$this->db->join('order_submst as ordsm','ordsm.detail_id = va.detail_id');
		$this->db->join('product_mst as pmt','pmt.product_id = ordsm.product_id');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('address_mst as amt','amt.address_id = ord.shipping_ad','left');
		$this->db->order_by('va.updated_at','desc');
		return $this->db->get()->result();
	}
	function getVendor($cond = 1)
	{
		$this->db->where($cond);
		$this->db->select('vm.vendor_id,vendor_name,vendor_email,cit.city_name,is_available,vendor_contact,vendor_address,pin_code,uw.wallet_add,uw2.wallet_deduct');
		$this->db->from('vendor_mst as vm');
		$this->db->group_by('vm.vendor_id');
		$this->db->join('city_mst as cit','vm.city_id = cit.city_id','left');
		$this->db->join('(select vendor_id, sum(amount) as wallet_add from vendor_payment  where payment_type = 0) as uw','vm.vendor_id = uw.vendor_id','left');
		$this->db->join('(select vendor_id, sum(amount) as wallet_deduct from vendor_payment  where payment_type = 1) as uw2','vm.vendor_id = uw2.vendor_id','left');
		return $this->db->get()->result();
	}
	function getSelectWithJoinData($cond,$table,$join = array(),$select = NULL,$extraFilters = array())
	{
		if(count($join)){
			foreach($join as $j){
				if(@$j['type'] == ''){
					$this->db->join($j['table'],$j['on']);
				}
				else{
					$this->db->join($j['table'],$j['on'],$j['type']);
				}	
			}
		}
		if($select){
			$this->db->select($select);
		}
		$this->db->where($cond);
		if (isset($extraFilters['group_by'])) {
			$this->db->group_by($extraFilters['group_by']);
		}
		if (isset($extraFilters['order_by'])) {
			if (is_array($extraFilters['order_by'])) {
				$this->db->order_by($extraFilters['order_by'][0], $extraFilters['order_by'][1]);
			}else{
				$this->db->order_by($extraFilters['order_by'],'ASC');
			}
		}
		if (isset($extraFilters['having'])) {
			$this->db->having($extraFilters['having']);
		}
		return $this->db->get($table)->result_array();
	}

	function getSelectedCatProductsArray($con,$select,$table,$rel_array){
		$this->db->select($select);
		$this->db->where($con);
		$this->db->where_in('rel_id',$rel_array);
		return $this->db->get($table)->result_array();
	}
}
