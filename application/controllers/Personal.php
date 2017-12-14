<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends CI_Controller {
    
    private function checkLogin(){
        if(empty($_SESSION['user']['userid'])) return false;
        return $_SESSION['user']['userid'];
    }
    
    public function index(){
        $islogin = self::checkLogin();
        if(!$islogin){
            redirect(site_url('login/index'));
        }
        $data['title'] = '首页 - 管理后台';
        
        $this->load->view('personal/index',$data);
    }
    
    public function changePwd(){
        if($this->input->is_ajax_request()){
            $old_pwd = $this->input->post('old_pwd');
            $new_pwd = $this->input->post('new_pwd');
            $this->load->model('User_model');
            $check = $this->User_model->checkUser($_SESSION['user']['username'],$old_pwd);
            if(!$check['ack']){
                exit(json_encode(array('ack' => false, 'msg' => '旧密码输入错误')));
            }
            $update = $this->User_model->updatePwd($_SESSION['user']['username'],$new_pwd);
            
            if($update){
                exit(json_encode(array('ack' => true, 'msg' => '修改成功')));
            }else{
                exit(json_encode(array('ack' => false, 'msg' => '旧密码输入错误')));
            }
        }else{
            $data['title'] = '修改登录密码';
            
            $this->load->view('personal/changepwd',$data);
        }
    }
    
}