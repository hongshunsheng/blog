<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {

    //载入admin页面
    public function lst(){
        $admin=D('admin');
        $lst=$admin->select();
        //根据sort排列管理员
        $this->assign('admins',$lst);
        $this->display();
    }

    //编辑管理员
    public function edit(){
        $admin=D('admin');
        if(IS_POST){
            $data['id']=I('id');
            $data['admin_name']=I('admin_name');
            if(I('password')==''){
                $this->error('密码不能为空');
            }else{
                $data['password']=md5(I('password'));
            }

            //dump($data);
            //echo json_encode($data); 打印$data
            //echo $admin->save($data); 打印更新操作的sql返回值

            if($admin->create($data)){
                if($admin->save()){
                    $this->success('修改管理员成功',U(lst));
                    return;
                }else{
                    $this->error('修改管理员失败');
                }
            }else{
                return $this->error($admin->getError());
            }
        }
        $object=$admin->find(I('id'));
        $this->assign('admin',$object);
        $this->display();
    }

    //新增管理员
    public function add(){
        $admin=D('admin');
        if(IS_POST){
            $data['admin_name']=I('admin_name');
            $data['password']=md5(I('password'));
            if($admin->create($data)){
                //如果创建数据对象成功
                if($admin->add()){
                    $this->success('管理员添加成功！',U(lst));
                }else{
                    $this->error('添加管理员失败！');
                }
            }else{
                $this->error($admin->getError());
                //如果创建数据对象失败，则获取数据对象的Error信息填入本控制器的error方法
            }
            return;
            //优化显示效果->增加return后，添加成功后出现提示页面再跳转回admin页面
        }
        $this->display();
    }

    //删除管理员
    public function del(){
        $admin=D('admin');
        //ID为5的超级管理员不能删除
        if(I('id')==1){
            $this->error('本管理员不能删除');
        }else{
            if($admin->delete(I('id'))){
                $this->success('删除管理员成功',U(lst));
            }else{
                $this->error('删除管理员失败');
            }
        }

    }
}