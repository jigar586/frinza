<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	function __construct() 
	{ 
         parent::__construct();
         $this->load->model('UserModel');
   	}
	public function index()
	{
		$con['is_active'] = 1;
		$con['banner_type'] = 'icon';
		$con['category_id'] = 0;
		$con['child_id'] = 0;
		$sele = 'banner_name, url, banner_img';
		$data['icons'] = $this->UserModel->getCondSelectedData($con,$sele,'banner_mst');

		$data['banners'] = $this->shop->getBanner(0);
		$cond['status'] = 1;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['addoncategory_id'] = 0;
		$cat = $this->shop->getCategory();
		$limit = 10;
		$data['catCNT'] = count($cat)+1;
		$occassion = $this->shop->getContentPage(4);
		if (count($occassion)) {
			if ($occassion[0]->page_data != 0) {
				$firstCond['rel.rel_id'] = $occassion[0]->page_data;
				$firstCond['rel.priority'] = 3;
				$firstCond['pm.status'] = 1;
				$firstCond['pm.addoncategory_id'] = 0;
				$firstCond['pm.deleted_at'] = '0000-00-00 00:00:00';
				$data['homeCatIDData0'] = $occassion[0]->page_data;
				$data['homeCatNameData0'] = @getChildName($occassion[0]->page_data);
				$data['homeCatProData0'] = $this->UserModel->getRandomProductList($firstCond,$limit);
			}
		}
		for ($i=1; $i <= count($cat); $i++) {
			if ($cat[$i-1]->category_id == 8) {
				$data['homeCatDescData0'] = $cat[$i-1]->category_desc;
				continue;
			}
			$cond['rel.rel_id'] = $cat[$i-1]->category_id;
			$cond['rel.rel_id <>'] = 8;
			$cond['rel.priority'] = 1;

			$data['homeCatNameData'.$i] = $cat[$i-1]->category_name;
			$data['homeCatIDData'.$i] = $cat[$i-1]->category_id;
			$data['homeCatDescData'.$i] = $cat[$i-1]->category_desc;
			$data['homeCatProData'.$i] = $this->UserModel->getHomeProductList($cond,$limit);
		}
		$cond2['is_live'] = 1;
		$data['blogs'] = $this->BlogModel->getBlogs($cond2,2);
		$this->load->view('home',$data);
	}
	public function login()
	{
		checkUserLog();
		$this->load->library('Facebook');
		$data['fbAuthURL'] =  $this->facebook->login_url();
		$this->load->library('Google');
		$data['gpAuthURL'] = $this->google->loginURL();
		$this->load->view('login',$data);
	}
	public function register()
	{
		checkUserLog();
		$this->load->library('Facebook');
		$data['fbAuthURL'] =  $this->facebook->login_url();
		$this->load->library('Google');
		$data['gpAuthURL'] = $this->google->loginURL();
		$this->load->view('register',$data);
	}
	public function guestLogin()
	{
		checkUserLog();
		$this->load->view('guestlogin');
	}
	public function dashboard()
	{
		resumeCart();
		if (isset($_SESSION['loggedUser'])) {
			$uid = $_SESSION['loggedUser'];
			$data['orders'] = $this->shop->getMyOrders($uid);
			$data['user'] = $this->shop->getUserDetail($uid);
		}else{
			redirect(base_url('login'));
		}
		$this->load->view('dashboard',$data);
	}
	function updateProfile()
	{
		if (!isset($_SESSION['loggedUser'])) {
			redirect(base_url('login'));
		}elseif (@$_SESSION['oauth'] == 'guest') {
			redirect(base_url('dashboard'));
		}
		$uid = $this->session->userdata('loggedUser');
		if ($this->input->post('FirstName')) {
			$new_data['first_name'] = $this->input->post('FirstName');
			$new_data['last_name'] = $this->input->post('LastName');
			$new_data['user_contact'] = $usrContact = $this->input->post('contact');
			if (in_array('', $new_data)) {
				$this->session->set_flashdata('errMsg','Please fill all Required Fields!');
				goto profilePage;
			}
			if (strlen($usrContact) != 10 || !is_numeric($usrContact)) {
				$this->session->set_flashdata('errMsg','Invalid contact number!');
				goto profilePage;
			}
			$cond['uid'] = $uid;
			$updateResponse = $this->shop->updateUser($cond,$new_data);
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
				$updatePassCond['uid'] = $uid;
		   		$updatePassCond['user_pwd'] = md5($password);
		   		$updateResponse = $this->user->loginUser($updatePassCond);
		   		if (count($updateResponse) > 0) {
		   			$updatePassData['user_pwd'] = md5($npassword);
		   			$updateResponse = $this->shop->updateUser($updatePassCond,$updatePassData);
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
		$data['userdata'] = $this->shop->getUserDetail($uid)[0];
		$this->load->view('myprofile',$data);
	}
	public function aboutus()
	{
		$data['content'] = $this->shop->getContentPage(1);
		$this->load->view('aboutpage',$data);
	}
	public function refundCancle()
	{
		$data['content'] = $this->shop->getContentPage(3);
		$this->load->view('refundCanclePage',$data);
	}
	public function privacy()
	{
		$data['title'] = 'Privacy Policy';
		$data['content'] = $this->shop->getContentPage(5);
		$this->load->view('contentPage',$data);
	}
	public function terms()
	{
		$data['content'] = $this->shop->getContentPage(2);
		$this->load->view('termspage',$data);
	}
	public function contactus()
	{
		$this->load->view('contact');
	}
	public function corporatecatalogue()
	{
		$this->load->view('corporatecatalogue/index');
	}
	public function career()
	{
		$this->load->view('career');
	}
	public function order()
	{
		if (isset($_SESSION['loggedUser'])) {
			$uid = $_SESSION['loggedUser'];
			$data['orders'] = $this->shop->getMyOrders($uid);
			$this->load->view('order',$data);
		}
	}
	public function faq()
	{
		$this->load->view('faq');
	}
	public function sitemap()
	{
		$this->load->view('sitemap');
	}
	public function corporate()
	{
		$this->load->view('corporate');
	}
	public function franchise()
	{
		$this->load->view('franchise');
	}
	public function thankyou()
	{
		if ($this->session->flashdata('OrderData')) {
			$cond['os.order_id'] = $this->session->flashdata('OrderData');
			$data['orderdataList'] = $this->UserModel->getOrderDetails($cond);
		}else{
			redirect(base_url('dashboard'));
		}
		$this->load->view('thankyou',$data);
	}
	function trackOrder()
	{
		$ordno = $this->input->get('ordno');
		$email = $this->input->get('email');
		if ($ordno != '') {
			$cond['detail_id'] = $ordno;
			if ($email != '') {
				$cond['user_email'] = $email;
			}elseif ($this->session->userdata('loggedUser')) {
				$cond['uid'] = $this->session->userdata('loggedUser');
			}else{
				$this->session->set_flashdata('errMsg','You are unauthorized for this action!');
				goto trackResponse;
			}
			$data['display'] = 'track';
			$orderdata = $this->UserModel->getOrderDetails($cond);
			if (count($orderdata) > 0) {
				$data['orderdata'] = $orderdata[0];
			}else{
				$data['display'] = 'form';
				$this->session->set_flashdata('errMsg','Your order no OR e-mail id does not match!');
			}
		}
		trackResponse:
		$data['title'] = 'Track Order';
		$this->load->view('trackorder',$data);
	}
}
