<?php
class Childcategory
{
	function __construct()
	{
		$this->tableName='childcategory_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createChildCategory($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkChildCategory($cond)
	{
		$select = 'child_id,subcategory_id,child_name,child_title';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getChildCategory($cond)
	{
		$select = 'child_id,subcategory_id,child_name,is_random,child_title,meta_keyword,meta_description,static_block';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateChildCategory($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	// function deleteCategory($cond)
	// {
	// 	return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	// }	
}