<?php
class Subcategory
{
	function __construct()
	{
		$this->tableName='subcategory_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createSubCategory($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkSubCategory($cond)
	{
		$select = 'subcategory_id,category_id,subcategory_name,deleted_at,subcategory_heading';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getSubCategory($cond)
	{
		$select = 'subcategory_id,category_id,subcategory_name,deleted_at,subcategory_heading,meta_title,meta_keyword,meta_description';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateSubCategory($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	// function deleteCategory($cond)
	// {
	// 	return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	// }	
}