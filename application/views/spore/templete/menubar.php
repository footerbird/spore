<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https'){
   bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
  }
  else{
  bp.src = 'http://push.zhanzhang.baidu.com/push.js';
  }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<div class="header">
    <div class="top-search">
        <div class="container pos-rela">
            <a href="<?php echo base_url() ?>" class="top-logo"></a>
            <div class="search">
                <form id="search_form" action="" target="_blank" method="post"></form>
                <input type="text" placeholder="大家都在搜" id="keyword" onkeyup="keywordEnter()" value="<?php if(!empty($keyword)){ echo $keyword; } ?>" />
                <input type="button" id="keywordBtn" onclick="keywordSearch()" />
                <div class="hotwords">
                    <font>热搜词：</font>
                    <?php foreach ($article_hotword as $hotword){ ?>
                    <a href="<?php echo base_url() ?>search/<?php echo $hotword->hotword_name; ?>" target="_blank"><?php echo $hotword->hotword_name; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="top-bar">
        <div class="container">
            <div class="top-nav">
                <ul>
                    <li class="<?php if(!empty($type) && $type == 'all'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>">全部作品</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'xuanhuan'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_xuanhuan.html">玄幻</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'wuxia'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_wuxia.html">武侠</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'dushi'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_dushi.html">都市</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'junshi'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_junshi.html">军事</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'youxi'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_youxi.html">游戏</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'kehuan'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_kehuan.html">科幻</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'qihuan'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_qihuan.html">奇幻</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'xianxia'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_xianxia.html">仙侠</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'xianshi'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_xianshi.html">现实</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'lishi'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_lishi.html">历史</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'lingyi'){ echo 'cur'; } ?>">
                        <a href="<?php echo base_url() ?>type_lingyi.html">悬疑灵异</a>
                    </li>
                    <li class="<?php if(!empty($type) && $type == 'ciyuan'){ echo 'cur'; } ?>">
                    		<a href="<?php echo base_url() ?>type_ciyuan.html">二次元</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function keywordEnter(e){
    var eve = e || window.event;
    if(eve.keyCode == 13){
        keywordSearch();
    }
}

function keywordSearch(){
    if($.trim($("#keyword").val()) == ""){
        return;
    }
    $("#search_form").attr('action','<?php echo base_url() ?>search/'+$("#keyword").val());
    $("#search_form").submit();
}
</script>
