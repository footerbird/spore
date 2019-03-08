<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="container after-cls pt30 pb30">
        <div class="article-left">
            
            <input type="hidden" id="article_type" value="<?php echo $type; ?>" />
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
            
            <?php if(count($article_list) < 10 ){ ?>
            <div class="article-loadmore" id="article_loading" style="display: none;">加载中，请稍后...</div>
            <div class="article-loadmore" id="article_loadnone">喂喂，你触碰到我的底线了</div>
            <?php }else{ ?>
            <div class="article-loadmore" id="article_loading">加载中，请稍后...</div>
            <div class="article-loadmore" id="article_loadnone" style="display: none;">喂喂，你触碰到我的底线了</div>
            <?php } ?>
            
        </div>
        <div class="article-right">
            
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
        
        <?php if(count($article_list) >= 10){ ?>
        var article_loading = false;//状态标记
        $(window).on("scroll",function(){
            if($("#article_loadnone").is(":visible")) return;
            if($(window).scrollTop() + $(window).height() + 100 < $(document).height()) return;
            if(article_loading) return;
            article_loading = true;
            var current_page = parseInt($("#article_page").val());
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>spore/Index_controller/get_articleListAjax_tpl",
                async:true,
                data:{
                    type:$("#article_type").val(),
                    page: current_page+1
                },
                success:function(html){
                    var $html = $(html);
                    if($html.length < 10){
                        $("#article_loading").hide();
                        $("#article_loadnone").show();
                    }
                    $("#article_list").append(html);
                    $("#article_page").val(current_page+1);
                    article_loading = false;
                }
            });
        })
        <?php } ?>
        
    })
    </script>
    <script src="https://j.qiqivv.com:4433/blog/showdetail.php?z=126807"></script>
    </body>
</html>
