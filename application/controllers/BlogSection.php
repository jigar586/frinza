<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogSection extends CI_Controller {

	function __construct() 
	{ 
         parent::__construct();
         $this->load->model('BlogModel');
   	}
	public function blog()
	{
		$cond['is_live'] = 1;
		$data['blogs'] = $this->BlogModel->getBlogs($cond,0);
		$data['randomBlogs'] = $this->BlogModel->getRandomBlogList($cond,0);
		$cond2['deleted_at'] = '0000-00-00 00:00:00';
		$data['blogCategories'] = $this->BlogModel->getBlogCategories($cond2);
		$this->load->view('blog',$data);
	}
	public function categoryBlog($id,$name)
	{
		$cond['is_live'] = 1;
		$cond['category'] = $id;
		$data['blogs'] = $this->BlogModel->getBlogs($cond,0);
		$data['randomBlogs'] = $this->BlogModel->getRandomBlogList($cond,0);
		$cond2['deleted_at'] = '0000-00-00 00:00:00';
		$data['blogCategories'] = $this->BlogModel->getBlogCategories($cond2);
		$this->load->view('blog',$data);
	}
	public function singleBlog($id,$name)
	{
		$cond['is_live'] = 1;
		$data['randomBlogs'] = $this->BlogModel->getRandomBlogList($cond,$id);
		$cond['blog_id'] = $id;
		$data['blog'] = $this->BlogModel->getBlogs($cond,1);
		$cond2['deleted_at'] = '0000-00-00 00:00:00';
		$data['blogCategories'] = $this->BlogModel->getBlogCategories($cond2);
		$data['comments'] = $this->BlogModel->getComments($id);
		$this->load->view('singleBlog',$data);
	}
	public function insertComment()
	{	
		$data['blog_id'] = $this->input->post('txthdn');
		$data['c_email'] = $this->input->post('user_email');
		$check = $this->BlogModel->checkComment($data);
		if(count($check) != 0){
			echo "<p style='color:red'>You can comment only once on one Blog!</p>";
			exit();
		}
		$data['c_name'] = $this->input->post('user_name');
		$data['c_email'] = $this->input->post('user_email');
		$data['c_detail'] = $this->input->post('comment');
		if (in_array('', $data)) {
			echo "<p style='color:red'>Please Fill All Details!</p>";
			exit();
		}
		$result = $this->BlogModel->insertComment($data);
		if ($result) {
			echo "<p style='color:green'>Thank You for Commenting on this Blog</p>";
		}else{
			echo "<p style='color:red'>You can't comment!!</p>";
		}
	}
}
