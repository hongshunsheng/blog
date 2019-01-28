<?php
namespace Admin\Controller;
use Think\Controller;
class ColumnController extends CommonController {

    //载入column页面
    public function lst(){
        $column=D('column');
        $lst=$column->order('sort asc')->select();
        //根据sort排列栏目
        $this->assign('columns',$lst);
        $this->display();
    }

    //编辑栏目
    public function edit(){
        $column=D('column');
        $object=$column->find(I('id'));
        $this->assign('column',$object);
        if(IS_POST){
            $data['id']=I('id');
            $data['column_name']=I('column_name');
            if($column->create($data)){
                //echo json_encode($column);
                if($column->save()){
                    $this->success('修改栏目成功',U(lst));
                    return;
                }else{
                    $this->error($data->getError());
                }
            }
        }
        $this->display();
    }

    //新增栏目
    public function add(){
        $column=D('column');
        if(IS_POST){
            $data['column_name']=I('column_name');
            if($column->create($data)){
                //如果创建数据对象成功
                if($column->add()){
                    $this->success('栏目添加成功！',U(lst));
                }else{
                    $this->error('添加栏目失败！');
                }
            }else{
                $this->error($column->getError());
                //如果创建数据对象失败，则获取数据对象的Error信息填入本控制器的error方法
            }
            return;
            //优化显示效果->增加return后，添加成功后出现提示页面再跳转回column页面
        }
        $this->display();
    }

    //删除栏目
    public function del(){
        $column=D('column');
        if($column->delete(I('id'))){
            $this->success('删除栏目成功',U(lst));
        }else{
            $this->error('删除栏目失败');
        }
    }

    //栏目排序
    public function sort(){
        $column=D('column');
        foreach($_POST as $id=>$sort){
            $column->where(array('id'=>$id))->setField('sort',$sort);
        }
        $this->success('排序成功',U('lst'));
    }
}