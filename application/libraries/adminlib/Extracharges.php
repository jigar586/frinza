<?php
class Extracharges
{
	function __construct()
	{
		$this->tableName='charge_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	    $this->shipTable = 'shipping_mst';
	    $this->timeSlot = 'timing_mst';
	}
	function createCharge($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkCharge($cond)
	{
		$select = 'charge_id,charge_type';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCharge($cond)
	{
		$select = 'charge_id,charge_type,charge_name,charge_amount,product_id as category_id,is_opt';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateCharge($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	function deleteCharge($cond)
	{
		return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	}
	function updateShippingRate($id,$rate)
	{
		$cond['shipping_id'] = $id;
		$newData['shipping_rate'] = $rate;
		return $this->CI->AdminModel->updateData($cond,$newData,$this->shipTable);
	}
	function insertTimeSlot($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->timeSlot);
	}
	function deleteTimeSlot($cond)
	{
		return $this->CI->AdminModel->deleteData($cond,$this->timeSlot);
	}
	function deleteShipRate($cond)
	{
		return $this->CI->AdminModel->deleteData($cond,$this->shipTable);
	}
	function getTimeSlot($cond)
	{
		$select = 'timing_id,start_time,end_time,ship_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->timeSlot);
	}
	function getShippingRate($cond)
	{
		$select = 'rate_id,shipping_id,shipping_rate';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->shipTable);
	}
	function insertVariation($data)
	{
		return $this->CI->AdminModel->batchInsert($data,$this->tableName);
	}
	function removeVariation($cond)
	{
		return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	}
}