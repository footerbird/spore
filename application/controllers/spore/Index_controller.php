<?php
class Index_controller extends CI_Controller {
    
    public function article_pagination($page){//首页分页
        
        //加载电影模型类
        $this->load->model('spore/Article_model','article');
        //通过文章模型类中的get_articleCount()方法得到行数，
        $count = $this->article->get_articleCount('');
        
        if(!isset($page) || !is_numeric($page)){
            redirect(base_url());
            exit;
        }
        
        $page_size = 2;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        switch($page){
          case 1:
            $num_links = 4;//num_links选中页右边的个数
            break;
          case 2:
            $num_links = 3;
            break;
          case ceil($count/$page_size):
            $num_links = 4;
            break;
          case ceil($count/$page_size)-1:
            $num_links = 3;
            break;
          default:
            $num_links = 2;
            break;
        }
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'page/';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        
        //get_articleList方法得到小说列表
        $article_list = $this->article->get_articleList('',$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->pagination->initialize($config);
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        $data['type'] = 'all';
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('spore/article_index',$data);
        
    }
    
    public function article_list($article_type){//小说列表
        
        if($article_type == ''){
            redirect(base_url());
            exit;
        }
        
        switch ($article_type) {
        case 'xuanhuan':
            $type = '玄幻';
            break;
        case 'wuxia':
            $type = '武侠';
            break;
        case 'dushi':
            $type = '都市';
            break;
        case 'junshi':
            $type = '军事';
            break;
        case 'youxi':
            $type = '游戏';
            break;
        case 'kehuan':
            $type = '科幻';
            break;
        case 'qihuan':
            $type = '奇幻';
            break;
        case 'xianxia':
            $type = '仙侠';
            break;
        case 'xianshi':
            $type = '现实';
            break;
        case 'lishi':
            $type = '历史';
            break;
        case 'lingyi':
            $type = '悬疑灵异';
            break;
        case 'ciyuan':
            $type = '二次元';
            break;
        default:
            $type = '';
            break;
        }
        //加载小说模型类
        $this->load->model('spore/Article_model','article');
        //get_articleList方法得到小说列表
        $article_list = $this->article->get_articleList($type,0,10);
        $data['article_list'] = $article_list;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        $data['type'] = $article_type;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>$type.'频道 | 孢子文学',
            'seo_keywords'=>$type.'频道,孢子文学,小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学',
            'seo_description'=>'小说阅读,精彩小说尽在孢子文学. 孢子文学提供玄幻小说,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说,最新章节免费'
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('spore/article_list',$data);
    }
    
    public function get_articleListAjax_tpl(){//小说列表加载更多（模板加載）
        
        $article_type = $this->input->get_post('type');//得到小说类型
        $article_type = $article_type?$article_type:'';
        switch ($article_type) {
        case 'xuanhuan':
        		$type = '玄幻';
        		break;
        case 'wuxia':
        		$type = '武侠';
        		break;
        case 'dushi':
        		$type = '都市';
        		break;
        case 'junshi':
        		$type = '军事';
        		break;
        case 'youxi':
        		$type = '游戏';
        		break;
        case 'kehuan':
        		$type = '科幻';
        		break;
        case 'qihuan':
        		$type = '奇幻';
        		break;
        case 'xianxia':
        		$type = '仙侠';
        		break;
        case 'xianshi':
        		$type = '现实';
        		break;
        case 'lishi':
        		$type = '历史';
        		break;
        case 'lingyi':
        		$type = '悬疑灵异';
        		break;
        case 'ciyuan':
        		$type = '二次元';
        		break;
        default:
        		$type = '';
        		break;
        }
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载小说模型类
        $this->load->model('spore/Article_model','article');
        //get_articleList方法得到小说列表
        $article_list = $this->article->get_articleList($type,$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->load->view('spore/templete/tpl_article',$data);
    }
    
    public function article_search($keyword){//小说搜索
        
        $data['keyword'] = urldecode($keyword);
        
        //加载小说模型类
        $this->load->model('spore/Article_model','article');
        //get_articleSearch方法得到小说搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),0,10);
        $data['article_list'] = $article_list;
        
        //get_articleRecommend方法得到推荐列表
        $article_recommend = $this->article->get_articleRecommend(5,5);
        $data['article_recommend'] = $article_recommend;
        
        //add_articleHotword方法添加热搜词
        $this->article->add_articleHotword(urldecode($keyword));
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>$keyword.'相关小说 | 孢子文学',
            'seo_keywords'=>$keyword.'相关小说,孢子文学,小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学',
            'seo_description'=>'小说阅读,精彩小说尽在孢子文学. 孢子文学提供玄幻小说,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说,最新章节免费'
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('spore/article_search',$data);
    }
    
    public function get_articleSearchAjax_tpl(){//小说搜索列表加载更多（模板加載）
        
        $keyword = $this->input->get_post('keyword');//得到搜索词
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载小说模型类
        $this->load->model('spore/Article_model','article');
        //get_articleSearch方法得到小说列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),$offset,$page_size);
        $data['article_list'] = $article_list;
        
        $this->load->view('spore/templete/tpl_article',$data);
    }
    
    public function article_detail($article_route){//小说详情
        
        //加载小说模型类
        $this->load->model('spore/Article_model','article');
        
        //get_articleDetail方法得到小说详情
        $article = $this->article->get_articleDetail($article_route);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        $data['article'] = $article;
        
        //edit_articleRead方法改变小说阅读数
        $updateStatus = $this->article->edit_articleRead($article_route);
        
        //sql中regexp 'a|b|c'的形式like匹配多个
        $article_type = str_replace("/","|",preg_replace('# #','',$article->article_type));
        //get_articleRelative方法得到相关列表
        $article_relative = $this->article->get_articleRelative($article_type,0,5);
        foreach($article_relative as $key => $relative){
            if($relative->article_route == $article_route){
                unset($article_relative[$key]);
            }
        }
        $data['article_relative'] = $article_relative;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        //get_chapterList方法得到章节列表
        $article_chapter = $this->article->get_chapterList($article_route);
        $data['article_chapter'] = $article_chapter;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 孢子文学',
            'seo_keywords'=>$article->article_title.',孢子文学,小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学',
            'seo_description'=>str_replace(array(" ","　",PHP_EOL,"\t","<p>","</p>","<br>"),array("","","","","","",""),$article->article_summary)
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('spore/article_detail',$data);
    }
    
    public function article_latest(){//小说详情（最新更新）
        
        //加载小说模型类
        $this->load->model('spore/Article_model','article');
        
        //get_articleList方法得到小说列表最新一条
        $article_list = $this->article->get_articleList('',0,1);
        $article_latest = $article_list[0];
        $article_route = $article_latest->article_route;
        
        //get_articleDetail方法得到小说详情
        $article = $this->article->get_articleDetail($article_route);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        $data['article'] = $article;
        
        //edit_articleRead方法改变小说阅读数
        $updateStatus = $this->article->edit_articleRead($article_route);
        
        //sql中regexp 'a|b|c'的形式like匹配多个
        $article_type = str_replace("/","|",preg_replace('# #','',$article->article_type));
        //get_articleRelative方法得到相关列表
        $article_relative = $this->article->get_articleRelative($article_type,0,5);
        foreach($article_relative as $key => $relative){
        		if($relative->article_route == $article_route){
        				unset($article_relative[$key]);
        		}
        }
        $data['article_relative'] = $article_relative;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        //get_chapterList方法得到章节列表
        $article_chapter = $this->article->get_chapterList($article_route);
        $data['article_chapter'] = $article_chapter;
        
        $seo = array(
        		'seo_title'=>$article->article_title.' | 孢子文学',
        		'seo_keywords'=>$article->article_title.',孢子文学,小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学',
        		'seo_description'=>str_replace(array(" ","　",PHP_EOL,"\t","<p>","</p>","<br>"),array("","","","","","",""),$article->article_summary)
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('spore/article_latest',$data);
    }
    
    public function chapter_detail($chapter_route){//小说详情
    		
    		//加载小说模型类
    		$this->load->model('spore/Article_model','article');
    		
    		//get_articleDetail方法得到小说详情
    		$chapter = $this->article->get_chapterDetail($chapter_route);
    		if(empty($chapter)){
    				$heading = '404 Page Not Found';
    				$message = 'The page you requested was not found.';
    				show_error($message, 404, $heading );
    				exit;
    		}
    		$chapter->create_time = format_article_time($chapter->create_time);
    		$data['chapter'] = $chapter;
        
        $article_route = $chapter->article_route;
        //get_articleDetail方法得到小说详情
        $article = $this->article->get_articleDetail($article_route);
        if(empty($article)){
        		$heading = '404 Page Not Found';
        		$message = 'The page you requested was not found.';
        		show_error($message, 404, $heading );
        		exit;
        }
        $data['article'] = $article;
        
    		//get_articleHotword方法得到热搜词列表
    		$article_hotword = $this->article->get_articleHotword(5,10);
    		$data['article_hotword'] = $article_hotword;
        
        //get_chapterList方法得到章节列表
        $article_chapter = $this->article->get_chapterList($article_route);
        $data['article_chapter'] = $article_chapter;
    		
    		$seo = array(
    				'seo_title'=>$chapter->chapter_title.'-'.$article->article_title.' | 孢子文学',
    				'seo_keywords'=>$chapter->chapter_title.','.$article->article_title.',孢子文学,小说,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学',
    				'seo_description'=>str_replace(array(" ","　",PHP_EOL,"\t","<p>","</p>","<br>"),array("","","","","","",""),$article->article_summary)
    		);
    		$data['seo'] = json_decode(json_encode($seo));
    		
    		$this->load->view('spore/chapter_detail',$data);
    }
    
    public function get_chapterAjax_tpl(){//加载下一章节（模板加載）
    		
    		$article_route = $this->input->get_post('article_route');//得到小说路由
        $chapter_order = $this->input->get_post('chapter_order');//得到章节顺序
    		
    		//加载小说模型类
    		$this->load->model('spore/Article_model','article');
    		//get_chapterByOrder方法得到小说章节列表
    		$chapter_list = $this->article->get_chapterByOrder($article_route,$chapter_order);
        if(count($chapter_list) == 1){
            $data['chapter'] = $chapter_list[0];
            $this->load->view('spore/templete/tpl_chapter',$data);
        }else{
            echo '';
        }
    }
    
    public function domain_list(){//域名列表（公司域名）
        
        //加载电影模型类
        $this->load->model('spore/Article_model','article');
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(5,10);
        $data['article_hotword'] = $article_hotword;
        
        $seo = array(
            'seo_title'=>' 精品域名列表',
            'seo_keywords'=>'域名出售、精品域名、平价域名',
            'seo_description'=>'平台提供大量精品域名出售;'
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('spore/domain_list',$data);
    }
    

}
?>