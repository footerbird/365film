<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;
  
class Spider_controller extends CI_Controller {
    
    public function index(){//提交抓取页面
        $this->load->view('tool/spider');
    }

    public function spider(){//抓取电影详情页面
        
        $url = trim($this->input->get_post('url'));//得到抓取地址
        $html = file_get_contents($url);
        $data = QueryList::Query($html,array(
            'article_title' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > h1','text'),
            'article_summary' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > div.movietxt','text'),
            'poster_path' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > div.movietxt img','src'),
            'article_content' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > div.movietxt','html','-ul'),
        ))->data[0];
        $insert_data['article_route'] = random_string_numlet(6);
        $insert_data['article_title'] = trim($data['article_title']);
        if(strpos($data['poster_path'],'/uploads/') !== false){//如果地址在其他网站，则海报和缩略图一致
            $all_poster_path = trim($data['poster_path']);
            $insert_data['poster_path'] = $this->upload($all_poster_path);
            $insert_data['thumb_path'] = $insert_data['poster_path'];
        }else{
            $all_poster_path = 'http://www.filmshow.com.cn'.trim($data['poster_path']);
            $insert_data['poster_path'] = $this->upload($all_poster_path);
            $all_pathinfo = pathinfo($all_poster_path);
            $all_thumb_path = $all_pathinfo['dirname'].'/'.$all_pathinfo['filename'].'_1.'.$all_pathinfo['extension'];
            $img_exist = @getimagesize($all_thumb_path);
            if($img_exist){
                $insert_data['thumb_path'] = $this->upload($all_thumb_path);
            }else{
                $insert_data['thumb_path'] = $insert_data['poster_path'];
            }
        }
        $insert_data['article_summary'] = mb_substr(trim($data['article_summary']),0,160,'utf-8');
        if(count(explode('类型:',$data['article_content'])) > 1){
            $type_explode = explode('类型:',$data['article_content']);
            $type_explode_explode = explode('<br>',$type_explode[1]);
            $insert_data['article_type'] = trim($type_explode_explode[0]);
        }else{
            $insert_data['article_type'] = '剧情';
        }
        if(count(explode('制片国家/地区:',$data['article_content'])) > 1){
            $nation_explode = explode('制片国家/地区:',$data['article_content']);
            $nation_explode_explode = explode('<br>',$nation_explode[1]);
            $insert_data['article_nation'] = trim($nation_explode_explode[0]);
        }else{
            $insert_data['article_nation'] = '全部';
        }
        $insert_data['article_content'] = preg_replace('/<img[^>]*src[=\"\'\s]+[^\.]*\/([^\.]+)\.[^\"\']+[\"\']?[^>]*>/i','<img class="poster" src="/'.$insert_data['poster_path'].'" />',$data['article_content']);
        $this->load->view('tool/spider_confirm',$insert_data);
        
    }

    public function insert(){
        
        $article_route = trim($this->input->get_post('article_route'));//电影路由
        $article_title = trim($this->input->get_post('article_title'));//电影标题
        $article_summary = trim($this->input->get_post('article_summary'));//电影简介
        $thumb_path = trim($this->input->get_post('thumb_path'));//缩略图
        $poster_path = trim($this->input->get_post('poster_path'));//电影海报
        $article_nation = trim($this->input->get_post('article_nation'));//电影国家
        $article_type = trim($this->input->get_post('article_type'));//电影类型
        $article_content = $this->input->get_post('article_content');//电影内容
        $status = 1;
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $addStatus = $this->article->add_articleOne($article_route,$article_title,$article_summary,$thumb_path,$poster_path,$article_nation,$article_type,$article_content,$status);
        if($addStatus){
            echo '插入成功，电影：'.$article_title;
        }else{
            echo '插入失败';
        }
        
    }

    public function batch(){//批量抓取页面
        $this->load->view('tool/batch_spider');
    }
    
    public function batch_spider(){//执行批量抓取
        $start = trim($this->input->get_post('start'));//开始抓取序号
        $end = trim($this->input->get_post('end'));//结束抓取序号
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        
        for($i=$start;$i<=$end;$i++){
            sleep(1);
            $url = 'http://www.filmshow.com.cn/movies-'.$i.'.html';//得到抓取地址
            $html = file_get_contents($url);
            $data = QueryList::Query($html,array(
                'article_title' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > h1','text'),
                'article_summary' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > div.movietxt','text'),
                'poster_path' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > div.movietxt img','src'),
                'article_content' => array('body > div.content.clearfix.margint.padding-bt2rem > div:nth-child(2) > div.movietxt','html','-ul'),
            ))->data[0];
            $article_route = random_string_numlet(6);
            $article_title = trim($data['article_title']);
            if(strpos($data['poster_path'],'/uploads/') !== false){//如果地址在其他网站，则海报和缩略图一致
                $all_poster_path = trim($data['poster_path']);
                $poster_path = $this->upload($all_poster_path);
                $thumb_path = $poster_path;
            }else{
                $all_poster_path = 'http://www.filmshow.com.cn'.trim($data['poster_path']);
                $poster_path = $this->upload($all_poster_path);
                $all_pathinfo = pathinfo($all_poster_path);
                $all_thumb_path = $all_pathinfo['dirname'].'/'.$all_pathinfo['filename'].'_1.'.$all_pathinfo['extension'];
                $img_exist = @getimagesize($all_thumb_path);
                if($img_exist){
                    $thumb_path = $this->upload($all_thumb_path);
                }else{
                    $thumb_path = $poster_path;
                }
            }
            $article_summary = mb_substr(trim($data['article_summary']),0,160,'utf-8');
            if(count(explode('类型:',$data['article_content'])) > 1){
                $type_explode = explode('类型:',$data['article_content']);
                $type_explode_explode = explode('<br>',$type_explode[1]);
                $article_type = trim($type_explode_explode[0]);
            }else{
                $article_type = '剧情';
            }
            if(count(explode('制片国家/地区:',$data['article_content'])) > 1){
                $nation_explode = explode('制片国家/地区:',$data['article_content']);
                $nation_explode_explode = explode('<br>',$nation_explode[1]);
                $article_nation = trim($nation_explode_explode[0]);
            }else{
                $article_nation = '全部';
            }
            $article_content = preg_replace('/<img[^>]*src[=\"\'\s]+[^\.]*\/([^\.]+)\.[^\"\']+[\"\']?[^>]*>/i','<img class="poster" src="/'.$poster_path.'" />',$data['article_content']);
            $status = 1;
            
            $addStatus = $this->article->add_articleOne($article_route,$article_title,$article_summary,$thumb_path,$poster_path,$article_nation,$article_type,$article_content,$status);
            if($addStatus){
                echo '<p style="line-height:28px;color:#080;">'.$i.':插入成功，电影：'.$article_title.'</p>';
            }else{
                echo '<p style="line-height:28px;color:#f00;">'.$i.':插入失败，电影：'.$article_title.'</p>';
            }
            
        }
        
    }

    public function delete(){//提交删除页面
        $this->load->view('tool/delete');
    }
    
    public function delete_spider(){//执行删除操作
        
        $article_route = trim($this->input->get_post('article_route'));//电影路由
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $deleteStatus = $this->article->delete_articleOne($article_route);
        if($deleteStatus){
            echo '删除成功';
        }else{
            echo '删除失败';
        }
    }
    
    public function update(){//提交更新页面
        $this->load->view('tool/update');
    }
    
    public function update_spider(){//获取更新信息
        
        $article_route = trim($this->input->get_post('article_route'));//电影路由
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $article = $this->article->get_articleDetail($article_route);
        $data['article'] = $article;
        
        $this->load->view('tool/update_confirm',$data);
    }
    
    public function update_confirm(){//执行更新操作
        
        $article_route = trim($this->input->get_post('article_route'));//电影路由
        $article_title = trim($this->input->get_post('article_title'));//电影标题
        $article_summary = trim($this->input->get_post('article_summary'));//电影简介
        $thumb_path = trim($this->input->get_post('thumb_path'));//缩略图
        $poster_path = trim($this->input->get_post('poster_path'));//电影海报
        $article_nation = trim($this->input->get_post('article_nation'));//电影国家
        $article_type = trim($this->input->get_post('article_type'));//电影类型
        $article_content = $this->input->get_post('article_content');//电影内容
        $status = 1;
        $article_score = trim($this->input->get_post('article_score'));//豆瓣评分
        $article_rank = $this->input->get_post('article_rank');//时光排名
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $updateStatus = $this->article->update_articleOne($article_route,$article_title,$article_summary,$thumb_path,$poster_path,$article_nation,$article_type,$article_content,$status,$article_score,$article_rank);
        if($updateStatus){
            echo '更新成功';
        }else{
            echo '更新失败';
        }
    }
    
    public function addfull(){//添加信息页面（不从网页爬取）
        $this->load->view('tool/addfull');
    }
    
    public function addfull_spider(){//执行添加操作
        
        $article_route = random_string_numlet(6);//电影路由
        $article_title = trim($this->input->get_post('article_title'));//电影标题
        $article_summary = trim($this->input->get_post('article_summary'));//电影简介
        $all_thumb_path = trim($this->input->get_post('thumb_path'));//缩略图
        $thumb_path = $this->upload($all_thumb_path);
        $all_poster_path = trim($this->input->get_post('poster_path'));//电影海报
        $poster_path = $this->upload($all_poster_path);
        $article_nation = trim($this->input->get_post('article_nation'));//电影国家
        $article_type = trim($this->input->get_post('article_type'));//电影类型
        $article_content = $this->input->get_post('article_content');//电影内容
        $status = 1;
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $addStatus = $this->article->add_articleOne($article_route,$article_title,$article_summary,$thumb_path,$poster_path,$article_nation,$article_type,$article_content,$status);
        if($addStatus){
            echo '插入成功，电影：'.$article_title;
        }else{
            echo '插入失败';
        }
    }

    public function upload($path){//上传图片并返回图片地址
        $imgInfo = getimagesize($path);
        switch($imgInfo[2]){
        case 1:
            $imgType = 'gif';
            break;
        case 2:
            $imgType = 'jpg';
            break;
        case 3:
            $imgType = 'png';
            break;
        default:
            $imgType = 'jpg';
            break;
        }
        $html = file_get_contents($path);
        $random_string = random_string_numlet(12);
        $upload_path = 'uploads/'.$random_string.'.'.$imgType;
        file_put_contents($upload_path, $html);
        return $upload_path;
    }
    
    public function sitemap(){
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $article_list = $this->article->get_articleAll();
        $urls = array();
        foreach($article_list as $key => $item){
            array_push($urls,'http://www.365film.com.cn/movie_'.$item->article_route.'.html');
        }
        $api = 'http://data.zz.baidu.com/urls?site=www.365film.com.cn&token=0N5yB4KBnjilg4v4';
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        echo $result;
        
    }

}
?>