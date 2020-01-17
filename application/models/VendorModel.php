<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendorModel extends CI_Model 
{
	function getCondSelectedData($cond,$select,$tableName)
	{
		if ($cond != '') {
			$this->db->where($cond);
		}
		$this->db->select($select);
		$sql = $this->db->get($tableName);
		return $sql->result();
	}
	function updateData($cond,$newData,$tableName)
	{
		$this->db->where($cond);
		return $this->db->update($tableName,$newData);
	}
	function vendorLogin($email,$pwd)
	{
		$cond = array('vendor_email' => $email,
						'vendor_pwd' => $pwd,
						'is_available' => 1,
						'deleted_at' => '0000-00-00 00:00:00');
		$this->db->select('vendor_id,vendor_name,vendor_email');
		$this->db->where($cond);
		$sql = $this->db->get('vendor_mst');
		return $sql->result();
	}
	function orderRequestFetch($cond)
	{
		$this->db->where($cond);
		$this->db->select('va.assign_id,va.vendor_price,ordsm.detail_id,ordsm.ship_from,ordsm.ship_till,pmt.product_title,pmt.product_img,amt.name,amt.last_name,ordsm.suborder_status,va.last_bargain');
		$this->db->from('vendor_assign as va');
		$this->db->join('order_submst as ordsm','ordsm.detail_id = va.detail_id');
		$this->db->join('product_mst as pmt','pmt.product_id = ordsm.product_id');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('address_mst as amt','amt.address_id = ord.shipping_ad');
		$this->db->order_by('va.updated_at','desc');
		return $this->db->get()->result();
	}
	function orderDetail($cond)
	{
		$this->db->where($cond);
		$this->db->select('*');
		$this->db->from('vendor_assign as va');
		$this->db->join('order_submst as ordsm','ordsm.detail_id = va.detail_id');
		$this->db->join('product_mst as pmt','pmt.product_id = ordsm.product_id');
		$this->db->join('order_mst as ord','ord.order_id = ordsm.order_id');
		$this->db->join('address_mst as amt','amt.address_id = ord.shipping_ad');
		$this->db->order_by('va.updated_at','desc');
		return $this->db->get()->result();
	}
	function updateRequest($cond,$data)
	{
		$this->db->where($cond);
		return $this->db->update('vendor_assign',$data);
	}
	function deleteRequest($cond)
	{
		$this->db->where($cond);
		return $this->db->delete('vendor_assign');
	}
	function updateOrderStatus($cond,$data)
	{
		$this->db->where($cond);
		return $this->db->update('order_submst',$data);
	}
	function addPayment($id)
	{
		$cond['va.detail_id'] = $id;
		$cond['va.vendor_id'] = $_SESSION['vendorLog']; 
		$cond['va.vendor_status'] = 1;
		$res = $this->orderRequestFetch($cond);
		if (!empty($res)) {
			$data['amount'] = $res[0]->vendor_price;
			$data['detail_id'] = $res[0]->detail_id;
			$data['vendor_id'] = $_SESSION['vendorLog'];
			$data['payment_type'] = 0;
			return $this->db->insert('vendor_payment',$data);
		}
	}
	function getVendorBalance()
	{
		$cond['vendor_id'] = $_SESSION['vendorLog'];
		$cond['payment_type'] = 0;
		$this->db->select('SUM(amount) as addi');
		$this->db->where($cond);
		$r = $this->db->get('vendor_payment')->result();
		$cond['payment_type'] = 1;
		$this->db->select('SUM(amount) as addi');
		$this->db->where($cond);
		$r2 = $this->db->get('vendor_payment')->result();
		return $r[0]->addi-$r2[0]->addi;
	}
	function statementFetch($cond)
	{
		if ($cond != '') {
			$this->db->where($cond);
			$this->db->select('vtx_id,amount,detail_id,payment_type,created_at');
			$this->db->order_by('created_at','desc');
			return $this->db->get('vendor_payment')->result();
		}
	}
	function checkVendor($email)
	{
		$cond['vendor_email'] = $email;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = '*';
		return $this->getCondSelectedData($cond,$select,'vendor_mst');
	}
	function getCityList($cond)
	{
		$cond['state_id'] = $_POST['state_id'];
		$cond['is_deleted'] = 0;
		$select = 'city_id,city_name';
		return $this->getCondSelectedData($cond,$select,'city_mst');
	}
	function getState($cond)
	{
		$select = 'state_id,state_name';
		return $this->getCondSelectedData($cond,$select,'state_mst');
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
}