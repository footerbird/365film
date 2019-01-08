<!DOCTYPE html>
<html>
    
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
    <link rel="icon" href="/htdocs/365film/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/htdocs/365film/images/favicon.ico" type="image/x-icon">
    </head>
    
    <body>
    
    <form action="<?php echo base_url() ?>tool/Spider_controller/update_spider" method="post" target="_blank">
        <p>电影路由：<input type="text" name="article_route" value="" placeholder="电影路由" style="width: 400px;height: 40px;" /></p>
        <p><input type="submit" value="查询"/></p>
    </form>
    
    <script src="/htdocs/365film/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
    
    <script type="text/javascript">
    $(function(){
        
    })
    </script>
    </body>
</html>
