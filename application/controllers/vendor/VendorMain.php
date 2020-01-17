<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendorMain extends CI_Controller {

	function __construct() 
	{ 
         parent::__construct();
         $this->load->model('VendorModel');
   	}
	function dashboard()
	{
		checkVendorLog();
		$data['myBalance'] = $this->VendorModel->getVendorBalance();
		$this->load->view('vendor/dashboard',$data);
	}
	function changePassword()
	{
		checkVendorLog();
		$vendor_id = $this->session->userdata('vendorLog');
		if ($this->input->post('vendor_name')) {
			$new_data['vendor_name'] = $this->input->post('vendor_name');
			$new_data['vendor_contact'] = $this->input->post('vendor_contact');
			$new_data['vendor_email'] = $this->input->post('vendor_email');
			$new_data['vendor_address'] = $this->input->post('vendor_address');
			$new_data['pin_code'] = $this->input->post('pin_code');
			$new_data['city_id'] = $this->input->post('city_id');
			if (in_array('', $new_data)) {
				$this->session->set_flashdata('errMsg','Please fill all Required Fields!');
				goto profilePage;
			}
			// if (strlen($usrContact) != 10 || !is_numeric($usrContact)) {
			// 	$this->session->set_flashdata('errMsg','Invalid contact number!');
			// 	goto profilePage;
			// }
			$condforVendor['vendor_id'] = $vendor_id;
			$updateResponse = $this->VendorModel->updateData($condforVendor,$new_data,'vendor_mst');
			if ($updateResponse) {
				$this->session->set_flashdata('successMsg','Profile has been updated!');
			}else{
				$this->session->set_flashdata('errMsg','Invalid Inputs!');
			}
		}
		if ($this->input->post('password')) {
			$password = $this->input->post('password');
			$npassword = $this->input->post('npassword');
			$cpassword = $this->input->post('cpassword');
			if ($password == '') {
				goto profilePage;
			}elseif ($cpassword == '' || $npassword == '') {
				$this->session->set_flashdata('errMsg','You must enter New password to change password!');
				goto profilePage;
			}elseif (md5($npassword) != md5($cpassword)) {
				$this->session->set_flashdata('errMsg','New password and Confirm Password Doesn\'t Match!');
				goto profilePage;
			}else{
				$updatePassCond['vendor_id'] = $vendor_id;
		   		$updatePassCond['vendor_pwd'] = md5($password);
		   		$select = 'vendor_id,vendor_name';
		   		$updateResponse = $this->VendorModel->getCondSelectedData($updatePassCond,$select,'vendor_mst');
		   		if (count($updateResponse) > 0) {
		   			$updatePassData['vendor_pwd'] = md5($npassword);
		   			$updateResponse = $this->VendorModel->updateData($updatePassCond,$updatePassData,'vendor_mst');
		   			if ($updateResponse) {
		   				$this->session->set_flashdata('successMsg','Profile & Password has been updated!');
		   			}else{
		   				$this->session->set_flashdata('errMsg','Invalid Inputs!');
		   			}
		   		}else{
		   			$this->session->set_flashdata('errMsg','Invalid Password!');
					goto profilePage;
		   		}
			}
			
		}

		profilePage:
		$data['title'] = 'Update Profile';
			$cc['vendor_id'] = $this->session->userdata('vendorLog');
			$cond['is_deleted'] = 0;
			$data['states'] = $this->VendorModel->getState($cond);
			$select = 'vendor_id,vendor_name,vendor_email,vendor_address,city_id,pin_code,vendor_contact';
			$data['editVendorData'] = $this->VendorModel->getCondSelectedData($cc,$select,'vendor_mst');
		$data['myBalance'] = $this->VendorModel->getVendorBalance();
		$this->load->view('vendor/changePassword',$data);
	}
	function loginPage()
	{
		if (isset($_SESSION['vendorLog'])) {
			redirect(base_url('vendor/dashboard'));
		}
		$this->load->view('vendor/login');
	}
	function vendorLogout()
	{
		checkVendorLog();
		unset($_SESSION['vendorLog']);
		redirect(base_url('vendor'));
	}
	function vendorLogin()
	{
		$name = $this->input->post('name');
		$pwd = md5($this->input->post('pwd'));
		$result = $this->VendorModel->vendorLogin($name,$pwd);
		if (count($result) == 1) {
			$r['success'] = "<p style='color:green'>Welcome to our website!".$result[0]->vendor_name."</p>";
			$_SESSION['vendorLog'] = $result[0]->vendor_id;
		}else {
			$r['err'] = "<p style='color:red'>Username or Password is incorrect!</p>";
		}
		echo json_encode($r);
	}
	function orderRequests()
	{
		checkVendorLog();
		$data['myBalance'] = $this->VendorModel->getVendorBalance();
		$this->load->view('vendor/orderRequests',$data);
	}
	function orderRequestTable()
	{
		checkVendorLog();
		$cond['va.vendor_id'] = $_SESSION['vendorLog'];
		$cond['va.vendor_status'] = 0;
		$data['orders'] = $this->VendorModel->orderRequestFetch($cond);
		$this->load->view('vendor/table/orderRequestTable',$data);
	}
	function viewStatement()
	{
		checkVendorLog();
		$cond['vendor_id'] = $_SESSION['vendorLog'];
		$data['statements'] = $this->VendorModel->statementFetch($cond);
		$this->load->view('vendor/table/myStatement',$data);
	}
	function orderDetail()
	{
		checkVendorLog();
		if ($this->input->post('assign_id')) {
			$cond['va.assign_id'] = $this->input->post('assign_id');
		}
		if ($this->input->post('detail_id')) {
			$cond['va.detail_id'] = $this->input->post('detail_id');
		}
		$cond['va.vendor_id'] = $_SESSION['vendorLog'];
		// $cond['va.vendor_status'] = 0;
		$data['Orders'] = $this->VendorModel->orderDetail($cond);
		$this->load->view('vendor/includes/orderDetail',$data);
	}
	function updateRequest()
	{
		checkVendorLog();
		$data['vendor_status'] = $this->input->post('response');
		$cond['detail_id'] = $this->input->post('HdnID');
		if ($data['vendor_status'] == 2) {
			$data['demand_price'] = $this->input->post('price');
			$newData['suborder_status'] = 1;
		}elseif($data['vendor_status'] == 1){
			$newData['suborder_status'] = 2;
		}elseif($data['vendor_status'] == 3){
			$newData['suborder_status'] = 0;
		}
		$this->VendorModel->updateOrderStatus($cond,$newData);
		if ($newData['suborder_status'] == 2) {
			acceptanceMailForUser($cond['detail_id']);
		}
		if ($data['vendor_status'] == 3) {
			$result = $this->VendorModel->deleteRequest($cond);
		}else{
			$result = $this->VendorModel->updateRequest($cond,$data);
		}
		
		if ($result) {
			
			echo "Thank You for your Response!";
		}
	}
	function acceptedOrderPage()
	{
		checkVendorLog();
		$data['myBalance'] = $this->VendorModel->getVendorBalance();
		$this->load->view('vendor/acceptedOrders',$data);
	}
	function deliveredOrderPage()
	{
		checkVendorLog();
		$data['myBalance'] = $this->VendorModel->getVendorBalance();
		$this->load->view('vendor/deliveredOrders',$data);
	}
	function acceptedOrders()
	{
		checkVendorLog();
		$cond['va.vendor_id'] = $_SESSION['vendorLog'];
		$cond['va.vendor_status'] = 1;
		$cond['ordsm.suborder_status <>'] = 4;
		$data['orders'] = $this->VendorModel->orderRequestFetch($cond);
		$this->load->view('vendor/table/acceptedOrderTable',$data);
	}
	function deliveredOrders()
	{
		checkVendorLog();
		$cond['va.vendor_id'] = $_SESSION['vendorLog'];
		$cond['va.vendor_status'] = 1;
		$cond['ordsm.suborder_status'] = 4;
		$data['orders'] = $this->VendorModel->orderRequestFetch($cond);
		$this->load->view('vendor/table/deliveredOrderTable',$data);
	}
	function updateOrderStatus()
	{
		checkVendorLog();
		$data['suborder_status'] = $this->input->post('response');
		$cond['detail_id'] = $this->input->post('HdnID');
		if ($data['suborder_status'] != '' && $cond['detail_id'] != '') {
			$result = $this->VendorModel->updateOrderStatus($cond,$data);
			if ($result) {
				if ($data['suborder_status'] == 4) {
					$this->VendorModel->addPayment($cond['detail_id']);
					deliveredMailForUser($cond['detail_id']);
				}
				if ($data['suborder_status'] == 3) {
					shippedMailForUser($cond['detail_id']);
				}
				echo "Success!";
			}
		}else{
			echo "Failed!";
		}
	}
	 function forgotPassword()
      {
         $returnArray = array();
         $type = $this->input->post('type');
         $value = $this->input->post('email');
         if ($type == 'email') {
            $vendorData = $this->VendorModel->checkVendor($value);
            if (count($vendorData) == 0) {
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Email Address not found!'
               );
               goto showResonse;
            }
            $name = @$vendorData[0]->vendor_name;
            $reciever_email = @$vendorData[0]->vendor_email;
            $subject = 'Reset Password';
            $randPass = mt_rand(100000,999999);
            $this->session->set_userdata('forgot_otp',$randPass);
            $this->session->set_userdata('forgot_user',$vendorData[0]->vendor_id);
            $msg= "<div><center><a title='Frinza' href='".base_url()."'><img alt='Frinza' src='".FOLDER_ASSETS_TEMPLATEDATA."images/logo.png' width='150px' height='80px'> </a></center><br><br> Dear $name !<br> You have requested to reset your password, Please Enter Following OTP to reset password.<br> $randPass</div>";
            
            // $data = SendEmail($reciever_email,$subject,$msg);
            if(SendEmail($reciever_email,$subject,$msg)){	
               $returnArray = array(
                        'class' => 'text-success',
                        'stepClass' => 'forgotOTP',
                        'step' => 'otp',
                        'msg' => 'Please check Email for OTP.'
               );
               goto showResonse;
            }
            else {
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Error in sending Email.'
               );
               goto showResonse;
            }
         }elseif ($type == 'otp') {
            $otp = $this->session->userdata('forgot_otp');
            if ($otp == '') {
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid OTP!'
               );
               goto showResonse;
            }elseif ($value == $otp) {
               $this->session->unset_userdata('forgot_otp');
               $returnArray = array(
                        'class' => 'text-success',
                        'stepClass' => 'forgotPass',
                        'step' => 'pass',
                        'msg' => 'OTP has been verified!'
               );
               goto showResonse;
            }else{
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotOTP',
                        'step' => 'otp',
                        'msg' => 'Invalid OTP!'
               );
               goto showResonse;
            }
         }elseif ($type == 'pass') {
            $vendor = $this->session->userdata('forgot_user');
            $otp = $this->session->userdata('forgot_otp');
            $this->session->unset_userdata('forgot_user');
            if ($vendor == '') {
                $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Password!'
               );
               goto showResonse;
            }elseif ($value != '' && $otp == '') {
               $updatePassword['vendor_pwd'] = md5($value);
               $updateCond['vendor_id'] = $vendor;
               $changePass = $this->VendorModel->updateData($updateCond,$updatePassword,'vendor_mst');
               if ($changePass) {
                  $returnArray = array(
                        'class' => 'text-success',
                        'stepClass' => 'forgotPass',
                        'step' => 'finish',
                        'msg' => 'Password has been changed!'
                  );
                  goto showResonse;
               }else{
                  $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Password!'
                  );
                  goto showResonse;
               }
            }else{
               $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Password!'
               );
               goto showResonse;
            }
         }else{
             $returnArray = array(
                        'class' => 'text-danger',
                        'stepClass' => 'forgotEmail',
                        'step' => 'email',
                        'msg' => 'Invalid Inputs!'
               );
               goto showResonse;
         }
         showResonse:
         echo json_encode($returnArray);
         die();
      }
      function getCityList()
      {
      	$cond['state_id'] = $_POST['state_id'];
		$cond['is_deleted'] = 0;
      	$result = $this->VendorModel->getCityList($cond);
		$this->output->set_output(json_encode($result));
      }
}
