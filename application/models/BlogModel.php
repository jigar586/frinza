<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogModel extends CI_Model 
{
	function getBlogs($cond,$limit)
	{
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$this->db->where($cond);
		$this->db->select('blog.blog_id,blog.title,blog.details,blog.blog_img,blog.updated_at,blog.category,cat.category_name');
		$this->db->order_by('updated_at','DESC');
		$this->db->from('blog_mst as blog');
		$this->db->join('blogcategory_mst as cat','blog.category = cat.category_id','left');
		$sql = $this->db->get();
		return $sql->result();
	}
	function getRandomBlogList($cond,$id)
	{
		$cond['blog_id !='] = $id;
		$this->db->where($cond);
		$this->db->select('blog_id,title,blog_img,updated_at');
		$this->db->order_by('rand()');
		$sql = $this->db->get('blog_mst');
		return $sql->result();
	}
	function getBlogCategories($cond)
	{
		$this->db->where($cond);
		$this->db->select('category_id,category_name');
		$sql = $this->db->get('blogcategory_mst');
		return $sql->result();
	}
	function getBlogCount($id)
	{
		$cond['cat.category_id'] = $id;
		$cond['blog.is_live'] = 1;
		$this->db->where($cond);
		$this->db->select('COUNT(blog.blog_id) as count');
		$this->db->from('blogcategory_mst as cat');
		$this->db->join('blog_mst as blog','blog.category = cat.category_id','left');
		$sql = $this->db->get();
		return $sql->result();
	}
	function checkComment($data)
	{
		$this->db->where($data);
		$this->db->select('c_id');
		$sql = $this->db->get('comment_mst');
		return $sql->result();
	}
	function insertComment($data)
	{
		return $this->db->insert('comment_mst',$data);
	}
	function getComments($id)
	{
		$data['blog_id'] = $id;
		$this->db->where($data);
		$this->db->select('c_name,c_detail,created_at');
		$this->db->order_by('created_at','DESC');
		return $this->db->get('comment_mst')->result();
	}	
}