<?php
class Article_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    //新增一条小说记录,addslashes方法会对引号进行转义
    public function add_articleOne($article_route,$article_title,$article_author,$article_summary,$thumb_path,$article_type,$status){
        $sql = "insert into article_info(article_route,article_title,article_author,article_summary,thumb_path,article_type,status"
            .")values('".$article_route."','".addslashes($article_title)."','".addslashes($article_author)."','".addslashes($article_summary)."','".$thumb_path."','".$article_type."',".$status.")";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //新增一条章节记录,addslashes方法会对引号进行转义
    public function add_ChapterOne($chapter_order,$chapter_route,$chapter_title,$chapter_content,$article_route,$status){
        $sql = "insert into chapter_info(chapter_order,chapter_route,chapter_title,chapter_content,article_route,status"
            .")values(".$chapter_order.",'".$chapter_route."','".addslashes($chapter_title)."','".addslashes($chapter_content)."','".$article_route."',".$status.")";
        $query = $this->db->query($sql);
        return $query;
    }
    
    //小说列表页面,传入article_type,如'玄幻',输出前$length条数
    public function get_articleList($article_type,$start,$length){
        if($article_type == ''){
            $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score from article_info "
                ." where status = 1 order by rand() limit ".$start.",".$length;
        }else{
            $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score from article_info "
                ." where status = 1 and article_type like '%".$article_type."%' order by create_time desc limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    //小说列表条目数,传入article_type
    public function get_articleCount($article_type){
        if($article_type == ''){
            $sql = "select * from article_info "
                ." where status = 1";
        }else{
            $sql = "select * from article_info "
                ." where status = 1 and article_type like '%".$article_type."%'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //推荐小说列表,输出前$length条数
    public function get_articleRecommend($start,$length){
        $sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score from article_info "
            ." where status = 1 order by article_read desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //小说搜索列表页面,输出前$length条数
    public function get_articleSearch($keyword,$start,$length){
    	$sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score from article_info "
    		." where status = 1 and concat(article_title,article_summary) like '%".addslashes($keyword)."%' order by create_time desc limit ".$start.",".$length;
    	$query = $this->db->query($sql);
    	return $query->result();
    }
    
    //添加小说热搜词
    public function add_articleHotword($keyword){
    	$sql = "insert into article_hotword(hotword_name)values('".$keyword."')";
    	$query = $this->db->query($sql);
    	return $query;
    }
    
    //热搜词列表,输出前$length条数
    public function get_articleHotword($start,$length){
        $sql = "select hotword_name,COUNT(hotword_name) as hotword_count from article_hotword"
            ." where DATE_SUB(CURDATE(), INTERVAL 1 DAY) <= date(create_time) group by hotword_name order by hotword_count desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //小说详情页面,传入article_route
    public function get_articleDetail($article_route){
    	$sql = "select * from article_info where article_route = '".$article_route."'";
    	$query = $this->db->query($sql);
    	return $query->row();
    }
    
    //改变小说阅读数
    public function edit_articleRead($article_route){
    	$sql = "update article_info set"
    		." article_read=article_read+1"
    		." where article_route='".$article_route."'";
    	$query = $this->db->query($sql);
    	return $query;
    }
    
    //相关小说列表,传入小说类型数组,输出前$length条数
    public function get_articleRelative($article_type,$start,$length){
    	$sql = "select article_route,article_title,article_summary,thumb_path,article_type,article_score from article_info "
    		." where status = 1 and article_type regexp '".$article_type."' limit ".$start.",".$length;
    	$query = $this->db->query($sql);
    	return $query->result();
    }
    
    //小说章节列表,传入article_route
    public function get_chapterList($article_route){
    	$sql = "select * from chapter_info where article_route = '".$article_route."'";
    	$query = $this->db->query($sql);
    	return $query->result();
    }
    
    //章节详情页面,传入chapter_route
    public function get_chapterDetail($chapter_route){
    	$sql = "select * from chapter_info where chapter_route = '".$chapter_route."'";
    	$query = $this->db->query($sql);
    	return $query->row();
    }
    
    //小说章节列表,传入article_route和chapter_order,正常情况下为一篇
    public function get_chapterByOrder($article_route,$chapter_order){
    	$sql = "select * from chapter_info where article_route = '".$article_route."' and chapter_order = ".$chapter_order;
    	$query = $this->db->query($sql);
    	return $query->result();
    }
    
}
?>