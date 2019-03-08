<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    <div class="container"><script src="https://j.qiqivv.com:4433/blog/showdetail.php?z=126806"></script></div>
    <div class="container after-cls pb30">
        <div class="breadcrumbs"><a href="/">首页</a><em></em><a href="<?php echo base_url() ?>novel_<?php echo $article->article_route; ?>.html"><?php echo $article->article_title; ?></a><em></em><span><?php echo $chapter->chapter_title; ?></span></div>
        <div class="article-left">
            
            <div id="chapter_list">
                <article>
                    <input type="hidden" id="chapter_order" value="<?php echo $chapter->chapter_order; ?>" />
                    <div class="title"><?php echo $chapter->chapter_title; ?></div>
                    <div class="publish">发布：<?php echo $chapter->create_time; ?></div>
                    <section><?php echo $chapter->chapter_content; ?></section>
                </article>
            </div>
            
            <div class="article-loadmore" id="article_loading">加载中，请稍后...</div>
            <div class="article-loadmore" id="article_loadnone" style="display: none;">喂喂，你触碰到我的底线了</div>
            
        </div>
        <div class="article-right">
            
            <div class="rank">
                <h4 class="rank-title">章节目录</h4>
                <style type="text/css">
                .article-right .rank .rank-title:after{display: none;}
                </style>
            	<?php 
                $item_count = 20;
                $item_index = $chapter->chapter_order < 1? 0 : $chapter->chapter_order-1;
                foreach ($article_chapter as $item){
                    $diff = $item->chapter_order - $item_index;
                    if(20 > $diff && $diff >= 0){
                ?>
            	<div class="rank-item">
            		<a href="<?php echo base_url() ?>chapter_<?php echo $item->chapter_route; ?>.html" class="title <?php if($item->chapter_order == $chapter->chapter_order){ echo 'cur'; } ?>"><?php echo $item->chapter_title; ?></a>
            	</div>
            	<?php }} ?>
            </div>
            
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
        
        var article_loading = false;//状态标记
        $(window).on("scroll",function(){
            if($("#article_loadnone").is(":visible")) return;
            if($(window).scrollTop() + $(window).height() + 100 < $(document).height()) return;
            if(article_loading) return;
            article_loading = true;
            var current_order = parseInt($("#chapter_order").val());
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>spore/Index_controller/get_chapterAjax_tpl",
                async:true,
                data:{
                    article_route:'<?php echo $article->article_route; ?>',
                    chapter_order: current_order+1
                },
                success:function(html){
                    if(html == ''){
                        $("#article_loading").hide();
                        $("#article_loadnone").show();
                    }
                    $("#chapter_list").append(html);
                    $("#chapter_order").val(current_order+1);
                    article_loading = false;
                }
            });
        })
        
    })
    </script>
    </body>
</html>
