<?php 
class Auth_group_model extends CI_Model{
    private $db;
    private $table_name = 'auth_group';
    function __construct(){
        parent::__construct();
        $this->db=$this->load->database('master',true);
    }
    
    public function getGroupList(){
        $sql = "select id,title from $this->table_name where status = 1 order by id asc ";
        
        $data = $this->db->query($sql)->result_array();
        return empty($data)? '': $data;
    }
    
    public function getGroupById($id){
        $sql = "select id,title, rules from $this->table_name where status = 1 and id = $id";
        $data = $this->db->query($sql)->row_array();
        $data['rules'] = explode(',', $data['rules']);
        return $data;
    }
    
    //根据用户组查询appid
    public function getGroupByUid($uid){
        $res = $this->db->select('group_id')->get_where('auth_group_access',array('uid' => $uid))->result_array();
        $count = count($res);
        if($count>1){
            $apps = '';
            foreach($res as $value){
                $result = $this->db->get_where($this->table_name,array('status' =>1,'id' => $value['group_id']))->row_array();
                $apps .= $result['app_ids'].',';
            }
            $data['app_ids'] = array_unique(explode(',',$apps));
        }else{
            $result = $this->db->get_where($this->table_name,array('status' =>1,'id' => $res[0]['group_id']))->row_array();
            $data['app_ids'] = explode(',', $result['app_ids']);
        }
        
        return $data;
        
    }
    
    
    //获取权限值by URI
    public function getRuleByName($name){
        $sql = "select id,title,m_id from auth_rule where name='$name'";
        return $this->db->query($sql)->row_array();
    }
}