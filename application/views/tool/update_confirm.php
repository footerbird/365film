<!DOCTYPE html>
<html>
    
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
    <link rel="icon" href="/htdocs/365film/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/htdocs/365film/images/favicon.ico" type="image/x-icon">
    </head>
    
    <body>
    
    <form action="<?php echo base_url() ?>tool/Spider_controller/update_confirm" method="post">
        <p>电影路由：<input type="text" name="article_route" value="<?php echo $article->article_route; ?>" placeholder="电影路由" style="width: 400px;height: 40px;" readonly /></p>
        <p>电影标题：<input type="text" name="article_title" value="<?php echo $article->article_title; ?>" placeholder="电影标题" style="width: 400px;height: 40px;" readonly /></p>
        <p>电影简介：<textarea name="article_summary" style="width: 400px;height: 100px;"><?php echo $article->article_summary; ?></textarea></p>
        <p>缩略图：<input type="text" name="thumb_path" value="<?php echo $article->thumb_path; ?>" placeholder="缩略图" style="width: 400px;height: 40px;" readonly /></p>
        <p>电影海报：<input type="text" name="poster_path" value="<?php echo $article->poster_path; ?>" placeholder="电影海报" style="width: 400px;height: 40px;" readonly /></p>
        <p>电影国家：<input type="text" name="article_nation" value="<?php echo $article->article_nation; ?>" placeholder="电影国家" style="width: 400px;height: 40px;" /></p>
        <p>电影类型：<input type="text" name="article_type" value="<?php echo $article->article_type; ?>" placeholder="电影类型" style="width: 400px;height: 40px;" /></p>
        <p>电影内容：<textarea name="article_content" style="width: 400px;height: 200px;"><?php echo $article->article_content; ?></textarea></p>
        <p>豆瓣评分：<input type="text" name="article_score" value="<?php echo $article->article_score; ?>" placeholder="豆瓣评分" style="width: 400px;height: 40px;" /></p>
        <p>时光排名：<input type="text" name="article_rank" value="<?php echo $article->article_rank; ?>" placeholder="时光排名" style="width: 400px;height: 40px;" /></p>
        <p><input type="submit" value="点击更新"/></p>
    </form>
    
    <script src="/htdocs/365film/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
    
    <script type="text/javascript">
    $(function(){
        
    })
    </script>
    </body>
</html>
