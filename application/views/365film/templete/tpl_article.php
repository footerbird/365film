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