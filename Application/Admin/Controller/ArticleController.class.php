<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {

    //载入article页面
    public function lst(){
        $article=D('ArticleView');
        $count= $article->count();// 查询满足要求的总记录数
        $Page= new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show= $Page->show();// 分页显示输出
        $list = $article->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        //dump($article);
        $this->display();
    }

    //编辑文章
    public function edit(){
        $article=D('article');
        $column=D('column');
        $columns=$column->select();
        $object=$article->find(I('id'));
        $this->assign('article',$object);
        $this->assign('columns',$columns);
        if(IS_POST){
            //dump($object);
            $data['id']=I('article_id');
            //dump($_SERVER['DOCUMENT_ROOT']);
            $data['title']=I('article_title');
            if($_FILES['article_pic']['name']!==''){//如果上传的对象的name不为空
                $article=D('article');//获取实例
                $object=$article->find(I('article_id'));//获取对象
                unlink($_SERVER['DOCUMENT_ROOT'].'/blog'.$object['pic']);//组合图片地址，删除旧图片
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     '.'; // 设置附件上传根目录
                $upload->savePath  =     '/Public/Uploads/'; // 设置附件上传（子）目录
                $info   =   $upload->uploadOne($_FILES['article_pic']);
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                    //echo 'error';
                }else{// 上传成功
                    $data['pic']=$info['savepath'].$info['savename'];
                }
            }
            $data['desc']=I('article_desc');
            $data['content']=I('content');
            $data['column_id']=I('column_id');
            $data['time']=date("Y-m-d H:i:s" );//对应mysql的datetime数据类型
            if($article->create($data)){
                //如果创建数据对象成功
                if($article->save()){
                    $this->success('修改文章成功！',U(lst));
                }else{
                    $this->error('修改文章失败！');
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

    //新增文章
    public function add(){
        $article=D('article');//创建数据库表的对应对象
        if(IS_POST){
            $data['title']=I('article_title');
            //$pic=I('article_pic');
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     '.'; // 设置附件上传根目录
            $upload->savePath  =     '/Public/Uploads/'; // 设置附件上传（子）目录
            $info   =   $upload->uploadOne($_FILES['article_pic']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data['pic']=$info['savepath'].$info['savename'];
            }
            $data['desc']=I('article_desc');
            $data['content']=I('content');
            $data['column_id']=I('column_id');
            $data['time']=date("Y-m-d H:i:s" );//对应mysql的datetime数据类型
            if($article->create($data)){
                //如果创建数据对象成功
                if($article->add()){
                    $this->success('添加文章成功！',U(lst));
                }else{
                    $this->error('添加文章失败！');
                }
            }else{
                $this->error($article->getError());
                //如果创建数据对象失败，则获取数据对象的Error信息填入本控制器的error方法
            }
            return;
            //优化显示效果->增加return后，添加成功后出现提示页面再跳转回article页面
        }
        $column=D('column');
        $columns=$column->select();
        $this->assign('columns',$columns);
        $this->display();
    }

    //删除文章
    public function del(){
        $article=D('article');
        if($article->delete(I('id'))){
            $this->success('删除文章成功',U(lst));
        }else{
            $this->error('删除文章失败');
        }
    }

}