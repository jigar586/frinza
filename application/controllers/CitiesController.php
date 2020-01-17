<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CitiesController extends CI_Controller {
    function ProductCities($id, $name)
    {
        $this->load->model('UserModel');
        $cond['sm.subcategory_id'] = $id;
		$cond['chm.deleted_at'] = '0000-00-00 00:00:00';
        $cond['chm.is_active'] = 1;
        $join = [];
        $extraFilters = array();
		$extraFilters['result_type'] = 'object';		
        $select = 'child_id,child_name,IFNULL(child_heading, child_name) as child_heading, category_name, subcategory_name';
        $join[] = [
            "table" => 'subcategory_mst as sm',
            "on" => 'sm.subcategory_id = chm.subcategory_id',
            "type" => 'inner'
        ];
        $join[] =[
            "table" => 'category_mst as cm',
            "on" => 'cm.category_id = sm.category_id',
            "type" => 'inner'
        ];
        $data['citiesList'] = $this->UserModel->getSelectWithJoinData($cond,'childcategory_mst as chm', $join, $select, $extraFilters);

        $con['subcategory_id'] = $id;
        $select = 'meta_title, meta_description, meta_keyword, IFNULL(subcategory_heading, subcategory_name) as subcategory_heading';
        $data['categoryDetails'] = $this->UserModel->getCondSelectedData($con,$select,'subcategory_mst');

        $this->load->view('cities',$data);
    }

}