<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function thankyounext()
	{
		echo "<pre>";
		// $this->db->query("ALTER TABLE `subcategory_mst` ADD `subcategory_title` VARCHAR(5000) NULL DEFAULT NULL AFTER `subcategory_name`;");
		// $this->session->set_flashdata('OrderData',72);
			// redirect(base_url('thankyou'));
			echo "true"; die;
		print_r($this->db->get('user_wallet')->result_array());
		// $data['user_id'] = 363;
		// $data['order_id'] = 0;
		// $data['payment_type'] = 0;
		// $data['amount'] = 104;
		// $data['trn_type'] = 'refund';
		// $this->db->insert('user_wallet',$data);
		// $this->db->where('txn_id',167);
		// $this->db->delete('user_wallet');
	}

	function getFriendList(){
		$this->load->library('Facebook');
		$data = $this->facebook->user_friend_list();
	}
}
