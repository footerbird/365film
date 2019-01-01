<?php

//格式化资讯发布日期
if( !function_exists('format_article_time') )
{
    function format_article_time($fmt_time){
        if(!$fmt_time){
            return false;
        }
        $fmt_time = strtotime($fmt_time);
        $diff = time() - $fmt_time;
        if($diff < 60){//小于1分钟
            return '刚刚';
        }else if($diff < 60*60){//大于等于1分钟，小于1小时
            return floor($diff/60).'分钟前';
            
        }else if($diff < 60*60*24){//大于等于1小时，小于1天
            return floor($diff/3600).'小时前';
            
        }else if($diff < 60*60*24*4){//大于等于1天，小于4天
            return floor($diff/86400).'天前';
            
        }else{//大于等于4天，则用年月日表示
            return date('Y-m-d',$fmt_time);
        }
    }
}


//生成随机字符串，包括数字和字母
if( !function_exists('random_string_numlet') )
{
    function random_string_numlet($length){
        if(!$length){
            return false;
        }
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = "";
        for($i=0;$i<$length;$i++){
            $str .= $pattern{mt_rand(0,61)};//生成php随机数   
        } 
        return $str;
    }
}

?>