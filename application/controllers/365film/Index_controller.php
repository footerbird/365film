<?php
class Index_controller extends CI_Controller {
    
    public function article_list($category){//文章列表
        
        if($category == ''){
            redirect(base_url());
            exit;
        }
        
        $data['category'] = $category;
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_list',$data);
    }
    
    public function article_search($keyword){//文章搜索
        
        $data['keyword'] = urldecode($keyword);
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_search',$data);
    }
    
    public function article_mtime(){//时光网TOP100
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_mtime',$data);
    }
    
    public function article_detail($article_id){//文章详情
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_detail',$data);
    }
    
    public function article_latest(){//文章详情（最新更新）
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('365film/article_latest',$data);
    }
    

}
?>