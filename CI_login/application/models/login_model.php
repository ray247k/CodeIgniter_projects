<?php 
//this is the Model in the folder "application/models"
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();//使用 parent::__construct() 進行父類別初始化
     }

     //get the username & password from tbl_usrs這個資料庫
     function get_user($usr, $pwd)
     {
          $sql = "select * from tbl_usrs where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status = 'active'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
}

 ?>