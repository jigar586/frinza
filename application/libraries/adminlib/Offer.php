<?php
class Offer
{
	function __construct()
	{
		$this->tableName='offer_mst';
		$this->detailTable = 'offer_submst';
	    $this->CI =& get_instance();
	    $this->CI->load->model('AdminModel');
	}
	function createOffer($data)
	{
		return $this->CI->AdminModel->insertData($data,$this->tableName);
	}
	function checkOffer($cond)
	{
		$select = 'offer_id,offer_type';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function getOffer($cond)
	{
		$select = 'offer_id,offer_type,offer_name,is_coupon,start_date,end_date,status,amount,banner';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function updateOffer($cond,$newData)
	{
		return $this->CI->AdminModel->updateData($cond,$newData,$this->tableName);
	}
	function getOfferList($cond)
	{
		$select = 'offer_id,offer_name';
		return $this->CI->AdminModel->getCondSelectedData($cond,$select,$this->tableName);
	}
	function addOfferDetail($data)
	{
		return $this->CI->AdminModel->batchInsert($data,$this->detailTable);
	}
	function removeOfferRelations($data)
	{
		return $this->CI->AdminModel->deleteData($data,$this->detailTable);
	}
	// function deleteCategory($cond)
	// {
	// 	return $this->CI->AdminModel->deleteData($cond,$this->tableName);
	// }	
}