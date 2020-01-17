<?php
class Assigner
{
	function __construct()
	{
		$this->tableName='vendor_assign';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function assignOrder($batch)
	{
		return $this->CI->AdminModel->batchInsert($batch,$this->tableName);
	}
	function checkAssign($cond)
	{
		$select = 'assign_id,vendor_price,demand_price';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateAssign($cond,$data)
	{
		return $this->CI->AdminModel->updateData($cond,$data,$this->tableName);
	}
}