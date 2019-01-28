<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->nav();
        $this->news();
        $this->links();
    }
    public function nav(){
        $column=D('Column');
        $columns=$column->order('sort desc')->select();
        $this->assign('columns',$columns);
    }
    public function news(){
        $article=D('article');
        $articles=$article->select();
        $this->assign('articles',$articles);
    }
    public function links(){
        $link=D('link');
        $links=$link->select();
        $this->assign('links',$links);
    }
}