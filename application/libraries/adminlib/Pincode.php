<?php
class Pincode
{
	function __construct()
	{
		$this->tableName='pincode_mst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createPincode($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkPincode($pincode)
	{
		$cond['pincode'] = $pincode;
		$select = 'pincode_id,pincode';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getPincode($cond)
	{
		$select = 'pincode_id,pincode,city_id';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getStateCity($cond)
	{
        $join = [];
        $select = 'city_name,state_name,city_id,city_mst.state_id';
        $join[] = ['table'=> "city_mst" ,'on'=> "city_mst.state_id = state_mst.state_id" , 'type'=>'inner' ];
        return $this->CI->AdminModel->getSelectWithJoinData($cond,'state_mst',$join,$select);
	}
	function updatePincode($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}	
	function deletePincode($cond,$newData)
	{
		return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	}	
}