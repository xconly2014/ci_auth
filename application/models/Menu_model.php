<?php 
class Menu_model extends CI_Model{
    private $db;
    private $table_name = 'menu';
    
    function __construct(){
        parent::__construct();
        $this->db=$this->load->database('master',true);
    }
    
    public function getTopMenu(){
        $sql = "select id,title,bg_img,parent_id from $this->table_name where parent_id = 0 order by id asc";
        return $this->db->query($sql)->result_array();
    }
    
    
    public function getSubMenu(){
        $sql = "select id,title,r_id,parent_id from $this->table_name where parent_id <> 0 order by parent_id asc";
        return $this->db->query($sql)->result_array();
    }
    
    public function getMenu(){
        $this->load->model('Auth_model');
        $data = $this->Auth_model->getGroups($_SESSION['user']['userid']);
        //var_dump($data);exit;
        
        $rids = $data[0]['rules'];
        
        $sql = "select A.title,A.r_id,A.parent_id,B.name from $this->table_name  as A
		LEFT JOIN auth_rule as B on A.r_id = B.id
		where A.r_id in($rids) order by A.r_id asc";
        
        $result = $this->db->query($sql)->result_array();
        
        $top = $this->getTopMenu();
        
        $m_num = count($result);
        $t_num = count($top);
        
        for($j = 0; $j< $m_num; $j++ ){
            
            for($i = 0; $i < $t_num; $i++){
                if($result[$j]['parent_id'] == $top[$i]['id']){
                    $info[$i]['img'] = $top[$i]['bg_img'];
                    $info[$i]['title'] = $top[$i]['title'];
                    $info[$i]['sub'][] = $result[$j];
                }
            }
        }
        return $info;
        
    }
}