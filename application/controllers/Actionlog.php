<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actionlog extends MY_Controller {
    
    function __construct()
    {   
        parent::__construct();
    }
    
    //操作日志
    public function log(){
        $data['title'] = '操作日志 - 系统日志';
        
        $curr_page = !empty($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
        $page_num = 5;//每页显示数量
        
        $uname = $this->input->get('uname');
        $target = $this->input->get('target');
        
        $where = array();
        if(!empty($uname)){
            $where['uname'] = $uname;
        }
        if(!empty($target)){
            $where['target'] = $target;
        }
        
        $this->load->model('Action_log_model');
        
        $offset = ($curr_page -1)*$page_num;
        $res = $this->Action_log_model->getLog($page_num,$offset,$where);
        $data['list'] = $res['list'];
        //获取分页
        $data['page'] = parent::getPage($page_num, site_url("actionlog/log?uname=".$uname."&target=".$target), $res['total']);
                
        $this->load->view('actionlog/log',$data);
    }
}