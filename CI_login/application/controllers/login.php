<?php 
//This is the Controller in the folder "application/controllers"
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class login extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');//啟用並且初始化session

          /*
          補助函數協助你處理特定的任務。每個補助函數檔案就是一些特定用途函數的集合。
          有 URL 補助函數，協助產生連結
          有 Form 補助函數，協助你產生表單元素
          有 Text 補助函數，從事各種文字格式化工作
          有 Cookie 補助函數，可設定及讀取cookies
          有 File 補助函數，協助你處理檔案等等。
          */

          $this->load->helper('form');//表單元素輔助函數
          $this->load->helper('url');//產生連結輔助函數
          $this->load->helper('html');//輔助 html 操作的相關函數
          $this->load->database();//連接資料庫，設定方法看 https://codeigniter.org.tw/userguide3/database/connecting.html
          $this->load->library('form_validation');//載入表單驗證函數
          //load the login model
          $this->load->model('login_model');
     }

     public function index()
     {
          //取得view傳來的post資料
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");

          //set validations 傳送驗證，set_rules(來源欄位名稱,自訂的欄位暱稱,驗證規則required是必填欄位規則)
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails 未輸入數值，驗證失敗=>重新載入view
               $this->load->view('login_view');
          }
          else
          {
               //validation succeeds 有輸入內容，驗證成功，進行比對
               if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->login_model->get_user($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
                         //set the session variables
                         $sessiondata = array(
                              'username' => $username,
                              'loginuser' => TRUE
                         );
                         $this->session->set_userdata($sessiondata);
                         redirect("index");
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect('login/index');
                    }
               }
               else
               {
                    redirect('login/index');
               }
          }
     }
}

 ?>