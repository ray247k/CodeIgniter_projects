<?php
//application/models
class News_model extends CI_Model {
	//初始化Model建構子
    public function __construct()
    {
    	//載入資料庫物件
    	$this->load->database();
    }
}
//--------------------------------------------------------------------
public function get_news($slug = FALSE)
{
        if ($slug === FALSE)
        {
                $query = $this->db->get('news');
                return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
}