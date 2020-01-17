<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchModel extends CI_Model 
{
	function getProductCount($cond)
	{
		if (isset($cond['term'])) {
			$term = $cond['term'];
			unset($cond['term']);
		}
		$this->db->where($cond);
		$this->db->where("(
							product_title LIKE '$term' OR 
							search_terms LIKE '$term'
						)");
		return $this->db->count_all_results('product_mst');
	}
	function getSearchedProduct($cond,$limit = 0,$offset = 0,$sorting = 'DESC' ,$wise = 'created_at')
	{
		$this->db->select('product_id,product_title,price,product_img,product_desc,created_at');
		if (isset($cond['term'])) {
			$term = $cond['term'];
			unset($cond['term']);
		}
		$this->db->where($cond);
		$this->db->where("(
							product_title LIKE '$term' OR 
							search_terms LIKE '$term'
						)");
		$this->db->from('product_mst');
		$this->db->order_by($wise.' '.$sorting, false);
		if ($limit != 0) {
			$this->db->limit($limit,$offset);
		}
		return $this->db->get()->result();
	}
}