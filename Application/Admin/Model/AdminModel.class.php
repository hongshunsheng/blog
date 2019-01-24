<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {
    protected $_validate = array(
        //array('user_name','require','账号不能为空！',1,'regex',3), //账号不能为空
        //array('user_name','unique','账号已存在！',1,'unique',3), //账号唯一
        //array('password','require','密码不能为空！',1,'regex',3), //密码不能为空
    );

    public function login(){
        $password=$this->password;//获取输入的password
        $info=$this->where(array('admin_name'=>$this->admin_name))->find();//根据获取的username查询对象
        if($info){
            if($info['password']==md5($password)){//比对密码
                //成功比对后增加两个session值，分别是ID和username
                session('id',$info['id']);
                session('username',$info['username']);
                return true;
            }else{
                return false;
            }
        }else{
           return false;
        }
    }
}