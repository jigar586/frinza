<?php
class Product
{
	function __construct()
	{
		$this->tableName='product_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createProduct($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkProduct($cond)
	{
		$select = 'product_id,product_name';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getProduct($cond,$select)
	{
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateProduct($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	// function deleteVendor($cond)
	// {
	// 	return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	// }
	function insertRelation($data)
	{
		return $this->CI->AdminModel->batchInsert($data,'product_category_rel');
	}
	function deleteRelation($data)
	{
		return $this->CI->AdminModel->deleteData($data,'product_category_rel');
	}
	function getRelation($cond,$select)
	{
		return $this->CI->AdminModel->getCondSelectedArr($cond,$select,'product_category_rel');
	}
}