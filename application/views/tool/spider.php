<!DOCTYPE html>
<html>
    
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
    <link rel="icon" href="/htdocs/365film/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/htdocs/365film/images/favicon.ico" type="image/x-icon">
    </head>
    
    <body>
    
    <form action="<?php echo base_url() ?>tool/Spider_controller/spider" method="post" target="_blank">
        <input type="text" name="url" placeholder="请输入抓取地址" style="width: 400px;height: 40px;" />
        <input type="submit" value="抓取"/>
    </form>
    
    <script src="/htdocs/365film/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
    
    <script type="text/javascript">
    $(function(){
        
    })
    </script>
    </body>
</html>
