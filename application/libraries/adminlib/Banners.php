<?php
class Banners
{
	function __construct()
	{
		$this->tableName='banner_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function insertBanner($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function getBanner($cond)
	{
		$select = 'banner_id, category_id, banner_name, banner_type, banner_img, is_active, url, child_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getAllBanner($cond)
	{
		$select = 'banner_id, category_name, banner_name, banner_type, banner_img, banner_mst.is_active, url, child_name';
		$join = [];
		$join[] = [ 'table' => 'category_mst', 'on' => 'category_mst.category_id = banner_mst.category_id', 'type' => 'left' ];
		$join[] = [ 'table' => 'childcategory_mst', 'on' => 'childcategory_mst.child_id = banner_mst.child_id', 'type' => 'left' ];
		return $this->CI->AdminModel->getSelectWithJoinData($cond, $this->tableName, $join, $select);
	}
	function updateBanner($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
}