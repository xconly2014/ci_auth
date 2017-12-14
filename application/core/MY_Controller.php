<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Auth_model');
        
        $uid = self::checkLogin();       
        if(!$uid){
            redirect(site_url('login/index'));
        }
        
        
        
        if(!$this->Auth_model->check($this->uri->segment(1).'/'.$this->uri->segment(2),
            $uid,
            $type = 1,
            $mode='url',
            $relation='or')){
                echo '您没有访问权限';exit;
        }        
    }
    
    private function checkLogin(){
        if(empty($_SESSION['user']['userid'])) return false;
        return $_SESSION['user']['userid'];
    }
    
    //分页方法
    public function getPage($page_num,$base_url,$total){
        $this->config->load('pagination');      //加载分页配置
        $config = $this->config->item('page'); //读取分页配置
        
        $config['per_page']=$page_num;
        $config['base_url']=$base_url;//site_url("operation/feedback");
        $config['total_rows'] = $total;//$res['total'];
        
        $this->load->library('pagination');// 加载分页类
        $this->pagination->initialize($config);
        $page = $this->pagination->create_links();
        return $page;
    }
    
    //书写日志
    public function autolog($target='')
    {   
        $url = uri_string();
        
        $this->load->model('Auth_group_model');
        $action = $this->Auth_group_model->getRuleByName($url)['title'];
        $module = $this->config->item('module')[$this->uri->segment(1)];
        
        $data = array(
            'module' => $module,
            'action' => $action,
            'uname' => $_SESSION['user']['username'],
            'target' => $target,
            'create_time' => date('Y-m-d H:i:s'),
        );
//         var_dump($data);
        $this->load->model('Action_log_model');
        $this->Action_log_model->writeLog($data);
    }
}