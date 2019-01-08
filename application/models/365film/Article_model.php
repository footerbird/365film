<?php
class Article_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    //新增一条电影记录,addslashes方法会对引号进行转义
    public function add_articleOne($article_route,$article_title,$article_summary,$thumb_path,$poster_path,$article_nation,$article_type,$article_content,$status){
        $sql = "insert into article_info(article_route,article_title,article_summary,thumb_path,poster_path,article_nation,article_type,article_content,status"
            .")values('".$article_route."','".addslashes($article_title)."','".addslashes($article_summary)."','".$thumb_path."','".$poster_path."','".$article_nation."','".$article_type."','".addslashes($article_content)."',".$status.")";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //删除一条电影记录
    public function delete_articleOne($article_route){
        $sql = "delete from article_info where article_route = '".$article_route."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //更新一条电影记录的评分和排名
    public function update_articleOne($article_route,$article_title,$article_summary,$thumb_path,$poster_path,$article_nation,$article_type,$article_content,$status,$article_score,$article_rank){
        $sql = "update article_info set"
            ." article_title='".$article_title
            ."', article_summary='".$article_summary
            ."', thumb_path='".$thumb_path
            ."', poster_path='".$poster_path
            ."', article_nation='".$article_nation
            ."', article_type='".$article_type
            ."', article_content='".$article_content
            ."', status=".$status
            .", article_score=".$article_score
            .", article_rank=".$article_rank
            ." where article_route='".$article_route."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //电影列表页面,传入article_nation,如'美国',输出前$length条数
    public function get_articleList($article_nation,$start,$length){
        if($article_nation == ''){
            $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score,article_rank from article_info "
                ." where status = 1 order by create_time desc limit ".$start.",".$length;
        }else{
            $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score,article_rank from article_info "
                ." where status = 1 and article_nation like '%".$article_nation."%' order by create_time desc limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //时光网TOP100列表,输出前$length条数
    public function get_articleRank($start,$length){
        $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score,article_rank from article_info "
            ." where status = 1 and article_rank > 0 order by article_rank asc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //推荐电影列表,输出前$length条数
    public function get_articleRecommend($start,$length){
        $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score,article_rank from article_info "
            ." where status = 1 order by article_read desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //电影搜索列表页面,输出前$length条数
    public function get_articleSearch($keyword,$start,$length){
        $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score,article_rank from article_info "
            ." where status = 1 and article_content like '%".$keyword."%' order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //添加电影热搜词
    public function add_articleHotword($keyword){
        $sql = "insert into article_hotword(hotword_name)values('".$keyword."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //热搜词列表,输出前$length条数
    public function get_articleHotword($start,$length){
        $sql = "select hotword_name,COUNT(hotword_name) as hotword_count from article_hotword"
            ." where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(create_time) group by hotword_name order by hotword_count desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //电影详情页面,传入article_route
    public function get_articleDetail($article_route){
        $sql = "select * from article_info where article_route = '".$article_route."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    //改变电影阅读数
    public function edit_articleRead($article_route){
        $sql = "update article_info set"
            ." article_read=article_read+1"
            ." where article_route='".$article_route."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //相关电影列表,传入电影类型数组,输出前$length条数
    public function get_articleRelative($article_type,$start,$length){
        $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score,article_rank from article_info "
            ." where status = 1 and article_type regexp '".$article_type."' limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
}
?>