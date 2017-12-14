<?php
class User_model extends CI_Model
{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('master', true);
	}
	
	//登陆验证
	
	public function checkUser($username,$pwd,$logo_flag = false){
	    $where = array('username' => $username, 'password' => md5($pwd), 'status' => 1);
	    $check_in_db = $this->db->get_where('admin_user', $where)->row_array();
	    if ($check_in_db)
	    {
	        if($logo_flag){//更新登录状态
	            $data = array(
	                'login_count' => $check_in_db['login_count']+1,
	                'login_time' => date('Y-m-d H:i:s', time()),
	                'ip' => $_SERVER['REMOTE_ADDR']
	            );
	            $this->db->update('admin_user', $data, $where);
	        }	        
	        return array('ack' => true, 'msg' => '', 'data' => $check_in_db);
	    }
	    else
	    {
	        return array('ack' => false, 'msg' => '请填写正确的用户名和密码！');
	    }
	}
	
	//修改登录密码
	public function updatePwd($username,$new_pwd){
	    $where = array('username' => $username);
	    $data = array('password' => md5($new_pwd));
	    return $this->db->update('admin_user', $data, $where);
	}
	
	//创建用户
	public function create($username, $password, $group_id,$status=1)
	{
		$user = $this->db->get_where('admin_user', array('username' => $username))->row_array();
		if ($user['id'])
		{
			return array('ack' => false, 'msg' => '用户名已存在！', 'user_id' => $user['id']);
		}
		else
		{
			$this->db->insert('admin_user', array('username' => $username, 'password' => md5($password), 'create_time' => date('Y-m-d H:i:s', time())));
			//获取插入数据id
			$uid = $this->db->insert_id();
			if($uid){
			    $flag = $this->db->insert('auth_group_access', array('uid' => $uid,'group_id' => $group_id));
			    
			    if($flag){
			        return array('ack'=> true, 'msg' => '新增用户成功');
			    }else{
			         //插入权限表失败后删除该用户
			        $this->db->delete('admin_user',array('id'=>$uid));
			        return array('ack'=> true, 'msg' => '新增用户失败');
			    }
			}else{
			    return array('ack'=> true, 'msg' => '新增用户失败');
			}
			
		}
	}
	
	//删除用户
	public function del($data, $where)
	{
		return $this->db->update('admin_user' , $data, $where);
	}
	
	public function updateAuth($data,$where){
	    return $this->db->update('auth_group',$data,$where);
	}
	
	//获取后台用户列表
	public function getUserList()
	{
	    $sql = "select A.*,C.id as access_id,D.title from admin_user as A
    	LEFT JOIN auth_group_access as C ON C.uid = A.id
    	LEFT JOIN auth_group as D ON C.group_id = D.id where A.status = 1 and D.status = 1";
	    $data = $this->db->query($sql)->result_array();
	    
	    return empty($data) ? '' : $data;
	}
	
	//获取权限组
	 public function getGroup()
	 {
	     $data =  $this->db->get('auth_group')->result_array();
	     return empty($data) ? '' : $data;
	 }
	
	 //获取用户基本信息
	 public function getUserInfo($id)
	 {
		return $this->db->get_where('admin_user', array('id' => $id))->row_array();
	 }
	 
	 //更新组成员关系
	 public function updateGroup($uid,$group_id)
	 {
	     $where = array('uid' => $uid);
	     $data = array( 'group_id' => $group_id);
	     $res =  $this->db->update('auth_group_access', $data, $where);
	     if($res){
	         return true;
	     }
	      
	 }
	 
	 //获取全部规则
	 public function getAllRule()
	 {
	     $sql = "select id,title,m_id from auth_rule order by id asc";
	     return $this->db->query($sql)->result_array();
	 }
	 
	 public function insertGroup($where){
	     return $this->db->insert('auth_group', $where);
	 }
}
