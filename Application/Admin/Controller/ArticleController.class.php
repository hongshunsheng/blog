<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {

    //载入article页面
    public function lst(){
        $article=D('article');
        $count= $article->count();// 查询满足要求的总记录数
        $Page= new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show= $Page->show();// 分页显示输出
        $list = $article->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    //编辑链接
    public function edit(){
        $article=D('article');
        $object=$article->find(I('id'));
        $this->assign('article',$object);
        if(IS_POST){
            $data['id']=I('article_id');
            $data['title']=I('article_title');
            $data['url']=I('article_url');
            $data['desc']=I('article_desc');
            if($article->create($data)){
                if($article->save()){
                    $this->success('修改链接成功',U(lst));
                    return;
                }else{
                    $this->error($data->getError());
                }
            }
        }
        $this->display();
    }

    //新增链接
    public function add(){
        $article=D('article');
        if(IS_POST){
            $data['title']=I('article_title');
            $data['url']=I('article_url');
            $data['desc']=I('article_desc');
            if($article->create($data)){
                //如果创建数据对象成功
                if($article->add()){
                    $this->success('链接链接成功！',U(lst));
                }else{
                    $this->error('添加链接失败！');
                }
            }else{
                $this->error($article->getError());
                //如果创建数据对象失败，则获取数据对象的Error信息填入本控制器的error方法
            }
            return;
            //优化显示效果->增加return后，添加成功后出现提示页面再跳转回article页面
        }
        $this->display();
    }

    //删除链接
    public function del(){
        $article=D('article');
        if($article->delete(I('id'))){
            $this->success('删除链接成功',U(lst));
        }else{
            $this->error('删除链接失败');
        }
    }

    //链接排序
    //失效方法
    public function sort(){
        $article=D('article');
        foreach($_POST as $id=>$sort){
            $article->where(array('id'=>$id))->setField('sort',$sort);
        }
        $this->success('排序成功',U('lst'));
    }
}