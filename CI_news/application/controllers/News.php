<?php
class News extends CI_Controller {

    public function __construct()
    {
        //呼叫父類別（CI_Controller）的建構子
        parent::__construct();
        //載入model， 讓它可以在這個控制器的其它方法中被使用。
        $this->load->model('news_model');
    }

    public function index()
    {
        /*
		從news_model使用get_news()取得資料，存成陣列data
		data['news']也是陣列，故此為二維陣列
		*/
        
        $data['news'] = $this->news_model->get_news();
        $data['title'] = '新聞模組';
        //載入view並且把$data傳入
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item']))
        {
                show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }    
}