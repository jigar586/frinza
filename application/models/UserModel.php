<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model 
{

	function insertData($data,$tableName){
		return $this->db->insert($tableName,$data);
	}

	function getCondSelectedData($cond,$select,$tableName){
		$this->db->where($cond);
		$this->db->select($select);
		$sql = $this->db->get($tableName);
		return $sql->result();
	}

	function updateData($cond,$data,$tableName){
		$this->db->where($cond);
		return $this->db->update($tableName,$data);
	}

	function deleteData($cond,$tableName){
		$this->db->where($cond);
		return $this->db->delete($tableName);
	}

	function getRandomLimitedData($cond,$select,$limit,$tableName){
		if ($cond != '') {
			$this->db->where($cond);
		}
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$this->db->select($select);
		$this->db->order_by('rand()');
		$sql = $this->db->get($tableName);
		return $sql->result();
	}

	function getLatestLimitedData($cond,$select,$limit,$tableName){
		if ($cond != '') {
			$this->db->where($cond);
		}
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$this->db->select($select);
		$this->db->order_by('created_at','DESC');
		$sql = $this->db->get($tableName);
		return $sql->result();
	}

	function getLatestUpdatedData($cond,$select,$limit,$tableName){
		if ($cond != '') {
			$this->db->where($cond);
		}
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$this->db->select($select);
		$this->db->order_by('updated_at','DESC');
		$sql = $this->db->get($tableName);
		return $sql->result();
	}

	function getSortedData($cond,$select,$tableName,$sortby = 'created_at',$order = 'DESC'){
		$this->db->where($cond);
		$this->db->select($select);
		$this->db->order_by($sortby,$order);
		$sql = $this->db->get($tableName);
		return $sql->result();
	}

	function getCurrentOffer($select,$cond){
		$this->db->where($cond);
		$this->db->select($select);
		$this->db->from('offer_submst as osmst');
		$this->db->join('offer_mst as omst', 'omst.offer_id = osmst.offer_id');
		$this->db->limit(1);
		$this->db->order_by('osmst.created_at');
		$sql = $this->db->get();
		return $sql->result();
	}

	function batchInsertData($data,$tableName){
		return $this->db->insert_batch($tableName,$data);
	}

	function getCartShip(){
		if (!isset($_SESSION['loggedUser'])) {
			if (!isset($_SESSION['myCartData'])) {
				return array();
			}
			$rate_id = array();
			foreach ($_SESSION['myCartData'] as $rs) {
				$rate_id[] = $rs['ship_id'];
			}
			$this->db->where_in('rate_id',$rate_id);
			$this->db->select('shipping_rate');
			return $this->db->get('shipping_mst')->result();
		}
		$cond['crt.user_id'] = $_SESSION['loggedUser'];
		$cond['crt.qty !='] = 0;
		$this->db->where($cond);
		$this->db->select('crt.cart_id,shp.shipping_rate');
		$this->db->from('cart_mst as crt');
		$this->db->join('shipping_mst as shp','crt.ship_id = shp.rate_id');
		$sql = $this->db->get();
		return $sql->result();
	}

	function getWishlistData(){
		if (isset($_SESSION['loggedUser'])) {
			$cond['wish.user_id'] = $_SESSION['loggedUser'];
			$cond['wish.is_active'] = 1;
			$cond['pmt.deleted_at'] = '0000-00-00 00:00:00';
			$cond['pmt.status'] = 1;
			$this->db->where($cond);
			$this->db->select('wish_id,wish.product_id,pmt.product_title,pmt.product_img,pmt.product_desc,pmt.price');
			$this->db->from('wishlist_mst as wish');
			$this->db->join('product_mst as pmt','pmt.product_id = wish.product_id');
			return $this->db->get()->result();
		}
	}

	function checkUser($cond,$select){
		$this->db->select($select);
    	$this->db->where($cond);
		$this->db->where('( oauth_provider <>','guest');
		$this->db->or_where('oauth_provider IS NULL )');
		return $this->db->get('user_mst')->result();
	}

	function updateUser($cond,$data){
    	$this->db->where($cond);
		$this->db->where('( oauth_provider <>','guest');
		$this->db->or_where('oauth_provider IS NULL )');
		return $this->db->update('user_mst',$data);
	}

	function checkFacebookAuth($data,$tableName){
		if (!empty($data)) {
			$this->db->select('uid');
			$this->db->from($tableName);
			$this->db->where(['oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']]);
			$prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
			if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                $update = $this->db->update($tableName,$data,array('uid'=>$prevResult['uid']));
                
                $userID = $prevResult['uid'];
            }else{
            	$this->db->select('uid');
            	$this->db->where('user_email',$data['user_email']);
				$this->db->where('( oauth_provider <>','guest');
				$this->db->or_where('oauth_provider IS NULL )');
				$prevQuery = $this->db->get('user_mst');
	            $prevCheck = $prevQuery->num_rows();
				if($prevCheck > 0){
					$prevResult = $prevQuery->row_array();
	                $update = $this->db->update($tableName,$data,array('uid'=>$prevResult['uid']));
	                $userID = $prevResult['uid'];
				}else{
	                $data['registered_at']  = date("Y-m-d H:i:s");
	                $insert = $this->db->insert($tableName,$data);
	                $userID = $this->db->insert_id();
				}
            }
		}
        return $userID?$userID:FALSE;
	}

	function getCartProduct($cart_id){
		$this->db->select('pmt.product_id,pmt.category_id,pmt.child_id');
		$this->db->where('crt.cart_id',$cart_id);
		$this->db->from('cart_mst as crt');
		$this->db->join('product_mst as pmt','pmt.product_id = crt.product_id');
		return $this->db->get()->result();
	}

	function getProductCount($cond){ 
		$this->db->select('count(DISTINCT(pm.product_id)) as count');
		$this->db->where($cond);
		$this->db->from('product_category_rel as rel');
		$this->db->join('product_mst as pm','rel.product_id = pm.product_id','inner');
		return $this->db->get()->result();
	}

	function getProductList($cond,$limit = 0,$offset = 0,$sorting = 'ASC' ,$wise = 'order_no'){
		$this->db->select('pm.product_id,category_id,child_id,product_title,price,product_img,product_desc,created_at');
		$this->db->distinct('pm.product_id');
		$this->db->where($cond);
		$this->db->from('product_mst as pm');
		$this->db->join('product_category_rel as rel','rel.product_id = pm.product_id');
		$this->db->join('product_sort_dtl as psd', 'psd.rel_id = rel.rel_id and psd.priority = rel.priority and psd.product_id = rel.product_id', 'left');

		$this->db->order_by($wise.' '.$sorting, false);
		if ($limit != 0) {
			$this->db->limit($limit,$offset);
		}
		return $this->db->get()->result();
	}

	function getRandomProductList($cond,$limit = 0,$offset = 0,$sorting = 'ASC' ,$wise = 'order_no'){
		$this->db->select('pm.product_id,category_id,child_id,product_title,price,product_img,product_desc,created_at');
		$this->db->distinct('pm.product_id');
		$this->db->where($cond);
		$this->db->from('product_mst as pm');
		$this->db->join('product_category_rel as rel','rel.product_id = pm.product_id','inner');
		$this->db->join('product_sort_dtl as psd', 'psd.rel_id = rel.rel_id and psd.priority = rel.priority and psd.product_id = rel.product_id', 'inner');

		$this->db->order_by($wise.' '.$sorting, false);
		if ($limit != 0) {
			$this->db->limit($limit,$offset);
		}
		return $this->db->get()->result();
	}

	function getHomeProductList($cond,$limit = 0,$offset = 0,$sorting = 'ASC' ,$wise = 'order_no'){
		$this->db->select('pm.product_id,category_id,child_id,product_title,price,product_img,product_desc,created_at');
		$this->db->distinct('pm.product_id');
		$this->db->where($cond);
		$this->db->from('product_mst as pm');
		$this->db->join('product_category_rel as rel','rel.product_id = pm.product_id','inner');
		$this->db->join('home_sort_dtl as psd', 'psd.rel_id = rel.rel_id and psd.priority = rel.priority and psd.product_id = rel.product_id', 'left');

		$this->db->order_by($wise.' '.$sorting, false);
		if ($limit != 0) {
			$this->db->limit($limit,$offset);
		}
		return $this->db->get()->result();
	}

	function getOrderDetails($cond){
		$this->db->select('os.detail_id,os.suborder_status,os.ship_from,os.ship_till,pmt.product_title,pmt.product_img,os.price,os.qty');
		$this->db->where($cond);
		$this->db->from('order_mst as om');
		$this->db->join('order_submst as os','om.order_id = os.order_id');
		$this->db->join('product_mst as pmt','pmt.product_id = os.product_id');
		$this->db->join('user_mst as usr','om.user = usr.uid');
		$this->db->order_by('os.updated_at','DESC');
		return $this->db->get()->result();
	}

	function getMyOrders($cond){
		$this->db->select('os.detail_id,am.name,am.last_name,om.amount,os.suborder_status,om.created_at');
		$this->db->where($cond);
		$this->db->from('order_mst as om');
		$this->db->join('order_submst as os','om.order_id = os.order_id');
		$this->db->join('address_mst as am','am.address_id = om.shipping_ad');
		$this->db->order_by('os.updated_at','DESC');
		return $this->db->get()->result();
	}

	function getSelectWithJoinData($cond,$table,$join = array(),$select = NULL,$extraFilters = array()){
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
		if(isset($extraFilters['limit'])) {
			$this->db->limit($extraFilters['limit'][0], $extraFilters['limit'][1]);
		}
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
		$sql = $this->db->get($table);
		if(isset($extraFilters['result_type'])) {
			if($extraFilters['result_type']=='object')
				return $sql->result();
			if($extraFilters['result_type']=='count')
				return $sql->count_all_results();
		}
		return $sql->result_array();
	}
}