<?php
class Vendor
{
	function __construct()
	{
		$this->tableName='vendor_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createVendor($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkVendor($email)
	{
		$cond['vendor_email'] = $email;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'vendor_id,vendor_name,deleted_at';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getVendor($cond,$select)
	{
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getVendorBal($cond)
	{
		$select = 'SUM(amount) as addi';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,'vendor_payment');
	}
	function updateVendor($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	function getSubOrderCount($id)
	{
		return $this->CI->AdminModel->subOrderCount($id);
	}
}