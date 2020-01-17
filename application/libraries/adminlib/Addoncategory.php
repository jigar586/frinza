<?php
class Addoncategory
{
	function __construct()
	{
		$this->tableName='addoncategory_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createCategory($cat)
	{
		$data['addoncategory_name'] = $cat;
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function insertAddonCategory($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkCategory($cat)
	{
		$cond['addoncategory_name'] = $cat;
		$select = 'addoncategory_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function categoryCheck($cond = array())
	{
		// $cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'addoncategory_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getAddonCategory($con = '')
	{
		$select = 'addoncategory_id,addoncategory_name,is_active';
		return $this->CI->AdminModel->getCondSelectedArr($con,$select,$this->tableName);
	}
	function updateAddonCategory($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}	
}