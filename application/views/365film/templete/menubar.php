<div class="header">
    <div class="top-search">
        <div class="container">
            <a href="<?php echo base_url() ?>" class="top-logo"></a>
            <div class="search">
                <form id="search_form" action="" target="_blank" method="post"></form>
                <input type="text" placeholder="大家都在搜" id="keyword" onkeyup="keywordEnter()" value="<?php if(!empty($keyword)){ echo $keyword; } ?>" />
                <input type="button" id="keywordBtn" onclick="keywordSearch()" />
                <div class="hotwords">
                    <font>热搜词：</font>
                    <?php foreach ($article_hotword as $hotword){ ?>
                    <a href="<?php echo base_url() ?>article_search/<?php echo $hotword->hotword_name; ?>" target="_blank"><?php echo $hotword->hotword_name; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="top-bar">
        <div class="container">
            <div class="top-nav">
                <ul>
                    <li class="<?php if(!empty($nation) && $nation == 'all'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>">全部电影</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'cn'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_cn.html">大陆</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'us'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_us.html">美国</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'hk'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_hk.html">香港</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'jp'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_jp.html">日本</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'ue'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_ue.html">欧美</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'kr'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_kr.html">韩国</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'tw'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_tw.html">台湾</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'th'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_th.html">泰国</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'in'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_in.html">印度</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'fr'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_fr.html">法国</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'uk'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_uk.html">英国</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'de'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_de.html">德国</a>
                    </li>
                    <li class="<?php if(!empty($nation) && $nation == 'ru'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>regions_ru.html">俄罗斯</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
