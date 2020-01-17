<?php
class User
{
	function __construct()
	{
		$this->tableName='user_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('UserModel');
	}
	function createUser($data)
	{
		return $this->CI->UserModel->insertData($data,$this->tableName);
	}
	function checkUser($email)
	{
		$select = 'uid,first_name,last_name,user_email';
		$cond['user_email'] = $email;
		return $this->CI->UserModel->checkUser($cond,$select);
	}
	function getUserAuth($cond)
	{
		$select = 'uid,oauth_provider';
		return $this->CI->UserModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function loginUser($cond)
	{
		$select = 'uid,first_name,last_name';
		return $this->CI->UserModel->checkUser($cond,$select);
	}
	function checkFacebookAuth($data)
	{
		return $this->CI->UserModel->checkFacebookAuth($data,$this->tableName);
		
	}
	function updateUser($cond,$data)
	{
		return $this->CI->UserModel->updateUser($cond,$data);
	}
}