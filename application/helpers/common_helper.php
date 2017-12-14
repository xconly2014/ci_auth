<?php
    function get_menu(){
       $CI=&get_instance();
       $CI->load->model('Menu_model');
       
       return $CI->Menu_model->getMenu();
    }
    
    
    function curlGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,500);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE); 
        
        curl_close($ch);
        
        if ($response === FALSE) {
            echo "cURL Error: " . curl_error($ch);
        }
        
        if($httpCode == 200){
            return json_decode($response,true);
        }else{
            return $httpCode;
        }
        
    }
    
    function curlPost($url, $param= array())
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//         curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
//         curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($param));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,500);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE); 
        curl_close($ch);
        
        if($httpCode == 200){
            return json_decode($response,true);
        }else{
            return $httpCode;
        }
    }
    
    /* 
     * $array 要排序的数组
     * $row  排序列
     * $type 排序类型[asc or desc]
     * return 排好序的数组
     */
    function array_sort($array,$row,$type){
        $array_temp = array();
        foreach($array as $v){
            $array_temp[$v[$row]] = $v;
        }
        if($type == 'asc'){
            ksort($array_temp);
        }elseif($type='desc'){
            krsort($array_temp);
        }
        return $array_temp;
    }