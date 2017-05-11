<?php
class News_model extends CI_Model {
    public function __construct()
    {
        //繼承 CI_Model ，並載入資料庫物件。
        //這使得我們可以使用 $this->db 這個物件來存取資料庫類別。
        $this->load->database();
    }

    public function get_news($slug = FALSE)
    {
        //取得資料庫中的所有文章，取得所有的新聞資料，也可以根據新聞的 slug 來查詢。
        if ($slug === FALSE)
        {
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }
}