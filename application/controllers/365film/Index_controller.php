<?php
class Index_controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        if(in_array($_SERVER["REMOTE_ADDR"],$this->config->item('forbid_ips'))){
            die("Your IP Address is forbiden to view this page!");
        }
    }
    
    public function article_pagination($page){//首页分页
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //通过文章模型类中的get_articleCount()方法得到行数，
        $count = $this->article->get_articleCount('');
        
        if(!isset($page) || !is_numeric($page)){
            redirect(base_url());
            exit;
        }
        
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
        
        //通过文章模型类中的get_articleCountbyType()方法得到类型数量，
        $type_arr['dongzuo'] = '动作';
        $type_arr['xiju'] = '喜剧';
        $type_arr['kongbu'] = '恐怖';
        $type_arr['kehuan'] = '科幻';
        $type_arr['juqing'] = '剧情';
        foreach($type_arr as $key => $item){
        		$type_count[$key] = $this->article->get_articleCountbyType($item);
        }
        $data['type_count'] = $type_count;
        
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
        
        $data['styles'] = array(
        		'/htdocs/365film/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
        		'/htdocs/365film/js/swiper.min.js?'.CACHE_TIME
        );
        
        $this->load->view('365film/article_index',$data);
        
    }
    
    public function article_list($article_nation){//电影列表
        
        if($article_nation == ''){
            redirect(base_url());
            exit;
        }
        
        switch ($article_nation) {
        case 'cn':
            $nation = '大陆';
            break;
        case 'us':
            $nation = '美国';
            break;
        case 'hk':
            $nation = '香港';
            break;
        case 'jp':
            $nation = '日本';
            break;
        case 'ue':
            $nation = '欧美';
            break;
        case 'kr':
            $nation = '韩国';
            break;
        case 'tw':
            $nation = '台湾';
            break;
        case 'th':
            $nation = '泰国';
            break;
        case 'in':
            $nation = '印度';
            break;
        case 'fr':
            $nation = '法国';
            break;
        case 'uk':
            $nation = '英国';
            break;
        case 'de':
            $nation = '德国';
            break;
        case 'ru':
            $nation = '俄罗斯';
            break;
        default:
            $nation = '';
            break;
        }
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleList方法得到电影列表
        $article_list = $this->article->get_articleList($nation,0,10);
        $data['article_list'] = $article_list;
        
        //get_articleRank方法得到时光网TOP100列表
        $article_rank = $this->article->get_articleRank(0,5);
        $data['article_rank'] = $article_rank;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        $data['nation'] = $article_nation;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>'365电影网 - '.$nation.'频道 | 天天影院',
            'seo_keywords'=>'365电影网,2019最新电影,热播电影,'.$nation.'频道,天天影院',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_list',$data);
    }
    
    public function get_articleListAjax_tpl(){//电影列表加载更多（模板加載）
        
        $article_nation = $this->input->get_post('nation');//得到电影国家
        $article_nation = $article_nation?$article_nation:'';
        switch ($article_nation) {
        case 'cn':
            $nation = '大陆';
            break;
        case 'us':
            $nation = '美国';
            break;
        case 'hk':
            $nation = '香港';
            break;
        case 'jp':
            $nation = '日本';
            break;
        case 'ue':
            $nation = '欧美';
            break;
        case 'kr':
            $nation = '韩国';
            break;
        case 'tw':
            $nation = '台湾';
            break;
        case 'th':
            $nation = '泰国';
            break;
        case 'in':
            $nation = '印度';
            break;
        case 'fr':
            $nation = '法国';
            break;
        case 'uk':
            $nation = '英国';
            break;
        case 'de':
            $nation = '德国';
            break;
        case 'ru':
            $nation = '俄罗斯';
            break;
        default:
            $nation = '';
            break;
        }
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleList方法得到电影列表
        $article_list = $this->article->get_articleList($nation,$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->load->view('365film/templete/tpl_article',$data);
    }
    
    public function article_typeList($article_type){//电影类型列表
        
        if($article_type == ''){
            redirect(base_url());
            exit;
        }
        
        switch ($article_type) {
        case 'dongzuo':
            $type = '动作';
            break;
        case 'xiju':
            $type = '喜剧';
            break;
        case 'kongbu':
            $type = '恐怖';
            break;
        case 'kehuan':
            $type = '科幻';
            break;
        case 'juqing':
            $type = '剧情';
            break;
        default:
            $type = '剧情';
            break;
        }
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleListbyType方法得到电影列表
        $article_list = $this->article->get_articleListbyType($type,0,10);
        $data['article_list'] = $article_list;
        
        //get_articleRank方法得到时光网TOP100列表
        $article_rank = $this->article->get_articleRank(0,5);
        $data['article_rank'] = $article_rank;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        $data['type'] = $article_type;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>'365电影网 - '.$type.'频道 | 天天影院',
            'seo_keywords'=>'365电影网,2019最新电影,热播电影,'.$type.'频道,天天影院',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_type',$data);
    }
    
    public function get_articleTypeListAjax_tpl(){//电影列表加载更多（模板加載）
        
        $article_type = $this->input->get_post('type');//得到电影类型
        $article_type = $article_type?$article_type:'';
        switch ($article_type) {
        case 'dongzuo':
            $type = '动作';
            break;
        case 'xiju':
            $type = '喜剧';
            break;
        case 'kongbu':
            $type = '恐怖';
            break;
        case 'kehuan':
            $type = '科幻';
            break;
        case 'juqing':
            $type = '剧情';
            break;
        default:
            $type = '剧情';
            break;
        }
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleListbyType方法得到电影列表
        $article_list = $this->article->get_articleListbyType($type,$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->load->view('365film/templete/tpl_article',$data);
    }
    
    public function article_search($keyword){//电影搜索
        
        $data['keyword'] = urldecode($keyword);
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleSearch方法得到电影搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),0,10);
        $data['article_list'] = $article_list;
        
        //get_articleRank方法得到时光网TOP100列表
        $article_rank = $this->article->get_articleRank(0,5);
        $data['article_rank'] = $article_rank;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        //add_articleHotword方法添加热搜词
        $this->article->add_articleHotword(urldecode($keyword));
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>'365电影网 - '.$keyword.'相关电影 | 天天影院',
            'seo_keywords'=>'365电影网,2019最新电影,热播电影,'.$keyword.'相关电影,天天影院',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_search',$data);
    }
    
    public function get_articleSearchAjax_tpl(){//电影搜索列表加载更多（模板加載）
        
        $keyword = $this->input->get_post('keyword');//得到搜索词
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleSearch方法得到电影列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->load->view('365film/templete/tpl_article',$data);
    }
    
    public function article_mtime(){//时光网TOP100
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleRank方法得到时光网TOP100列表
        $article_list = $this->article->get_articleRank(0,10);
        $data['article_list'] = $article_list;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>'365电影网 - 时光网TOP100 | 天天影院',
            'seo_keywords'=>'365电影网,2019最新电影,热播电影,时光网TOP100,电影排行,天天影院',
            'seo_description'=>'365电影网（365film.com.cn）免费为大家提供时光网TOP100电影排行，365影院全网更新热播欧美大片，天天影院希望大家喜欢。'
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_mtime',$data);
    }
    
    public function get_articleMtimeAjax_tpl(){//时光网TOP列表加载更多（模板加載）
        
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleRank方法得到电影列表
        $article_list = $this->article->get_articleRank($offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->load->view('365film/templete/tpl_mtime',$data);
    }
    
    public function article_detail($article_route){//电影详情
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        
        //get_articleDetail方法得到电影详情
        $article = $this->article->get_articleDetail($article_route);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        $data['article'] = $article;
        
        //edit_articleRead方法改变电影阅读数
        $updateStatus = $this->article->edit_articleRead($article_route);
        
        //sql中regexp 'a|b|c'的形式like匹配多个
        $article_type = str_replace("/","|",preg_replace('# #','',$article->article_type));
        //get_articleRelative方法得到相关列表
        $article_relative = $this->article->get_articleRelative($article_type,0,5);
        foreach($article_relative as $key => $relative){
            if($relative->article_route == $article_route){
                unset($article_relative[$key]);
            }
        }
        $data['article_relative'] = $article_relative;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        if(count(explode('《',$article->article_title)) > 1){
            $title_explode = explode('《',$article->article_title);
            $title_explode_explode = explode('》',$title_explode[1]);
            $seo_keywords = $title_explode_explode[0].','.$article->article_nation.'电影,365电影网,2019最新电影,热播电影,电影下载,'.$article->article_type;
        }else{
            $seo_keywords = $article->article_title.','.$article->article_nation.'电影,365电影网,2019最新电影,热播电影,电影下载,'.$article->article_type;
        }
        $seo = array(
            'seo_title'=>$article->article_title.' - 2019最新电影免费下载 | 天天影院',
            'seo_keywords'=>$seo_keywords,
            'seo_description'=>$article->article_summary
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_detail',$data);
    }
    
    public function article_latest(){//电影详情（最新更新）
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        
        //get_articleList方法得到电影列表最新一条
        $article_list = $this->article->get_articleList('',0,1);
        $article_latest = $article_list[0];
        $article_route = $article_latest->article_route;
        
        //get_articleDetail方法得到电影详情
        $article = $this->article->get_articleDetail($article_route);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        $data['article'] = $article;
        
        //edit_articleRead方法改变电影阅读数
        $updateStatus = $this->article->edit_articleRead($article_route);
        
        //sql中regexp 'a|b|c'的形式like匹配多个
        $article_type = str_replace("/","|",preg_replace('# #','',$article->article_type));
        //get_articleRelative方法得到相关列表
        $article_relative = $this->article->get_articleRelative($article_type,0,5);
        foreach($article_relative as $key => $relative){
            if($relative->article_route == $article_route){
                unset($article_relative[$key]);
            }
        }
        $data['article_relative'] = $article_relative;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        if(count(explode('《',$article->article_title)) > 1){
            $title_explode = explode('《',$article->article_title);
            $title_explode_explode = explode('》',$title_explode[1]);
            $seo_keywords = $title_explode_explode[0].','.$article->article_nation.'电影,365电影网,2019最新电影,热播电影,电影下载,'.$article->article_type;
        }else{
            $seo_keywords = $article->article_title.','.$article->article_nation.'电影,365电影网,2019最新电影,热播电影,电影下载,'.$article->article_type;
        }
        $seo = array(
            'seo_title'=>$article->article_title.' - 2019最新电影免费下载 | 天天影院',
            'seo_keywords'=>$seo_keywords,
            'seo_description'=>$article->article_summary
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_latest',$data);
    }
    
    public function domain_list(){//域名列表（公司域名）
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>' 精品域名列表',
            'seo_keywords'=>'域名出售、精品域名、平价域名',
            'seo_description'=>'平台提供大量精品域名出售;'
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/domain_list',$data);
    }
    

}
?>