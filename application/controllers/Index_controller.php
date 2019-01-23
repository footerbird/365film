<?php
class Index_controller extends CI_Controller {
    
    public function index(){//电影首页
        
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
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //通过文章模型类中的get_articleCount()方法得到行数，
        $count = $this->article->get_articleCount('');
        
        $page = 1;//默认页码为1
        
        $page_size = 20;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        switch($page){
          case 1:
            $num_links = 4;//num_links选中页右边的个数
            break;
          case 2:
            $num_links = 3;
            break;
          case ceil($count/$page_size):
            $num_links = 4;
            break;
          case ceil($count/$page_size)-1:
            $num_links = 3;
            break;
          default:
            $num_links = 2;
            break;
        }
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'page/';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        
        //get_articleList方法得到电影列表
        $article_list = $this->article->get_articleList('',$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->pagination->initialize($config);
        
        //get_articleRank方法得到时光网TOP100列表
        $article_rank = $this->article->get_articleRank(0,5);
        $data['article_rank'] = $article_rank;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        $data['nation'] = 'all';
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
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