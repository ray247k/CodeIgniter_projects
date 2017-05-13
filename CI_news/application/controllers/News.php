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
    //將使用 Form 驗證程式庫檢查是否有表單被送出，以及送出的資料是否通過驗證規則。
    public function create()
    {
        //載入 Form 輔助函式以及 Form Validation 程式庫
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';
        //set_rules() 方法需要三個參數，輸入欄位的名稱，用來顯示在錯誤訊息中的名稱，以及規則。
        //在這個例子中使用的規則，用來表示標題及內文都是必要的欄位。
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
    }    
}