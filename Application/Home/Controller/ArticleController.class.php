<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    public function index(){
        $article=D('ArticleView');
        $info=$article->where(array(('id')=>I('id')))->find();
        $this->assign('article',$info);
        $this->display();
    }
}