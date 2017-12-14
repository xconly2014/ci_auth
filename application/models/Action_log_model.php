<?php 
class Action_log_model extends CI_Model{
    private $db;
    private $table_name = 'action_log';
    function __construct(){
        parent::__construct();
        $this->db=$this->load->database('master',true);
    }
    
    public function writeLog($data)
    {
        return $this->db->insert($this->table_name, $data);
    }
    
    //获取操作日志
    public function getLog($page_num,$offset,$where){
        $result = $this->db->limit($page_num,$offset)->where($where)->order_by('id','DESC')->get($this->table_name)->result_array();
        
        $res = $this->db->select('id')->where($where)->get($this->table_name)->result_array();
        $count = count($res);
        
        return array('list' => $result,'total' => $count);
    }
}