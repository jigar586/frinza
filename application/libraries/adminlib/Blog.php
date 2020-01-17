<?php
class Blog
{
	function __construct()
	{
		$this->tableName='blog_mst';
		$this->catTable = 'blogcategory_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createCategory($cat,$desc)
	{
		$data['category_name'] = $cat;
		$data['category_desc'] = $desc;
		return $this->CI->AdminModel->insertData($data,$this->catTable);
	}
	function checkCategory($cat)
	{
		$cond['category_name'] = $cat;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'category_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->catTable);
	}
	function getCategory($cond)
	{
		$select = 'category_id,category_name,category_desc';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->catTable);
	}
	function updateCategory($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->catTable);
	}
	function insertBlog($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function updateBlog($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	function deleteBlog($cond)
	{
		return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	}
	function getBlogData($cond)
	{
		$select = 'blog_id,title,details,category,blog_img';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updatePageData($cond,$data)
	{
		$tb = 'page_mst';
		return $this->CI->AdminModel->updateData($cond,$data,$tb);
	}
	function getPageData($id)
	{
		$tb = 'page_mst';
		$cond['page_id'] = $id;
		$select = 'page_data';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$tb);
	}
}