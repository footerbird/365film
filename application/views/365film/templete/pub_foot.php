<?php if(isset($this->footer) && $this->footer == 'no'){}else{ ?>
<!--默认有底部-->
<div class="footer">
    <div class="footer-box">
        
        <div class="friend-link">
            <div class="container">
                <ul>
                    <li><label>友情链接：</label></li>
                    <li><a href="https://www.marksmile.com/" target="_blank">名商网</a>|</li>
                    <li><a href="http://www.yumi.com/" target="_blank">玉米网</a>|</li>
                    <li><a href="http://www.shangbiao.com/" target="_blank">商标圈</a></li>
                </ul>
                <div class="copyright">
                    <p>本站所有影片均来自互联网，谨供交流学习用，请下载后24小时内删除，如果侵犯了你的权益，请通知我们，我们会及时删除侵权内容！</p>
                    <p>© 2018-2020 http://www.365film.com.cn All rights reserved.</p>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php } ?>

<!--默认有侧边栏-->
<div id="to_topbar" class="to-topbar">
    <div class="ico-top" id="ico_top" style="display:none;"></div>
</div>

<?php if(!empty($redirect)){ ?>
<!--底部固定栏-->
<div id="redirect_bar" class="redirect-bar">
    <div class="container">【<font><?php echo $redirect; ?></font>】您正在访问的域名可以转让！<a class="pub-btn-blue fl-r" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1003049243&amp;site=qq&amp;menu=yes" target="_blank">在线咨询</a><a class="close" href="javascript:;" onclick="removeRedirectBar();"></a></div>
</div>
<?php } ?>

<script src="/htdocs/365film/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
<?php if(isset($scripts)){ foreach($scripts as $script){ echo '<script src="'.$script.'"></script>';} }?>
<script src="/htdocs/365film/js/public.js?<?php echo CACHE_TIME; ?>"></script>
<script src="/htdocs/365film/js/dom-ready.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">

function removeRedirectBar(){
    $("#redirect_bar").remove();
}

$(function(){
    
})
</script>
