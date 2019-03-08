<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (isset($seo)){ ?>
<title><?php echo empty($seo->seo_title)?constant('SEO_TITLE'):$seo->seo_title; ?></title>
<meta name="Keywords" content="<?php echo empty($seo->seo_keywords)?constant('SEO_KEYWORDS'):$seo->seo_keywords; ?>"/>
<meta name="description" content="<?php echo empty($seo->seo_description)?constant('SEO_DESCRIPTION'):$seo->seo_description; ?>"/>
<?php }else{ ?>
<title><?php echo constant('SEO_TITLE'); ?></title>
<meta name="Keywords" content="<?php echo constant('SEO_KEYWORDS'); ?>"/>
<meta name="description" content="<?php echo constant('SEO_DESCRIPTION'); ?>"/>
<?php } ?>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no' />
<link rel="icon" href="/htdocs/spore/images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/htdocs/spore/images/favicon.ico" type="image/x-icon">
<?php if(isset($styles)){ foreach($styles as $style){ echo '<link rel="stylesheet" href="'.$style.'"/>';} }?>
<link rel="stylesheet" href="/htdocs/spore/css/public.css?<?php echo CACHE_TIME; ?>">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?f0bc1134f9b90aa7853dc569bf743c10";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


