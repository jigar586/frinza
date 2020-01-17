<?php
class Cities
{
	function __construct()
	{
		$this->tableName='city_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createCity($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkCity($cond)
	{
		$select = 'city_id,state_id,city_name';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateCity($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	function getCity($cond)
	{
		$select = 'state_id,city_id,city_name';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getCityState($id)
	{
		return $this->CI->AdminModel->getCityState($id);
	}

}