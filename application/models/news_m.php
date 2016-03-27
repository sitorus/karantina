<?php
class News_m  extends CI_Model  {


	protected $table_name = "tbl_news";
	protected $table_category = "tbl_news_category";
	protected $table_tag = "tbl_news_tag";
	protected $table_tag_trans = "view_tbl_news_tag_trans";
	protected $primary_keys = array();
	var $sess = "";
	
	function __construct()
    {
        parent::__construct();
    	$this->sess = $this->session->userdata("lang");
	}
	
	function get_latest_news($limit = 5)
	{
		$this->db->limit($limit);
		$this->db->order_by("id_news desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
	function get_list($limit=0, $offset=0, $id_news_category=NULL)
	{
		if( !empty($id_news_category) )
			$this->db->where(array("id_news_category"=>$id_news_category));
		
		$this->db->order_by("id_news desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	function get_detail($id_news=NULL)
	{
		$this->db->where(array("id_news"=>$id_news));
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function get_count($id_news_category=NULL)
	{
		if( !empty($id_news_category) )
			$this->db->where(array("id_news_category"=>$id_news_category));
		return $this->db->count_all_results($this->table_name);
	}
	
	public function get_category($where=NULL)
	{
		if( !empty($where) )
			$this->db->where($where);
		
		if( $this->sess == "id" )
			$this->db->order_by("news_category_id asc");
		else
			$this->db->order_by("news_category_en asc");
			
		$query = $this->db->get($this->table_category);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	public function get_tags($where=NULL)
	{
		if( !empty($where) )
			$this->db->where($where);

		if( $this->sess == "id" )
			$this->db->order_by("news_tag_id asc");
		else
			$this->db->order_by("news_tag_en asc");
		$query = $this->db->get($this->table_tag);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	public function get_detail_tags($id_news=NULL)
	{	
		$this->db->where(array("id_news"=>$id_news));
		$query = $this->db->get($this->table_tag_trans);
		return $query->result();
	}
}