<?php
class Link_m  extends CI_Model  {


	protected $table_name = "tbl_link";
	protected $primary_keys = "id_link";
	var $sess = "";

	function __construct()
    {
        parent::__construct();
		$this->sess = $this->session->userdata("lang");
    }
	
	function get_list()
	{
		if( $this->sess == "id" )
			$this->db->order_by( "title_id desc");
		else
			$this->db->order_by( "title_en desc");
		$query = $this->db->get($this->table_name);		
		return $query->result();
	}
	
}