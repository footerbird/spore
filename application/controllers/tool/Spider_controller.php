<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;
  
class Spider_controller extends CI_Controller {
    
    public function index(){//提交抓取页面
        $this->load->view('tool/spider');
    }

    public function spider(){//抓取小说详情页面
        
        $url = trim($this->input->get_post('url'));//得到抓取地址
        $html = file_get_contents($url);
        $data = QueryList::Query($html,array(
            'article_title' => array('body > div.wrap > div.book-detail-wrap.center990 > div.book-information.cf > div.book-info > h1 > em','text'),
            'article_author' => array('body > div.wrap > div.book-detail-wrap.center990 > div.book-information.cf > div.book-info > h1 > span > a','text'),
            'article_summary' => array('body > div.wrap > div.book-detail-wrap.center990 > div.book-content-wrap.cf > div.left-wrap.fl > div.book-info-detail > div.book-intro','html'),
            'thumb_path' => array('#bookImg > img','src'),
            'article_type' => array('body > div.wrap > div.crumbs-nav.center990.top-op > span > a:nth-child(4)','text'),
        ))->data[0];
        $data_chapters = QueryList::Query($html,array(
        		'article_chapter' => array('#j-catalogWrap > div.volume-wrap > div > ul > li > a','href'),
        ))->data;
        
        $insert_data['article_route'] = random_string_numlet(6);
        $insert_data['article_title'] = trim($data['article_title']);
        $insert_data['article_author'] = trim($data['article_author']);
        $insert_data['article_summary'] = trim($data['article_summary']);
        $insert_data['thumb_path'] = $this->upload('http:'.trim($data['thumb_path']));
        $article_type_explode = explode('频道',trim($data['article_type']));
        $insert_data['article_type'] = $article_type_explode[0];
        
        $chapter_temp = array();
        foreach($data_chapters as $key => $chapter){
        		array_push($chapter_temp,$chapter['article_chapter']);
        }
        $insert_data['article_chapter'] = $chapter_temp;
        
        $this->load->view('tool/spider_confirm',$insert_data);
        
    }

    public function insert(){
        
        $article_route = trim($this->input->get_post('article_route'));//小说路由
        $article_title = trim($this->input->get_post('article_title'));//小说标题
        $article_author = trim($this->input->get_post('article_author'));//小说作者
        $article_summary = trim($this->input->get_post('article_summary'));//小说简介
        $thumb_path = trim($this->input->get_post('thumb_path'));//小说封面
        $article_type = trim($this->input->get_post('article_type'));//小说类型
        $article_chapter = $this->input->get_post('article_chapter');//小说章节
        $status = 1;
        
        //加载电影模型类
        $this->load->model('spore/Article_model','article');
        $addStatus = $this->article->add_articleOne($article_route,$article_title,$article_author,$article_summary,$thumb_path,$article_type,$status);
        if(1){
            $array_chapter = explode(PHP_EOL,$article_chapter);
            foreach($array_chapter as $key => $chapter){
                sleep(1);
            		$html = file_get_contents('https:'.trim($chapter));
            		$data = QueryList::Query($html,array(
            				'chapter_title' => array('.text-wrap > div > div.text-head > h3','text'),
            				'chapter_content' => array('.text-wrap > div > div.read-content.j_readContent','html'),
            		))->data[0];
                $chapter_route = random_string_numlet(6);
                $chapter_title = trim($data['chapter_title']);
                $chapter_content = trim($data['chapter_content']);
                $addChapterStatus = $this->article->add_ChapterOne($key,$chapter_route,$chapter_title,$chapter_content,$article_route,$status);
                if(1){
                    echo '插入章节【'.$chapter_title.'】成功<br/>';
                }else{
                    echo '插入章节【'.$chapter_title.'】失败<br/>';
                }
            }
        }else{
            echo '插入小说《'.$article_title.'》失败';
        }
        
    }

    public function upload($path){//上传图片并返回图片地址
        $imgInfo = getimagesize($path);
        switch($imgInfo[2]){
        case 1:
            $imgType = 'gif';
            break;
        case 2:
            $imgType = 'jpg';
            break;
        case 3:
            $imgType = 'png';
            break;
        default:
            $imgType = 'jpg';
            break;
        }
        $html = file_get_contents($path);
        $random_string = random_string_numlet(12);
        $upload_path = 'uploads/'.$random_string.'.'.$imgType;
        file_put_contents($upload_path, $html);
        return $upload_path;
    }
    
}
?>