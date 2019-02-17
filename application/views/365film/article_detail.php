<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    <div class="container"><script src="https://j.qiqivv.com:4433/blog/showdetail.php?z=126806"></script></div>
    <div class="container after-cls pb30">
        <div class="article-left">
            
            <article>
                <div class="title"><?php echo $article->article_title; ?></div>
                <div class="publish">发布：<?php echo $article->create_time; ?></div>
                <section><?php echo $article->article_content; ?></section>
            </article>
            
        </div>
        <div class="article-right">
            
            <?php  if(count($article_relative) > 0){ ?>
            <div class="recommend">
                <h4 class="recommend-title">相关电影</h4>
                <?php foreach ($article_relative as $article){ ?>
                <a class="recommend-item" href="<?php echo base_url() ?>movie_<?php echo $article->article_route; ?>.html" target="_blank">
                    <h4 class="title"><?php echo $article->article_title; ?></h4>
                    <div class="thumb">
                        <img src="/<?php echo $article->thumb_path; ?>" alt="<?php echo $article->article_title; ?>" />
                    </div>
                    <div class="summary"><?php echo $article->article_summary; ?></div>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            
            <script src="https://j.qiqivv.com:4433/blog/showdetail.php?z=126805"></script>
            
        </div>
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        lazyLoading();//图片懒加载
        $(window).on("scroll",function(){
            lazyLoading();
        })
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
