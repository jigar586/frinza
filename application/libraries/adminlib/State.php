<?php
class State
{
	function __construct()
	{
		$this->tableName='state_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createState($state)
	{
		$data['state_name'] = $state;
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkState($state)
	{
		$cond['state_name'] = $state;
		$cond['is_deleted'] = 0;
		$select = 'state_id,state_name';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getState($cond)
	{
		$select = 'state_id,state_name';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateState($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}	
}