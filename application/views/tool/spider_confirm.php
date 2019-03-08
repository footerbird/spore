<!DOCTYPE html>
<html>
    
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
    <link rel="icon" href="/htdocs/spore/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/htdocs/spore/images/favicon.ico" type="image/x-icon">
    </head>
    
    <body>
    
    <form action="<?php echo base_url() ?>tool/Spider_controller/insert" method="post" target="_blank">
        <p>小说路由：<input type="text" name="article_route" value="<?php echo $article_route; ?>" placeholder="小说路由" style="width: 400px;height: 40px;" /></p>
        <p>小说标题：<input type="text" name="article_title" value="<?php echo $article_title; ?>" placeholder="小说标题" style="width: 400px;height: 40px;" /></p>
        <p>小说作者：<input type="text" name="article_author" value="<?php echo $article_author; ?>" placeholder="小说作者" style="width: 400px;height: 40px;" /></p>
        <p>小说简介：<textarea name="article_summary" style="width: 400px;height: 100px;"><?php echo $article_summary; ?></textarea></p>
        <p>小说封面：<input type="text" name="thumb_path" value="<?php echo $thumb_path; ?>" placeholder="小说封面" style="width: 400px;height: 40px;" /></p>
        <p>小说类型：<input type="text" name="article_type" value="<?php echo $article_type; ?>" placeholder="小说类型" style="width: 400px;height: 40px;" /></p>
        <p>小说章节：<textarea name="article_chapter" style="width: 400px;height: 200px;">
        <?php 
            foreach($article_chapter as $key => $chapter){
                echo $chapter.'&#10;';
            }
         ?>
        </textarea></p>
        <p><input type="submit" value="小说入库"/></p>
    </form>
    
    <script src="/htdocs/spore/js/jquery-1.11.1.min.js?<?php echo CACHE_TIME; ?>"></script>
    
    <script type="text/javascript">
    $(function(){
        
    })
    </script>
    </body>
</html>
