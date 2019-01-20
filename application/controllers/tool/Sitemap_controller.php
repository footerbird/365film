<?php
  
class Sitemap_controller extends CI_Controller {
    
    public function index(){//生成sitemap文件
        $content="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
        $data_array=array(
            array(
                'loc'=>'http://www.365film.com.cn/',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_cn.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_us.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_hk.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_jp.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_kr.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_tw.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_th.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_in.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_fr.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_uk.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_de.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/regions_ru.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/mtime.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/latest.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
            array(
                'loc'=>'http://www.365film.com.cn/domain.html',
                'priority'=>'1.0',
                'lastmod'=>date("Y-m-d"),
                'changefreq'=>'daily'
            ),
        );
        
        //加载电影模型类
        $this->load->model('365film/Article_model','article');
        $article_list = $this->article->get_articleAll();
        foreach($article_list as $article){
            array_push($data_array,array(
                'loc'=>'http://www.365film.com.cn/movie_'.$article->article_route.'.html',
                'priority'=>'0.8',
                'lastmod'=>date('Y-m-d',strtotime($article->create_time)),
                'changefreq'=>'weekly'
            ));
        }
        
        foreach($data_array as $data){
            $content.=$this->create_item($data);
        }
        
        $content.='</urlset>';
        $fp=fopen('sitemap.xml','w+');
        fwrite($fp,$content);
        fclose($fp);
        echo 'sitemap.xml创建成功';
        
    }
    
    function create_item($data){
        $item="<url>\n";
        $item.="<loc>".$data['loc']."</loc>\n";
        $item.="<priority>".$data['priority']."</priority>\n";
        $item.="<lastmod>".$data['lastmod']."</lastmod>\n";
        $item.="<changefreq>".$data['changefreq']."</changefreq>\n";
        $item.="</url>\n";
        return $item;
    }
    

}
?>