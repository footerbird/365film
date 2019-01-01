<?php
class Index_controller extends CI_Controller {
    
    public function index(){//文章首页
        
        //301重定向，将365film.com.cn跳转到www.365film.com.cn
        $the_host = $_SERVER['HTTP_HOST'];//取得当前域名   
        $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面是否有参数   
        
        if($the_host == '365film.com.cn')//把这里的域名换上你想要的   
        {
            header('HTTP/1.1 301 Moved Permanently');//发出301头部   
            header('Location: http://www.365film.com.cn/');//跳转到你希望的地址格式   
            exit;
        }
        
//      if($the_host != 'www.365film.com.cn')//把这里的域名换上你想要的   
//      {
//          header('HTTP/1.1 301 Moved Permanently');//发出301头部   
//          header('Location: http://www.365film.com.cn'.$request_uri.'?redirect='.$the_host);//跳转到你希望的地址格式   
//          exit;
//      }
        
        $this->load->library('user_agent');
        
        $redirect = $this->input->get_post('redirect');//得到重定向host
        if($redirect){
            $data['redirect'] = $redirect;
        }
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_index',$data);
    
    }
    
}
?>