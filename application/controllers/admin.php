<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	var $data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$timezone = @date_default_timezone_get();
        if (!isset($timezone) || $timezone == '') {
            $timezone = @ini_get('date.timezone');
        }
        if (!isset($timezone) || $timezone == '') {
            $timezone = 'UTC';
        }
        date_default_timezone_set($timezone); 
		
		$member_in = $this->_is_member_in();

		if( empty($member_in) )
		{
			$message = '<div class="alert alert-danger" role="alert"><strong>Peringatan!</strong> Akses ditolak </div>';
			$this->session->set_flashdata('pesan', $message);
			redirect("login");
		}
		
		$sitemap = $this->data_sitemap();
		$data = array(
			"sitemap"=>$sitemap
		);
		
		$this->data = $data;
	}
	
	public function _is_member_in()
	{
		return $this->session->userdata("log_in");
	}
	
	function get_change_by_callback($post_array) {
		$member_in = $this->_is_member_in();
		
		$post_array['modified_by'] = $member_in["id_user"];
		return $post_array;
	}
	
	public function format_date_callback($date)
	{
		
		if(!empty($date))
		{
			$arr_date_time = explode(" ", $date);
			$arr_date = explode("-", $arr_date_time[0]);
			$time = isset($arr_date_time[1])?$arr_date_time[1]:"";
			$date = $arr_date[2] . "/" . $arr_date[1] . "/" . $arr_date[0] . " " . $time; 
		}
		else
		{
			$date = "";
		}
		return $date;
	}
	
	public function data_sitemap()
	{
		$this->load->model("sitemap_m");
		$sitemap = $this->sitemap_m->get_admin_sitemap(array("sitemap_level"=>"2"));
		foreach( $sitemap as $row )
		{
			$id_parent = $row->id_sitemap;
			$where = array("id_parent"=>$id_parent, "sitemap_level"=>"3");
			$row->sub_sitemap = $this->sitemap_m->get_admin_sitemap($where);
		}
		return $sitemap;
	}
	
	public function get_sitemap()
	{
		return $this->data;
	}

	public function index()
	{
		$this->news();
	}
	
	public function news()
	{	
		
		try{
			$crud = new grocery_CRUD();
			$crud->set_table('tbl_news');
			$crud->set_subject('Berita');
			
			$crud->set_relation('modified_by','tbl_user','email');
			$crud->set_relation('id_news_category','tbl_news_category','news_category_id');
			
			$crud->set_relation_n_n('tag', 'tbl_news_tag_trans', 'tbl_news_tag', 'id_news', 'id_news_tag','news_tag_id');
			
			$crud->set_field_upload('picture','assets/uploads/picture');
			
			$crud->required_fields('date', 'title_id', 'title_en', 'text_id', 'text_en');
			
			$crud->add_fields('date', 'id_news_category', 'title_id', 'title_en', 'text_id', 'text_en', 'picture', 'picture_caption_id', 'picture_caption_en','tag', 'modified_by', 'modified_date');
			$crud->edit_fields('date', 'id_news_category', 'title_id', 'title_en', 'text_id', 'text_en', 'picture', 'picture_caption_id', 'picture_caption_en','tag', 'modified_by', 'modified_date');
			
			$crud->display_as('date','Tanggal')
				 ->display_as('title_id','Judul (Indonesia)')
				 ->display_as('title_en','Judul (English)')
				 ->display_as('text_id','Isi (Indonesia)')
				 ->display_as('text_en','Isi (English)')
				 ->display_as('picture','Gambar (jpg, png)')
				 ->display_as('modified_by', 'Input / Edit oleh')
				 ->display_as('modified_date', 'Input / Edit Tanggal')
				 ->display_as('id_news_category', 'Kategori')
				 ->display_as('tag', ' Tag ')
				 
				 ;
			$crud->columns('id_news_category', 'title_id', 'title_en', 'text_id', 'text_en');
			
			$crud->callback_before_update(array($this,'get_change_by_callback'));
			$crud->callback_before_insert(array($this,'get_change_by_callback'));
			$crud->callback_field('modified_date',array($this,'format_date_callback'));
			
			$crud->change_field_type('modified_by','readonly');
			$crud->change_field_type('modified_date','readonly');
			
			$crud->order_by('id_news','desc');
			$crud->unset_read();
			
			$sitemap = $this->get_sitemap();
			
			$output = $crud->render($sitemap);
			$this->load->view('admin/themes/default', $output);

		} catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
}