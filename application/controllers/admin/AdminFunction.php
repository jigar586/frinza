<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminFunction extends CI_Controller {
	function __construct() 
	{ 
		parent::__construct();
		checkAdminLog();
		$this->load->model('AdminModel');
		$this->load->library('adminlib/Category');
		$this->load->library('adminlib/Subcategory');
		$this->load->library('adminlib/Childcategory');
		$this->load->library('adminlib/Banners');
		$this->load->library('adminlib/Cities');
		$this->load->library('adminlib/State');
		$this->load->library('adminlib/Pincode');
		$this->load->library('adminlib/Addoncategory');
		$this->load->library('adminlib/Vendor');
		$this->load->library('adminlib/Product');
		$this->load->library('adminlib/Offer');
		$this->load->library('adminlib/Blog');
		$this->load->library('adminlib/Extracharges');
		$this->load->library('adminlib/Assigner');
	}
	function insertAddonCategory()
	{
		// echo "true"; die;
		$checkCond['addoncategory_name'] = $cat = $this->input->post('txtcat');
		if ($this->input->post('addoncategory_id')) {
			$checkCond['addoncategory_id !='] = $this->input->post('addoncategory_id');
		}
		$check = $this->addoncategory->categoryCheck($checkCond);
		if (count($check) != 0) {
			echo "<p class='text-danger'>Category Already Exists!</p>";
		}else {
			if(isset($_POST['addoncategory_id']) && ($_POST['addoncategory_id'] != '')){
				$cond['addoncategory_id'] = $this->input->post('addoncategory_id');
				$newData['addoncategory_name'] = $cat;
				$result = $this->addoncategory->updateAddonCategory($cond,$newData);
				if ($result) {
					echo "<p style='color:green'>Category has been Updated!</p>";
				}
			}else{
				$data['addoncategory_name'] = $cat;
				$result = $this->addoncategory->insertAddonCategory($data);
				if ($result) {
					echo "<p style='color:green'>Category has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function insertCategory()
	{
		$checkCond['category_name'] = $cat = $this->input->post('txtcat');
		$catHeading = $this->input->post('catheading');
		$title = $this->input->post('txttitle');
		$catDesc = $this->input->post('txtdesc');
		$catHeadDesc = $this->input->post('hedingDec');
		if ($this->input->post('catID')) {
			$checkCond['category_id !='] = $this->input->post('catID');
		}
		$check = $this->category->categoryCheck($checkCond);
		if (count($check) != 0) {
			echo "<p class='text-danger'>Category Already Exists!</p>";
		}else {
			if(isset($_POST['catID']) && ($_POST['catID'] != '')){
				$cond['category_id'] = $this->input->post('catID');
				$newData['category_name'] = $cat;
				$newData['category_heading'] = $catHeading;
				$newData['category_title'] = $title;
				$newData['category_desc'] = $catDesc;
				$newData['category_heading_desc'] = $catHeadDesc;
				$newData['meta_keyword'] = $this->input->post('metakey');
				$newData['meta_description'] = $this->input->post('metadec');
				$newData['static_block'] = $this->input->post('static_block');
				$result = $this->category->updateCategory($cond,$newData);
				if ($result) {
					echo "<p style='color:green'>Category has been Updated!</p>";
				}
			}else{
				$data['category_name'] = $cat;
				$data['category_heading'] = $catHeading;
				$data['category_title'] = $title;
				$data['category_desc'] = $catDesc;
				$data['category_heading_desc'] = $catHeadDesc;
				$newData['meta_keyword'] = $this->input->post('metakey');
				$newData['meta_description'] = $this->input->post('metadec');
				$newData['static_block'] = $this->input->post('static_block');
				$result = $this->category->insertCategory($data);
				if ($result) {
					echo "<p style='color:green'>Category has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function deleteCategory()
	{
		if ($this->input->post('delete_cat')) {
			$cond['category_id'] = $this->input->post('category_id');
			$newData['deleted_at'] = date("Y-m-d H:i:s");
			$newData['deleted_by'] = $this->session->loggedUser;
			$result = $this->category->updateCategory($cond,$newData);
			if ($result) {
				echo "Category has been Deleted!";
				exit();
			}
		}
		if ($this->input->post('res') != '') {
			$cond['category_id'] = $this->input->post('id');
			$newData['is_active'] = $this->input->post('res');
			$result = $this->category->updateCategory($cond,$newData);
			if ($result) {
				echo "Category status has been updated!";
				exit();
			}
		}
	}
	function deleteAddonCategory()
	{
		if ($this->input->post('delete_cat')) {
			$cond['addoncategory_id'] = $this->input->post('addoncategory_id');
			$result = $this->AdminModel->deleteData($cond,'addoncategory_mst');
			if ($result) {
				echo "Addon Category has been Deleted!";
				exit();
			}
		}
		if ($this->input->post('res') != '') {
			$cond['addoncategory_id'] = $this->input->post('id');
			$newData['is_active'] = $this->input->post('res');
			$result = $this->addoncategory->updateAddonCategory($cond,$newData);
			if ($result) {
				echo "Addon Category status has been updated!";
				exit();
			}
		}
	}
	function viewCategoryTable()
	{
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond);
		$this->load->view('admin/tables/categoryTable',$data);
	}
	function viewAddonCategoryTable()
	{
		$data['categories'] = $this->addoncategory->getAddonCategory();
		$this->load->view('admin/tables/addonCategoryTable',$data);
	}
	function editCategory()
	{
		$cond['category_id'] = $this->input->post('category_id');
		$result = $this->category->getCategory($cond);
		$this->output->set_output(json_encode($result));
	}
	function editBanner()
	{
		$cond['banner_id'] = $this->input->post('banner_id');
		$result = $this->banners->getBanner($cond);
		$this->output->set_output(json_encode($result));
	}
	
	function insertBanner()
	{
		$data['category_id'] = $this->input->post('category_id');
		$data['url'] = $this->input->post('url');
		$data['child_id'] = $this->input->post('child_id');
		$data['banner_name'] = $this->input->post('banner_name');
		$data['banner_type'] = $this->input->post('banner_type');
		$config = array(
			'upload_path'   => realpath(FOLDER_ASSETS_BANNERUPLOAD),
			'allowed_types' => 'gif|jpg|png',
			'max_size'      => '10000',
			'encrypt_name'  => true,
		);
		$this->load->library('upload',$config);

		if (isset($_FILES['banner']) || !$this->input->post('bannerId'))  {
			if ($this->upload->do_upload('banner')) {
				$data['banner_img'] = $this->upload->data('file_name');
			}
		}

		if(isset($_POST['bannerId']) && ($_POST['bannerId'] != '')){
			$newData['banner_id'] = $this->input->post('bannerId');
			$result = $this->banners->updateBanner($newData,$data);
			if ($result) {
				echo "<p style='color:green'>Banner has been Updated!</p>";
			}else{
				echo "<p style='color:red'>Something went wrong!</p>";
			}
		}else{
			$result = $this->banners->insertBanner($data);
			if ($result) {
				echo "<p style='color:green'>Banner Has Been Added!!</p>";
			}else{
				echo "<p style='color:red'>Something went wrong!</p>";
			}
		}
	}
	function viewBannerTable()
	{
		$cond['banner_mst.is_active <'] = '2';
		$data['banners'] = $this->banners->getAllBanner($cond);
		$cond2['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->category->getCategory($cond2);
		$data['child'] = $this->childcategory->getChildcategory($cond2);
		$this->load->view('admin/tables/bannerTable',$data);
	}
	function updateBanner()
	{
		$cond['banner_id'] = $this->input->post('banner_id');
		if($this->input->post('url')){
			$cond['url'] = $this->input->post('url');
		}
		$data['is_active'] = $this->input->post('status');
		$result = $this->banners->updateBanner($cond,$data);
		if ($result && ($data['is_active'] == 2)) {
			echo "<p style='color:red'>Banner Has Been Deleted!!</p>";
		}
	}
	function updateProduct()
	{
		$cond['product_id'] = $this->input->post('product_id');
		$data['status'] = $this->input->post('status');
		$result = $this->product->updateProduct($cond,$data);
		if ($result && ($data['is_active'] == 2)) {
			echo "<p style='color:red'>Product Has Been Deleted!!</p>";
		}
	}
	function insertState()
	{
		$state = $this->input->post('txtstate');
		$check = $this->state->checkState($state);
		if (count($check) != 0) {
			echo "<p style='color:red'>State Already Exists!</p>";
		}else {
			if(isset($_POST['stateID']) && ($_POST['stateID'] != '')){
				$cond['state_id'] = $this->input->post('stateID');
				$newData['state_name'] = $state;
				$result = $this->state->updateState($cond,$newData);
				if ($result) {
					echo "<p style='color:green'>State has been Updated!</p>";
				}
			}else{
				$result = $this->state->createState($state);
				if ($result) {
					echo "<p style='color:green'>State has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function insertPincode()
	{
		$newData['pincode'] = $this->input->post('txtpincode');
		$newData['city_id'] = $this->input->post('city_id');
		$check = $this->pincode->checkPincode($pincode);
		if (count($check) != 0) {
			echo "<p style='color:red'>Pincode Already Exists!</p>";
		}else {
			if(isset($_POST['pincode_id']) && ($_POST['pincode_id'] != '')){
				$cond['pincode_id'] = $this->input->post('pincode_id');
				$result = $this->pincode->updatePincode($cond,$newData);
				if ($result) {
					echo "<p style='color:green'>Pincode has been Updated!</p>";
				}
			}else{
				$result = $this->pincode->createPincode($newData);
				if ($result) {
					echo "<p style='color:green'>Pincode has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function deletePincode()
	{
		if ($this->input->post('delete_pincode')) {
			$cond['pincode_id'] = $this->input->post('pincode_id');
			$result = $this->pincode->deletePincode($cond,$newData);
		}
	}
	function deleteState()
	{
		if ($this->input->post('delete_state')) {
			$cond['state_id'] = $this->input->post('state_id');
			$newData['is_deleted'] = 1;
			$result = $this->state->updateState($cond,$newData);
		}
	}
	function viewStateTable()
	{
		$cond['is_deleted'] = 0;
		$data['states'] = $this->state->getState($cond);
		$this->load->view('admin/tables/stateTable',$data);
	}
	function editState()
	{
		$cond['state_id'] = $this->input->post('state_id');
		$result = $this->state->getState($cond);
		$this->output->set_output(json_encode($result));
	}
	function getCityList()
	{
		$cond['state_id'] = $_POST['state_id'];
		$cond['is_deleted'] = 0;
		$result = $this->cities->getCity($cond);
		$this->output->set_output(json_encode($result));
	}
	function getStateCityList()
	{
		$cond['state_id'] = $_POST['state_id'];
		$cond['is_deleted'] = 0;
		$result = $this->cities->getCity($cond);
		echo json_encode($result);
	}
	function insertCity()
	{
		$cond['city_name'] = $this->input->post('txtcity');
		$cond['state_id'] = $this->input->post('state_id');
		$cond['is_deleted'] = 0;
		$check = array();
		if(isset($_POST['cityID']) && ($_POST['cityID'] != '')){
			$cond['city_id'] = $this->input->post('cityID');
			$newData['city_name'] = $cond['city_name'];
			$newData['state_id'] = $cond['state_id'];
			$result = $this->cities->updateCity($cond,$newData);
			if ($result) {
				echo "<p style='color:green'>City has been Updated!</p>";
			}
		}else{
			if (count($check) != 0) {
				echo "<p style='color:red'>City Already Exists!</p>";
			}else {
				$result = $this->cities->createCity($cond);
				if ($result) {
					echo "<p style='color:green'>City has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function viewCityTable()
	{
		$id = '';
		$data['cities'] = $this->AdminModel->getCityState($id);
		$this->load->view('admin/tables/cityTable',$data);	
	}
	function viewPincodeTable($id)
	{
		$data['pincodeList'] = $this->AdminModel->getPincodeCityState($id);
		$this->load->view('admin/tables/pincodeTable',$data);	
	}
	function editCity()
	{
		$cond['city_id'] = $this->input->post('city_id');
		$result = $this->cities->getCity($cond);
		$this->output->set_output(json_encode($result));
	}
	function editPincode()
	{
		$cond['pincode_id'] = $this->input->post('pincode_id');
		$result = $this->pincode->getPincode($cond);
		$this->output->set_output(json_encode($result));
	}
	function deleteCity()
	{
		if ($this->input->post('delete_city')) {
			$cond['city_id'] = $this->input->post('city_id');
			$newData['is_deleted'] = 1;
			$result = $this->cities->updateCity($cond,$newData);
		}
	}
	function addVendor()
	{
		$name = $this->input->post('vendor_name');
		$email = $this->input->post('vendor_email');
		$pwd = $this->input->post('vendor_pwd');
		$address = $this->input->post('vendor_address');
		$pin = $this->input->post('pin_code');
		$city = $this->input->post('city_id');
		$contact = $this->input->post('vendor_contact');
		$hdnID = $this->input->post('vendor_id');
		if ($hdnID != '') {
			$check = array();
		}else{
			$check = $this->vendor->checkVendor($email);
		}
		if (count($check) != 0) {
			echo "<p style='color:red'>Email Address Already Exists, Please use another Email!</p>";
		}else{
			$data['vendor_name'] = $name;
			$data['vendor_email'] = $email;
			
			$data['city_id'] = $city;
			$data['vendor_address'] = $address;
			$data['vendor_contact'] = $contact;
			$data['pin_code'] = $pin;
			if (in_array('', $data) || $data['city_id'] == 0 || ($pwd == '' && $hdnID == '')) {
				echo "<p style='color:red'>All Fields are necessary!</p>";
			}else{
				if ($pwd != '') {
					$data['vendor_pwd'] = md5($pwd);
				}
				if ($hdnID != '') {
					$updateCond['vendor_id'] = $hdnID;
					$result = $this->vendor->updateVendor($updateCond,$data);
				}else{
					$result = $this->vendor->createVendor($data);
				}
				
				if ($result) {
					$msg = $hdnID != '' ? "Updated" : "Added";
					echo "<p style='color:green'>Vendor has been ".$msg."!</p>";
				}
			}
		}
	}
	function viewVendorTable()
	{
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$select = 'vendor_id,vendor_name,vendor_email,city_id,is_available,vendor_contact';
		$data['vendors'] = $this->vendor->getVendor($cond,$select);
		$this->load->view('admin/tables/vendorTable',$data);
	}
	function changeVendorStat()
	{
		$cond['vendor_id'] = $this->input->post('vendor_id');
		if ($this->input->post('status') == 2) {
			$data['deleted_at'] = date('Y-m-d H:i:s');
			$result = $this->vendor->updateVendor($cond,$data);
			if ($result) {
				echo "<p style='color:green'>Vendor has been Deleted!</p>";
			}
		}else{
			$data['is_available'] = $this->input->post('status');
			$result = $this->vendor->updateVendor($cond,$data);
			if ($result) {
				echo "<p style='color:green'>Vendor Status has been Updated!</p>";
			}
		}
	}
	function addSubcategory()
	{
		$cond['subcategory_name'] = $this->input->post('txtsub');
		$cond['subcategory_heading'] = $this->input->post('subheading');
		$cond['meta_title'] = $this->input->post('metatitle');
		$cond['meta_keyword'] = $this->input->post('metakeyword');
		$cond['meta_description'] = $this->input->post('metadescription');
		$cond['category_id'] = $this->input->post('category_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$check = $this->subcategory->checkSubCategory($cond);
		if(isset($_POST['subID']) && ($_POST['subID'] != '')){
			$newData['subcategory_id'] = $this->input->post('subID');
			$result = $this->subcategory->updateSubCategory($newData,$cond);
			if ($result) {
				echo "<p style='color:green'>Subcategory has been Updated!</p>";
			}
		}else{
			if (count($check) != 0) {
				echo "<p style='color:red'>Subcategory Already Exists!</p>";
			}else {
				$result = $this->subcategory->createSubCategory($cond);
				if ($result) {
					echo "<p style='color:green'>Subcategory has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function viewSubcatTable()
	{
		$id = '';
		$data['categories'] = $this->AdminModel->getSubcatCat($id);
		$this->load->view('admin/tables/subcatTable',$data);	
	}
	function editSubcat()
	{
		$cond['subcategory_id'] = $this->input->post('subcategory_id');
		$result = $this->subcategory->getSubCategory($cond);
		$this->output->set_output(json_encode($result));
	}
	function deleteSubcat()
	{
		if ($this->input->post('delete_subcat')) {
			$cond['subcategory_id'] = $this->input->post('subcategory_id');
			$newData['deleted_at'] = date('Y-m-d H:i:s');
			$result = $this->subcategory->updateSubCategory($cond,$newData);
		}
		if ($this->input->post('res') != '') {
			$cond['subcategory_id'] = $this->input->post('id');
			$newData['is_active'] = $this->input->post('res');
			$result = $this->subcategory->updateSubCategory($cond,$newData);
			if ($result) {
				echo "SubCategory status has been updated!";
				exit();
			}
		}
	}
	function addChildcategory()
	{
		$cond['child_name'] = $this->input->post('txtchild');
		$cond['subcategory_id'] = $this->input->post('subcategory_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$check = $this->childcategory->checkChildCategory($cond);
		if(isset($_POST['childID']) && ($_POST['childID'] != '')){
			$cond1['child_id'] = $this->input->post('childID');
			$newData['child_name'] = $cond['child_name'];
			$newData['child_heading'] = $this->input->post('childheading');
			$newData['heading_description'] = $this->input->post('headingDescription');
			$newData['child_title'] = $this->input->post('meta_title');
			$newData['subcategory_id'] = $cond['subcategory_id'];
			$newData['meta_keyword'] = $this->input->post('metakey');
			$newData['meta_description'] = $this->input->post('metadec');
			$newData['static_block'] = $this->input->post('static_block');
			$result = $this->childcategory->updateChildCategory($cond1,$newData);
			if ($result) {
				echo "<p style='color:green'>Childcategory has been Updated!</p>";
			}
		}else{
			if (count($check) != 0) {
				echo "<p style='color:red'>Childcategory Already Exists!</p>";
			}else {
				$result = $this->childcategory->createChildCategory($cond);
				if ($result) {
					echo "<p style='color:green'>Childcategory has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function viewChildcatTable()
	{
		$id = '';
		$data['categories'] = $this->AdminModel->getChildSubCat($id);
		$this->load->view('admin/tables/childcatTable',$data);	
	}
	function editChildcat()
	{
		$id = $this->input->post('child_id');
		$result = $this->AdminModel->getChildSubCat($id);
		$this->output->set_output(json_encode($result));
	}
	function deleteChildcat()
	{
		if ($this->input->post('delete_childcat')) {
			$cond['child_id'] = $this->input->post('child_id');
			$newData['deleted_at'] = date('Y-m-d H:i:s');
			$result = $this->childcategory->updateChildCategory($cond,$newData);
		}
		if ($this->input->post('res') != '') {
			$cond['child_id'] = $this->input->post('id');
			$newData['is_active'] = $this->input->post('res');
			$result = $this->childcategory->updateChildCategory($cond,$newData);
			if ($result) {
				echo "Child Category status has been updated!";
				exit();
			}
		}
	}
	function isdisplaychildcat()
	{
		if ($this->input->post('res') != '') {
			$cond['child_id'] = $this->input->post('id');
			$newData['is_display'] = $this->input->post('res');
			$result = $this->childcategory->updateChildCategory($cond,$newData);
			if ($result) {
				echo "Child Category status has been updated!";
				exit();
			}
		}
	}
	function getSubCatList()
	{
		$cond['category_id'] = $this->input->post('category_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$result = $this->subcategory->getSubCategory($cond);
		$this->output->set_output(json_encode($result));
	}
	function getSelectedSubCatList()
	{
		$cond['category_id'] = $this->input->post('category_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$result = $this->AdminModel->getSubCategory($cond);
		echo json_encode($result);
	}
	function getProductlist()
	{
		if($this->input->post('child_cat_id')){
			$cond['pr.priority'] = '3';
			$cond['pr.rel_id'] = $this->input->post('child_cat_id');
		}

		elseif($this->input->post('sub_cat_id')){
			$cond['pr.priority'] = '2';
			$cond['pr.rel_id'] = $this->input->post('sub_cat_id');
		}
		else {
			$cond['pr.priority'] = '1';
			$cond['pr.rel_id'] = $this->input->post('category_id');
		}
		$cond['pm.deleted_at'] = '0000-00-00 00:00:00';
		$cond['pm.addoncategory_id'] = '0';
		$cond['pm.status'] = 1;
		$page = $this->input->post('page');
		$result['data'] = $this->AdminModel->getProductGridList($cond, $page);
		$result['page'] = $page + 1;
		echo json_encode($result);
	}
	function getProductHomelist()
	{
		if($this->input->post('child_cat_id')){
			$cond['pr.priority'] = '3';
			$cond['pr.rel_id'] = $this->input->post('child_cat_id');
		}

		elseif($this->input->post('sub_cat_id')){
			$cond['pr.priority'] = '2';
			$cond['pr.rel_id'] = $this->input->post('sub_cat_id');
		}
		else {
			$cond['pr.priority'] = '1';
			$cond['pr.rel_id'] = $this->input->post('category_id');
		}
		$cond['pm.deleted_at'] = '0000-00-00 00:00:00';
		$cond['pm.addoncategory_id'] = '0';
		$cond['pm.status'] = 1;
		$page = $this->input->post('page');
		$result['data'] = $this->AdminModel->getHomeProductGridList($cond, $page);
		$result['page'] = $page + 1;
		echo json_encode($result);
	}
	function getChildCatList()
	{
		$i=0;
		$arr = $this->input->post('subcategory_id');
		$cond['subcategory_id in'] =$arr;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$result = $this->childcategory->getChildCategory($cond);
		$this->output->set_output(json_encode($result));
	}
	function getSelectedChildCatList()
	{
		$cond['subcategory_id'] = $this->input->post('subcategory_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$result = $this->AdminModel->getChildCategory($cond);
		echo json_encode($result);
	}
	function getchildcatlistData()
	{
		$i=0;
		$arr = $this->input->post('subcategory_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$result = $this->AdminModel->getChildCategoryData($cond,$arr);
		echo json_encode($result);
	}
	function getsubcatlistData()
	{
		$i=0;
		$arr = $this->input->post('category_id');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$result = $this->AdminModel->getSubCategoryData($cond,$arr);
		echo json_encode($result);
	}
	function getProductByChild()
	{
		$cond['child_id'] = $this->input->post('child');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['status'] = 1;
		$select = 'product_id,product_title';
		$result = $this->product->getProduct($cond,$select);
		$this->output->set_output(json_encode($result));
	}
	function getProductByCat()
	{
		$cond['category_id'] = $this->input->post('cat');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$cond['status'] = 1;
		$select = 'product_id,product_title';
		$result = $this->product->getProduct($cond,$select);
		$this->output->set_output(json_encode($result));
	}
	function insertProduct()
	{
		$vt = $this->input->post('variations');
		$variationArr = array();
		$catArr = array();
		$subArr = array();
		$childArr = array();
		$catArr = $this->input->post('category_id');
		$subArr = $this->input->post('subcategory_id');
		$childArr = $this->input->post('child_id');
		$data['product_title'] = $this->input->post('product_title');
		$data['price'] = $this->input->post('price');
		$data['sku_code'] = $this->input->post('sku_code');
		$data['product_desc'] = $this->input->post('product_desc');
		$data['order_till'] = $this->input->post('order_slot').' '.$this->input->post('order_slot_type');
		$data['avail_at'] = json_encode($this->input->post('avail_at'));
		$data['meta_keyword'] = $this->input->post('metakey');
		$hdnID = $this->input->post('product_id');
		if (in_array('', $data)/* || (@in_array(4, $_FILES['product_img']['error']) && $hdnID == '')*/) {
			echo "<p style='color:red'>All Fields are necessary!!</p>";
			exit();
		}
		$data['search_terms'] = $this->input->post('search_terms');
		$data['pincode_block'] = $this->input->post('pincode_block').',';
		$data['pincode_block'] = str_replace(' ,',',', $data['pincode_block']);
		$data['pincode_block'] = preg_replace('/[^0-9, ]/', '', $data['pincode_block']);
		$data['addoncategory_id'] = $this->input->post('addoncategory_id') ? : 0;
		$data['tax_id'] = $this->input->post('tax_id') ? : 0;
		$data['meta_title'] = $this->input->post('metaTitle');
		$data['meta_description'] = $this->input->post('metadec');
		$data['is_personalize'] = $this->input->post('is_personalize') ? 1 : 0;
		$data['is_courier'] = $this->input->post('is_courier') ? 1 : 0;
		$config = array(
			'upload_path'   => realpath(FOLDER_ASSETS_PRODUCTUPLOAD),
			'allowed_types' => 'gif|jpg|png',
			'max_size'      => '10000',
			'encrypt_name'  => true,
		);
		if (!@in_array(4, $_FILES['product_img']['error'])) {
			$this->load->library('upload',$config);
			$Imgs = count($_FILES['product_img']['name']);
			for ($i=0; $i < $Imgs; $i++) {
				$_FILES['othrfile']['name']= $_FILES['product_img']['name'][$i];
				$_FILES['othrfile']['type']= $_FILES['product_img']['type'][$i];
				$_FILES['othrfile']['tmp_name']= $_FILES['product_img']['tmp_name'][$i];
				$_FILES['othrfile']['error']= $_FILES['product_img']['error'][$i];
				$_FILES['othrfile']['size']= $_FILES['product_img']['size'][$i];    
				if ($this->upload->do_upload('othrfile')) {
					$fileInfo[] = $this->upload->data('file_name');
				}else{
					echo $error = $this->upload->display_errors();
					exit();
				} 
			}
			$data['product_img'] = json_encode($fileInfo);
		}
		if ($hdnID != '') {
			$updateCond['product_id'] = $hdnID;
			$result = $this->product->updateProduct($updateCond,$data);
			$this->product->deleteRelation($updateCond);
			$relationBatch = array();
			$this->extracharges->removeVariation($updateCond);
			for ($i=0; $i < count($vt); $i++) {
				$variationArr[] = array(
					'charge_name' => $this->input->post('charge_name'.$vt[$i]),
					'charge_amount' => $this->input->post('charge_amount'.$vt[$i]),
					'charge_type' => $this->input->post('charge_type'.$vt[$i]),
					'is_opt' => $this->input->post('random'.$vt[$i]) ? 1 : 0,
					'product_id' => $hdnID
				);
			}
			if($variationArr[0]['charge_name'] != ''){
				$this->extracharges->insertVariation($variationArr);
			}
			//$this->extracharges->insertVariation($variationArr);
			foreach ($catArr as $r) {
				$relationBatch[] = array('product_id' => $hdnID,
					'priority' => 1,
					'rel_id' => $r);
			}
			foreach ($subArr as $r) {
				$relationBatch[] = array('product_id' => $hdnID,
					'priority' => 2,
					'rel_id' => $r);
			}
			foreach ($childArr as $r) {
				$relationBatch[] = array('product_id' => $hdnID,
					'priority' => 3,
					'rel_id' => $r);
			}
			$this->product->insertRelation($relationBatch);
		}else{
			$result = $this->product->CreateProduct($data);
			$insertedID = $this->db->insert_id();
			$relationBatch = array();
			foreach ($catArr as $r) {
				$relationBatch[] = array('product_id' => $insertedID,
					'priority' => 1,
					'rel_id' => $r);
			}
			foreach ($subArr as $r) {
				$relationBatch[] = array('product_id' => $insertedID,
					'priority' => 2,
					'rel_id' => $r);
			}
			foreach ($childArr as $r) {
				$relationBatch[] = array('product_id' => $insertedID,
					'priority' => 3,
					'rel_id' => $r);
			}
			$this->product->insertRelation($relationBatch);
			for ($i=0; $i < @count($vt); $i++) {
				$variationArr[] = array(
					'charge_name' => $this->input->post('charge_name'.$vt[$i]),
					'charge_amount' => $this->input->post('charge_amount'.$vt[$i]),
					'charge_type' => $this->input->post('charge_type'.$vt[$i]),
					'is_opt' => $this->input->post('random'.$vt[$i]) ? 1 : 0,
					'product_id' => $insertedID
				);
			}
			if($variationArr[0]['charge_name'] != ''){
				$this->extracharges->insertVariation($variationArr);
			}
		}
		
		if($result) {
			$msg = $hdnID != '' ? "Updated" : "Added";
			echo "<p style='color:green'>Product has been ".$msg."!</p>";
			echo "<script>setTimeout(function(){window.location.href = '".base_url('admin/viewProduct')."'}, 3000);</script>";
		}else{
			echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
		}
	}
	function viewProductTable()
	{
		$id = '';
		$data['products'] = $this->AdminModel->getProductDetail($id);
		$this->load->view('admin/tables/productTable',$data);	
	}
	function insertOffer()
	{
		$cond['offer_name'] = $this->input->post('offer_name');
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$check = $this->offer->checkOffer($cond);
		if (count($check) != 0) {
			echo "<p style='color:red'>Offer Name already Exists!!</p>";
		}else{
			$cond['offer_type'] = $this->input->post('offer_type');
			$cond['is_coupon'] = $this->input->post('is_coupon');
			$cond['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
			$cond['end_date'] = date('Y-m-d',strtotime($this->input->post('end_date')));
			$cond['amount'] = $this->input->post('amount');
			if (in_array('', $cond)) {
				echo "<p style='color:red'>All Fields are necessary!!</p>";
			}else{
				$config = array(
					'upload_path'   => realpath(FOLDER_ASSETS_BANNERUPLOAD),
					'allowed_types' => 'gif|jpg|png|jpeg',
					'max_size'      => '10000',
					'encrypt_name'  => true,
				);
				$fileInfo = array();
				$this->load->library('upload',$config);
				$Imgs = count($_FILES['banner']['name']);
				for ($i=0; $i < $Imgs; $i++) { 
					$_FILES['othrfile']['name']= $_FILES['banner']['name'][$i];
					$_FILES['othrfile']['type']= $_FILES['banner']['type'][$i];
					$_FILES['othrfile']['tmp_name']= $_FILES['banner']['tmp_name'][$i];
					$_FILES['othrfile']['error']= $_FILES['banner']['error'][$i];
					$_FILES['othrfile']['size']= $_FILES['banner']['size'][$i];    
					if ($this->upload->do_upload('othrfile')) {
						$fileInfo[] = $this->upload->data('file_name');
					}
				}
				if (count($fileInfo)) {
					$cond['banner'] = json_encode($fileInfo);
				}
				$result = $this->offer->createOffer($cond);
				if ($result) {
					echo "<p style='color:green'>Offer has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}
		}
	}
	function viewOfferTable()
	{
		$cond['status <'] = 2;
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['offers'] = $this->offer->getOffer($cond);
		$this->load->view('admin/tables/offerTable',$data);	
	}
	function updateOffer()
	{
		$updateCond['offer_id'] = $this->input->post('id');
		if ($this->input->post('request') == 2) {
			$data['deleted_at'] = date('Y-m-d H:i:s');
			$data['status'] = 0;
			$this->offer->updateOffer($updateCond,$data);
			echo "<p style='color:red'>You have deleted an Offer!!</p>";
			exit();
		}
		$cond2['offer_name'] = $this->input->post('offer_name');
		$cond2['offer_id !='] = $updateCond['offer_id'];
		$cond2['deleted_at'] = '0000-00-00 00:00:00';
		$check = $this->offer->checkOffer($cond2);
		if (count($check) != 0) {
			echo "<p style='color:red'>Offer Name already Exists!!</p>";
			exit();
		}
		$cond['offer_name'] = $cond2['offer_name'];
		$cond['offer_type'] = $this->input->post('offer_type');
		$cond['is_coupon'] = $this->input->post('is_coupon');
		$cond['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
		$cond['end_date'] = date('Y-m-d',strtotime($this->input->post('end_date')));
		$cond['amount'] = $this->input->post('amount');
		if (in_array('', $cond)) {
			echo "<p style='color:red'>All Fields are necessary!!</p>";
			exit();
		}
		if ($_FILES['banner']['error'][0] != 4) {
			$config = array(
				'upload_path'   => realpath(FOLDER_ASSETS_BANNERUPLOAD),
				'allowed_types' => 'gif|jpg|png|jpeg',
				'max_size'      => '10000',
				'encrypt_name'  => true,
			);
			$this->load->library('upload',$config);
			$Imgs = count($_FILES['banner']['name']);
			for ($i=0; $i < $Imgs; $i++) { 
				$_FILES['othrfile']['name']= $_FILES['banner']['name'][$i];
				$_FILES['othrfile']['type']= $_FILES['banner']['type'][$i];
				$_FILES['othrfile']['tmp_name']= $_FILES['banner']['tmp_name'][$i];
				$_FILES['othrfile']['error']= $_FILES['banner']['error'][$i];
				$_FILES['othrfile']['size']= $_FILES['banner']['size'][$i];    
				if ($this->upload->do_upload('othrfile')) {
					$fileInfo[] = $this->upload->data('file_name');
				}else{
					echo $error = $this->upload->display_errors();
					exit();
				} 
			}
			$cond['banner'] = json_encode($fileInfo);
		}
		$result = $this->offer->updateOffer($updateCond,$cond);
		if ($result) {
			echo "<p style='color:green'>Offer has been Updated!</p>";
		}else{
			echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
		}

	}
	function childListbyCat()
	{
		$cat = $this->input->post('cat');
		$result = $this->AdminModel->getChildbyCat($cat);
		echo json_encode($result);
	}
	function offerDetailApply()
	{
		$data = array();
		$offer = $this->input->post('offer');
		$cat = $this->input->post('cat');
		$child = $this->input->post('child');
		$product = $this->input->post('product');
		$batch['offer_id'] = $offer;
		if ( $offer == '') 
		{
			echo "<p style='color:red'>Please Select Offer to Apply!!</p>";
			exit();
		}
		elseif($product != '')
		{
			$batch['priority'] = 3;
			foreach ($product as $p) {
				$batch['applied_on'] = $p;
				$data[] = $batch;
			}
		}
		elseif ($child != '') 
		{
			$batch['priority'] = 2;
			foreach ($child as $c) {
				$batch['applied_on'] = $c;
				$data[] = $batch;
			}
		}
		elseif ($cat != '') 
		{
			$batch['priority'] = 1;
			foreach ($cat as $r) {
				$batch['applied_on'] = $r;
				$data[] = $batch;
			}
		}
		else
		{
			echo "<p style='color:red'>Please Select Item to Apply Offer!!</p>";
			exit();
		}
		// $deleteCond['offer_id'] = $offer;
		// $this->offer->removeOfferRelations($deleteCond);
		$result = $this->offer->addOfferDetail($data);
		if ($result) {
		// echo $result;
			echo "<p style='color:green'>Offer has been Applied Successfully!!</p>";
		}
	}
	function insertBlog()
	{
		$data['title'] = $this->input->post('title');
		$data['details'] = $this->input->post('desc');
		$data['category'] = $this->input->post('cat');
		$data['blogger_id'] = $_SESSION['adminLog'];
		if (in_array('', $data)) {
			echo "Please Enter All Required Data!!";
		}else{
			$config = array(
				'upload_path'   => realpath(FOLDER_ASSETS_BLOGUPLOAD),
				'allowed_types' => 'gif|jpg|png|jpeg',
				'max_size'      => '10000',
				'encrypt_name'  => true,
			);
			$this->load->library('upload',$config);
			if ($this->input->post('editBlog')) {
				$cond['blog_id'] = $this->input->post('editBlog');
				if (isset($_FILES['banner']) && !empty($_FILES['banner']) && $_FILES['banner']['tmp_name'] != '') {
					if ($this->upload->do_upload('banner')) {
						$data['blog_img'] = $this->upload->data('file_name');
					}else{
						echo $this->upload->display_errors();
						exit();
					}
				}
				$res = $this->blog->updateBlog($cond,$data);
				if ($res) {
					echo "Your Blog has been Updated!!";
				}
				exit();
			}
			if ($this->upload->do_upload('banner')) {
				$data['blog_img'] = $this->upload->data('file_name');
				$result = $this->blog->insertBlog($data);
				if ($result) {
					echo 'Your Blog has been submitted!';
				}
			}else{
				echo $error = $this->upload->display_errors();
			}
		}
	}
	function viewBlogTable()
	{
		$id = '';
		$data['blogs'] = $this->AdminModel->getBlogList($id);
		$this->load->view('admin/tables/blogTable',$data);	
	}
	function insertBlogCategory()
	{
		$cat = $this->input->post('txtcat');
		$desc = $this->input->post('desc');
		$check = $this->blog->checkCategory($cat);
		if (count($check) != 0) {
			echo "<p style='color:red'>Category Already Exists!</p>";
		}else {
			if(isset($_POST['catID']) && ($_POST['catID'] != '')){
				$cond['category_id'] = $this->input->post('catID');
				$newData['category_name'] = $cat;
				$result = $this->blog->updateCategory($cond,$newData);
				if ($result) {
					echo "<p style='color:green'>Category has been Updated!</p>";
				}
			}else{
				$result = $this->blog->createCategory($cat,$desc);
				if ($result) {
					echo "<p style='color:green'>Category has been Added!</p>";
				}else{
					echo "<p style='color:red'>Sorry!! Request Failed!!</p>";
				}
			}	
		}
	}
	function deleteBlogCategory()
	{
		if ($this->input->post('delete_cat')) {
			$cond['category_id'] = $this->input->post('category_id');
			$newData['deleted_at'] = date("Y-m-d H:i:s");
			$result = $this->blog->updateCategory($cond,$newData);
		}
	}
	function viewBlogCategoryTable()
	{
		$cond['deleted_at'] = '0000-00-00 00:00:00';
		$data['categories'] = $this->blog->getCategory($cond);
		$this->load->view('admin/tables/blogCategoryTable',$data);
	}
	function updateBlog()
	{
		$cond['blog_id'] = $this->input->post('blog_id');
		$data['is_live'] = $this->input->post('is_live');
		$result = $this->blog->updateBlog($cond,$data);
		if ($result) {
			echo "<p style='color:red'>Blog status is updated!!</p>";
		}
	}
	function deleteBlog()
	{
		$cond['blog_id'] = $this->input->post('blog_id');
		$result = $this->blog->deleteBlog($cond);
		if ($result) {
			echo "<p style='color:red'>Blog Has Been Deleted!!</p>";
		}
	}
	function editBlogCategory()
	{
		$cond['category_id'] = $this->input->post('category_id');
		$result = $this->blog->getCategory($cond);
		$this->output->set_output(json_encode($result));
	}
	function updateAboutUs()
	{
		$data['page_data'] = $this->input->post('txt');
		$cond['page_id'] = 1;
		$result = $this->blog->updatePageData($cond,$data);
		if ($result) {
			echo "<p style='color:green'>Page Content Updated!!</p>";
		}
	}
	function updateTerms()
	{
		$data['page_data'] = $this->input->post('txt');
		$cond['page_id'] = 2;
		$result = $this->blog->updatePageData($cond,$data);
		if ($result) {
			echo "<p style='color:green'>Page Content Updated!!</p>";
		}
	}
	function updatePrivacy()
	{
		$data['page_data'] = $this->input->post('txt');
		$cond['page_id'] = 3;
		$result = $this->blog->updatePageData($cond,$data);
		if ($result) {
			echo "<p style='color:green'>Page Content Updated!!</p>";
		}
	}
	function insertCharges()
	{
		$data['category_id'] = $this->input->post('category_id');
		$data['charge_name'] = $this->input->post('charge_name');
		$data['charge_amount'] = $this->input->post('charge_amount');
		$data['charge_type'] = $this->input->post('charge_type');
		if($this->input->post('random')){
			$data['is_opt'] = 1;
		}
		if (in_array('', $data)) {
			echo "All Fields are necessary!";
			exit();
		}
		if ($this->input->post('chargeID')) {
			$cond['charge_id'] = $this->input->post('chargeID');
			$result = $this->extracharges->updateCharge($cond,$data);
			echo "<p style='color:green'>Extra Charge has been Updated!!</p>";
			exit();
		}
		
		$result = $this->extracharges->createCharge($data);
		if ($result) {
			echo "<p style='color:green'>Extra Charge has been added to Category!!</p>";
		}
	}
	function viewChargesTable()
	{
		$cond = '';
		$data['charges'] = $this->extracharges->getCharge($cond);
		$this->load->view('admin/tables/extracharges',$data);
	}
	function editCharge()
	{
		$data['charge_id'] = $this->input->post('charge_id');
		$result = $this->extracharges->getCharge($data);
		echo json_encode($result);
	}
	function deleteCharge()
	{
		$cond['charge_id'] = $this->input->post('charge_id');
		$result = $this->extracharges->deleteCharge($cond);
		echo "<p style='color:red'>Extra Charge has been deleted!!</p>";
	}
	function viewShipRateTable()
	{
		$cond = '';
		$data['ships'] = $this->AdminModel->getShipRates($cond);
		$this->load->view('admin/tables/shipratetable',$data);
	}
	function viewTimeSlotTable()
	{
		$cond = '';
		$data['timeslots'] = $this->extracharges->getTimeSlot($cond);
		$this->load->view('admin/tables/timeSlotTable',$data);
	}
	function setShipRate()
	{

		$id = $this->input->post('shippingtype');
		$city = $this->input->post('avail_at');
		$rate = $this->input->post('shipcharge');
		$cond['shipping_id'] = $id;
		$cond['city'] = $city;
		$result = $this->AdminModel->checkShipRate($id,$city);
		$data = array();
		$shipID = array();
		$response2 = $response = 1;
		for ($i=0; $i < count($result); $i++) { 
			$shipID[] = $result[$i]->rate_id; 
			array_splice($city, array_search($result[$i]->city_id, $city),1);
		}
		for ($j=0; $j < count($city); $j++) { 
			$batch['shipping_id'] = $id;
			$batch['city_id'] = $city[$j];
			$batch['shipping_rate'] = $rate;
			$data[] = $batch;
		}
		
		$updateData['shipping_id'] = $id;
		$updateData['shipping_rate'] = $rate;
		if (!empty($shipID)) {
			$response = $this->AdminModel->updateShippingRate($shipID,$updateData);
		}
		if (!empty($data)) {
			$response2 = $this->AdminModel->batchInsert($data,'shipping_mst');
		}
		
		if ($response && $response2) {
			echo "<p style='color:green'>Success!!</p>";
		}else{
			echo "<p class='text-danger'>Failed!!</p>";
		}
	}
	function setTimeSlot()
	{
		$data['ship_id'] = $this->input->post('shippingtype');
		$data['start_time'] = $this->input->post('fromTime');
		$data['end_time'] = $this->input->post('toTime');
		$result = $this->extracharges->insertTimeSlot($data);
		if ($result) {
			echo "<p style='color:green'>Success!!</p>";
		}
	}
	function deleteTimeSlot()
	{
		$cond['timing_id'] = $this->input->post('slot_id');
		$result = $this->extracharges->deleteTimeSlot($cond);
		if ($result) {
			echo "<p style='color:red'>Deleted!!</p>";
		}
	}
	function deleteShipRate()
	{
		$cond['rate_id'] = $this->input->post('rate_id');
		$result = $this->extracharges->deleteShipRate($cond);
		if ($result) {
			echo "<p style='color:red'>Deleted!!</p>";
		}
	}
	function ListNewOrdersTable()
	{
		$cond = [];
		$cond['order_status'] = 0;
		$cond['ordsm.suborder_status'] = 0;
		if ($this->input->post('filter')) {
			if ($this->input->post('datetimerange')) {
				$data = explode('-', $this->input->post('datetimerange'));
				$cond['ordsm.ship_from >='] = date('Y-m-d H:i:s',strtotime($data[0]));
				$cond['ordsm.ship_from <='] = date('Y-m-d H:i:s',strtotime($data[1]));
			}
			if ($this->input->post('shippingtype')) {
				$cond['sht.shipping_id'] = $this->input->post('shippingtype');
			}
		}
		$data['newOrders'] = $this->AdminModel->newOrderDetailList($cond);
		$this->load->view('admin/tables/newOrderDetailTable',$data);
	}
	function viewNewOrdersTable()
	{
		$cond = [];
		$cond['order_status'] = 0;
		$cond['ordsm.suborder_status'] = 0;
		if ($this->input->post('order_id')) {
			$cond['ord.order_id'] = $this->input->post('order_id');
		}

		$data['newOrders'] = $this->AdminModel->newOrderDetailList($cond);
		$this->load->view('admin/tables/newOrderDetailTable',$data);
	}
	function viewPendingOrdersTable()
	{
		$cond = '';

		$data['pendingOrders'] = $this->AdminModel->pendingOrderList($cond);
		$this->load->view('admin/tables/pendingOrderTable',$data);
	}
	function viewForwardingOrdersTable()
	{
		$cond['ordsm.suborder_status'] = 1;
		if ($this->input->post('filter')) {
			if ($this->input->post('datetimerange')) {
				$data = explode('-', $this->input->post('datetimerange'));
				$cond['ordsm.ship_from >='] = date('Y-m-d H:i:s',strtotime($data[0]));
				$cond['ordsm.ship_from <='] = date('Y-m-d H:i:s',strtotime($data[1]));
			}
			if ($this->input->post('shippingtype')) {
				$cond['sht.shipping_id'] = $this->input->post('shippingtype');
			}
		}
		$data['forwardedOrders'] = $this->AdminModel->forwardedOrderList($cond);
		$this->load->view('admin/tables/forwardedOrderTable',$data);
	}
	function viewAcceptedOrdersTable()
	{
		$cond['ordsm.suborder_status'] = 2;
		if ($this->input->post('filter')) {
			if ($this->input->post('datetimerange')) {
				$data = explode('-', $this->input->post('datetimerange'));
				$cond['ordsm.ship_from >='] = date('Y-m-d H:i:s',strtotime($data[0]));
				$cond['ordsm.ship_from <='] = date('Y-m-d H:i:s',strtotime($data[1]));
			}
			if ($this->input->post('shippingtype')) {
				$cond['sht.shipping_id'] = $this->input->post('shippingtype');
			}
		}
		$data['acceptedOrders'] = $this->AdminModel->acceptedOrderList($cond);
		$this->load->view('admin/tables/acceptedOrderTable',$data);
	}
	function viewShippedOrdersTable()
	{
		$cond['ordsm.suborder_status'] = 3;
		if ($this->input->post('filter')) {
			if ($this->input->post('datetimerange')) {
				$data = explode('-', $this->input->post('datetimerange'));
				$cond['ordsm.ship_from >='] = date('Y-m-d H:i:s',strtotime($data[0]));
				$cond['ordsm.ship_from <='] = date('Y-m-d H:i:s',strtotime($data[1]));
			}
			if ($this->input->post('shippingtype')) {
				$cond['sht.shipping_id'] = $this->input->post('shippingtype');
			}
		}
		$data['acceptedOrders'] = $this->AdminModel->acceptedOrderList($cond);
		$this->load->view('admin/tables/acceptedOrderTable',$data);
	}
	function viewDeliveredOrdersTable()
	{
		$cond['ordsm.suborder_status'] = 4;
		if ($this->input->post('filter')) {
			if ($this->input->post('datetimerange')) {
				$data = explode('-', $this->input->post('datetimerange'));
				$cond['ordsm.ship_from >='] = date('Y-m-d H:i:s',strtotime($data[0]));
				$cond['ordsm.ship_from <='] = date('Y-m-d H:i:s',strtotime($data[1]));
			}
			if ($this->input->post('shippingtype')) {
				$cond['sht.shipping_id'] = $this->input->post('shippingtype');
			}
		}
		$data['acceptedOrders'] = $this->AdminModel->acceptedOrderList($cond);
		$this->load->view('admin/tables/acceptedOrderTable',$data);
	}

	function forwardOrderForm()
	{
		$cond =[];
		if ($this->input->post('ord_id')) {
			$cond['ordsm.order_id'] = $this->input->post('ord_id');
		}elseif($this->input->post('detail_id')){
			$cond['detail_id'] = $this->input->post('detail_id');
		}
		$data['orderData'] = $this->AdminModel->orderDetails($cond);
		$this->load->view('admin/includes/forwardOrderForm',$data);
	}
	function assignOrderToVendor()
	{
		$batch = [];
		$id = $this->input->post('HdnID');
		$data['vendor_id'] = $this->input->post('vendor_id');
		$data['vendor_price'] = $this->input->post('vendor_price');
		$data['vendor_msg'] = $this->input->post('vendor_msg');
		for ($i=0; $i < count($id); $i++) { 
			$data['detail_id'] = $id[$i];
			$batch[] = $data;
		}
		$result = $this->assigner->assignOrder($batch);
		assigneeMail($id);
		if ($result) {
			$dd['suborder_status'] = 1;
			$this->AdminModel->assignedOrderDetails($id,$dd);
			echo "Order(s) has been assigned to vendor!";
		}else{
			echo "Failed to Assign Order!";
		}
	}
	function pendingActionForm()
	{
		$cond =[];
		if ($this->input->post('detail_id')) {
			$cond['ordsm.detail_id'] = $this->input->post('detail_id');
		}
		$data['orderData'] = $this->AdminModel->orderDetails($cond);
		$this->load->view('admin/includes/forwardOrderForm',$data);		
	}
	function approveBargainPrice()
	{
		$data['detail_id'] = $this->input->post('detail_id');
		$vs = $this->input->post('response');
		if ($vs == 1) {
			if ($data['detail_id'] != '' || $data['detail_id'] != 0) {
				$acceptData['vendor_status'] = 1;
				$acceptCond['detail_id'] = $data['detail_id'];
				$response = $this->assigner->updateAssign($acceptCond,$acceptData);
				if ($response) {
					$acceptData1['suborder_status'] = 2;
					$response = $this->AdminModel->updateData($acceptCond,$acceptData1,'order_submst');
					acceptanceMailForUser($acceptCond['detail_id']);
					if ($response) {
						echo "You have accepted Order on behalf of Vendor!";
						exit();
					}

				}
			}
			echo "There is something wrong with your Request";
			exit();
		}
		$data['vendor_status'] = $vs;
		if ($data['detail_id'] != '' || $data['detail_id'] != 0) {
			$result = $this->assigner->checkAssign($data);
			$newPrice = $result[count($result)-1]->demand_price;
			$newData['vendor_price'] = $newPrice;
			$newData['vendor_status'] = 0;
			$cond['assign_id'] = $result[count($result)-1]->assign_id;
			$res = $this->assigner->updateAssign($cond,$newData);
			if($res){
				echo "New Price has been submitted to Vendor!";
			}
		}else {
			echo 'There is something Wrong with your Request';
		}
	}
	function reAssignOrder()
	{
		$id = $this->input->post('HdnID');
		$data['vendor_id'] = $this->input->post('vendor_id');
		$data['vendor_price'] = $this->input->post('vendor_price');
		$data['vendor_msg'] = $this->input->post('vendor_msg');
		$data['demand_price'] = 0;
		$data['vendor_status'] = 0;
		$cond['detail_id'] = $id[0];
		$result = $this->assigner->updateAssign($cond,$data);
		assigneeMail($id);
		if ($result) {
			echo "Order has been Reassigned to a Vendor!";
		}else{
			echo "There is some issue in reassigning Order!";
		}
	}
	function bargainOrder()
	{
		$id = $this->input->post('HdnID');
		$data['vendor_price'] = $this->input->post('last_price');
		$data['vendor_msg'] = $this->input->post('last_msg');
		$data['demand_price'] = 0;
		$data['vendor_status'] = 0;
		$data['last_bargain'] = 1;
		$cond['detail_id'] = $id[0];
		$result = $this->assigner->updateAssign($cond,$data);
		if ($result) {
			echo "Order has been Reassigned to a Vendor!";
		}else{
			echo "There is some issue in reassigning Order!";
		}
	}
	function insertCorporateOrder()
	{
		$add['user_id'] = $_SESSION['adminLog'];
		$add['name'] = $this->input->post('bill_fname');
		$add['last_name'] = $this->input->post('bill_lname');
		$add['email'] = $this->input->post('bill_email');
		$add['contact'] = $this->input->post('bill_contact');
		$add['address_1'] = $this->input->post('bill_address_1');
		$add['address_2'] = $this->input->post('bill_address_2');
		$add['pin_code'] = $this->input->post('bill_pincode');
		$add['city'] = $this->input->post('bill_city');
		$add['state'] = $this->input->post('bill_state');
		$add['is_billing'] = 1;

		$result = $this->AdminModel->insertData($add,'address_mst');
		if (!$result) {
			echo "<p class='text-danger'>Failed to insert Address!!</p>";
			exit();
		}
		$data['billing_ad'] = $this->db->insert_id();

		$add['name'] = $this->input->post('ship_fname');
		$add['last_name'] = $this->input->post('ship_lname');
		$add['email'] = $this->input->post('ship_email');
		$add['contact'] = $this->input->post('ship_contact');
		$add['address_1'] = $this->input->post('ship_address_1');
		$add['address_2'] = $this->input->post('ship_address_2');
		$add['pin_code'] = $this->input->post('ship_pincode');
		$add['city'] = $this->input->post('ship_city');
		$add['state'] = $this->input->post('ship_state');
		$add['is_billing'] = 0;

		$result = $this->AdminModel->insertData($add,'address_mst');
		if (!$result) {
			echo "<p class='text-danger'>Failed to insert Address!!</p>";
			exit();
		}
		$data['shipping_ad'] = $this->db->insert_id();

		$qty = $this->input->post('qty');
		$price = $this->input->post('price');
		$ship_price = $this->input->post('ship_price');
		$data['amount'] = ($qty*$price)+$ship_price;
		$data['user'] = $add['user_id'];
		$data['payment_status'] = 1;
		$data['ship_price'] = $ship_price;
		$result = $this->AdminModel->insertData($data,'order_mst');
		if (!$result) {
			echo "<p class='text-danger'>Failed to create Order!!</p>";
			exit();
		}
		$detail['order_id'] = $this->db->insert_id();
		$detail['product_id'] = $this->input->post('product');
		$detail['ship_from'] = date('Y-m-d H:i:s',strtotime($this->input->post('date').' '.$this->input->post('fromTime')));
		$detail['ship_till'] = date('Y-m-d H:i:s',strtotime($this->input->post('date').' '.$this->input->post('toTime')));
		$detail['qty'] = $qty;
		$detail['price'] =$price;
		$detail['ship_id'] = 1;
		$detail['city_id'] = 1;
		$extra = implode(',',array_filter($this->input->post('extra')));
		if ($extra != '') {
			$detail['extra'] = $extra;
		}
		$result = $this->AdminModel->insertData($detail,'order_submst');
		if ($result) {
			echo "<p class='text-success'>Order Added Successfully!</p>";
		}
	}
	function CustomerDetailTable()
	{
		$id = $this->input->post('id');
		if ($id == '' || $id == 0) {
			echo "<p class='text-danger'>User not Available</p>";
			exit();
		}
		$cond['ord.user'] = $id;
		$data['customerData'] = $this->AdminModel->customerOrder($cond);
		$this->load->view('admin/tables/customerOrderTable',$data);
	}
	function updateOrderStatus()
	{
		$data['suborder_status'] = $this->input->post('response');
		$cond['detail_id'] = $this->input->post('HdnID');
		if ($data['suborder_status'] != '' && 
			$cond['detail_id'] != '' && 
			$cond['detail_id'] != 0  &&
			$data['suborder_status'] != 0
		) 
		{
			$result = $this->AdminModel->updateOrderStatus($cond,$data);
			if ($result) {
				if ($data['suborder_status'] == 4) {
					$this->AdminModel->addPayment($cond['detail_id']);
					deliveredMailForUser($cond['detail_id']);
				}
				if ($data['suborder_status'] == 3) {
					shippedMailForUser($cond['detail_id']);
				}
				if ($data['suborder_status'] == 5) {
					$personalizeSubOrder = $this->AdminModel->getCondSelectedData($cond,'personalize_img','order_submst');
					if (count($personalizeSubOrder)) {
						$personalize_img = $personalizeSubOrder[0]->personalize_img;
						if ($personalize_img) {
							$personalize_array = json_decode($personalize_img);
							for ($i=0; $i < count($personalize_array); $i++) { 
								if (file_exists(FOLDER_ASSETS_PERSONALIZEUPLOAD.$personalize_array[$i])) {
									unlink(FOLDER_ASSETS_PERSONALIZEUPLOAD.$personalize_array[$i]);
								}
							}
						}
					}
				}
				echo "Success!";
			}
		}else{
			echo "Failed!";
		}
	}
	function cancelledOrderTable()
	{
		$cond['ordsm.suborder_status'] = 5;
		$data['cancelledOrders'] = $this->AdminModel->cancelledOrderList($cond);
		$this->load->view('admin/tables/cancelledOrderTable',$data);
	}
	function refundOrder()
	{
		$id = $this->input->post('HdnID');
		$res = $this->input->post('response');
		if ($res == 1 && $id != 0 && $id != '') {
			$cond['detail_id'] = $id;
			$data['suborder_status'] = 7;
			$response = $this->AdminModel->updateOrderStatus($cond,$data);
			if ($response) {
				$response2 = $this->AdminModel->deleteCashbackOrder($id);
				echo "Order has been refunded to bank Successfully!";
				exit();
			}
			echo "Request Failed Try Again";
			exit();
		}
		if ($res = 2 && $id != 0 && $id != '') {
			$response = $this->AdminModel->refundOrder($id);
			if ($response) {
				$cond['detail_id'] = $id;
				$data['suborder_status'] = 6;
				$this->AdminModel->updateOrderStatus($cond,$data);
				echo "Order has been refunded to User's Wallet!";
				exit();
			}
			echo "Request Failed Try Again";
			exit();
		}
		echo "Invalid Request, Refresh the page and Try Again!";
		exit();
	}
	function getUserInfo()
	{
		$id = $this->input->post('id');
		$cond['uid'] = $id;
		if ($this->input->post('refund_amount')) 
		{
			$data['amount'] = $this->input->post('refund_amount');
			$data['user_id'] = $cond['uid'];
			$data['trn_type'] = 'refund';
			$data['payment_type'] = 0;
			$data['order_id'] = 0;
			$data['created_at'] = date('Y-m-d H:i:s');
			$result = $this->AdminModel->insertData($data,'user_wallet');
			if ($result)
			{
				$response['status'] = true;
				$response['msg'] = 'Money Added in Wallet!';
			}
			else
			{
				$response['status'] = false;
				$response['msg'] = 'Failed to add money!';
			}
			echo json_encode($response);
			exit();
		}
		
		$data['userData'] = $this->AdminModel->getUserInfo($cond);
		$this->load->view('admin/tables/userinfo',$data);
	}
	function getVendorInfo()
	{
		$id = $this->input->post('id');
		$cond['vm.vendor_id'] = $id;
		$data['vendors'] = $this->AdminModel->getVendor($cond);
		$this->load->view('admin/tables/userinfo',$data);
	}
	function vendorWiseOrder()
	{
		$id = $this->input->post('id');
		$cond['vendor_id'] = $id;
		$cond['suborder_status >='] = 4;
		$data['vendorOrders'] = $this->AdminModel->vendorOrders($cond);
		$this->load->view('admin/tables/vendorwiseorder',$data);
	}
	function searchProduct()
	{
		if ($this->input->get('term') != null) {
			$cond['sku_code like'] = '%'.$this->input->get('term').'%';
			$cond['deleted_at'] = 0;
			$select = 'product_id as id,sku_code as label';
			$result = $this->product->getProduct($cond,$select);
			echo json_encode($result);
			exit();
		}
		if ($this->input->post('id')) {
			$cond['product_id'] = $this->input->post('id');
			$select = 'product_id,product_title,category_id,child_id';
			$result = $this->product->getProduct($cond,$select);
			if (count($result) == 0) {
				$r['err'] = 'Invalid Selection';
				echo json_encode($r);
				exit();
			}
			$output['child_name'] = getChildName($result[0]->child_id);
			$output['child_id'] = $result[0]->child_id;
			$output['product_title'] = $result[0]->product_title;
			$output['product_id'] = $result[0]->product_id;
			$output['category_id'] = $result[0]->category_id;
			$r['success'] = $output;
			$r['extraCharges'] = '';
			// Extra charge list fetch
			$charge['product_id'] = $this->input->post('id');
			$charge['is_opt'] = 0;
			$chargeList = $this->shop->getCharges($charge);
			$charge['is_opt'] = 1;
			$sizeList = $this->shop->getCharges($charge);
			$display_html = '';
			$display_html .= '<select class="form-control form-control-uniform" name="extra[]">';
			$display_html .= '<option value="">Default Size</option>';
			for ($i=0; $i < count($sizeList); $i++) { 
				$display_html .= '<option value="'.$sizeList[$i]->charge_id.'">'.$sizeList[$i]->charge_name.'</option>';
			}
			$display_html .= '</select>';
			$display_html .= '<div class="col-lg-5">';
			for ($i=0; $i < count($chargeList); $i++) { 
				$display_html .= '<div class="mb-1 form-check">';
				$display_html .= '<label class="form-check-label">';
				$display_html .= '<input type="checkbox" class="form-check-input-styled" name="extra[]" value="'.$chargeList[$i]->charge_id.'">'.$chargeList[$i]->charge_name.'</label></div>';
			}
			$display_html .= '</div><script>$(".form-check-input-styled").uniform()</script>';
			$r['extraCharges'] = $display_html;
			// Extra charge list fetch end
			echo json_encode($r);
			exit();
		}
		echo "Invalid Selection";
	}
	function loadExtraCharge()
	{
		if ($this->input->post('id')) {
			$charge['category_id'] = $this->input->post('id');
			$charge['is_opt'] = 0;
			$chargeList = $this->shop->getCharges($charge);
			$charge['is_opt'] = 1;
			$sizeList = $this->shop->getCharges($charge);
			$display_html = '';
			$display_html .= '<select class="form-control form-control-uniform" name="extra[]">';
			$display_html .= '<option value="">Default Size</option>';
			for ($i=0; $i < count($sizeList); $i++) { 
				$display_html .= '<option value="'.$sizeList[$i]->charge_id.'">'.$sizeList[$i]->charge_name.'</option>';
			}
			$display_html .= '</select>';
			$display_html .= '<div class="col-lg-5">';
			for ($i=0; $i < count($chargeList); $i++) { 
				$display_html .= '<div class="mb-1 form-check">';
				$display_html .= '<label class="form-check-label">';
				$display_html .= '<input type="checkbox" class="form-check-input-styled" name="extra[]" value="'.$chargeList[$i]->charge_id.'">'.$chargeList[$i]->charge_name.'</label></div>';
			}
			$display_html .= '</div><script>$(".form-check-input-styled").uniform()</script>';
			echo $display_html;
		}
	}


	function refundWalletTable()
	{
		$cond['ordsm.suborder_status ='] = 6;
		$data['cancelledOrders'] = $this->AdminModel->cancelledOrderList($cond);
		$this->load->view('admin/tables/refundToWalletTable',$data);
	}
	function refundBankTable()
	{
		$cond['ordsm.suborder_status ='] = 7;
		$data['cancelledOrders'] = $this->AdminModel->cancelledOrderList($cond);
		$this->load->view('admin/tables/refundToBankTable',$data);
	}

	function getCustomINData($type)
	{
		if ($type == 'child') {
			if ($this->input->post('cat')) {
				$cat = $this->input->post('cat');
				$this->db->select('childcategory_mst.child_id,childcategory_mst.child_name');
				$this->db->where_in('subcategory_mst.category_id',$cat);
				$this->db->where('subcategory_mst.deleted_at','0000-00-00 00:00:00');
				$this->db->where('childcategory_mst.deleted_at','0000-00-00 00:00:00');
				$this->db->from('childcategory_mst');
				$this->db->join('subcategory_mst','childcategory_mst.subcategory_id = subcategory_mst.subcategory_id');
				$this->db->group_by('childcategory_mst.child_id');
				echo json_encode($this->db->get()->result());
				die();
			}
		}
		if ($type = 'product') {
			$cat = array();
			$this->db->select('product_mst.product_id,product_mst.product_title');
			if ($this->input->post('cat')) {
				$cat = $this->input->post('cat');
				$this->db->where('product_category_rel.priority',1);
			}
			if ($this->input->post('child')) {
				$cat = $this->input->post('child');
				$this->db->where('product_category_rel.priority',3);
			}
			$this->db->where_in('product_category_rel.rel_id',$cat);
			$this->db->where('product_mst.deleted_at','0000-00-00 00:00:00');
			$this->db->where('product_mst.status','1');
			$this->db->from('product_mst');
			$this->db->join('product_category_rel','product_mst.product_id = product_category_rel.product_id');
			$this->db->group_by('product_mst.product_id');
			echo json_encode($this->db->get()->result());
			die();
		}
	}
	function insertTax($id = 0){
		$data['label'] = $this->input->post('label');
		$data['rate'] = $this->input->post('rate');

		if($id){
			$con['id'] = $id;
			$updateData = $this->AdminModel->updateData($con,$data,'tax_mst');
			die(json_encode([
				"status" => true,
				"message" => 'Successfully Updated Record.'
			]));
		}else{
			$insertData = $this->AdminModel->insertData($data,'tax_mst');
			die(json_encode([
				"status" => true,
				"message" => 'Successfully Inserted Record.'
			]));
		}
		die(json_encode([
			"status" => false,
			"message" => 'something went wrong.'
		]));
	}
	
	function removeTax($id){
		$con['id'] = $id;
		$data['deleted_at'] = date('Y-m-d H:i:s');
		$updateData = $this->AdminModel->updateData($con,$data,'tax_mst');
		if($updateData){
			die(json_encode([
				"status" => true,
				"message" => 'Successfully Remove Record.'
			]));
		}
		else{
			die(json_encode([
				"status" => false,
				"message" => 'Something went wrong'
			]));
		}
	}
}