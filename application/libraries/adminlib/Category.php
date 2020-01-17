<?php
class Category
{
	function __construct()
	{
		$this->tableName='category_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createCategory($cat)
	{
		$data['category_name'] = $cat;
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function insertCategory($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkCategory($cat)
	{
		$cond['category_name'] = $cat;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'category_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function categoryCheck($cond = array())
	{
		// $cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'category_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCategory($cond)
	{
		$select = 'category_id,category_name,category_desc,is_active,category_title,meta_keyword,meta_description,category_heading,category_heading_desc,static_block';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateCategory($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	// function deleteCategory($cond)
	// {
	// 	return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	// }	
}