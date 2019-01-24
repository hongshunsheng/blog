<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $admin=D('admin');
        if(IS_POST){
            //echo 'post';
            if($admin->create($_POST,4)){
                //echo 'post';
                if($admin->login()){
                    echo 'yes';
                    $this->success('登陆成功',U('Index/index'));
                }else{
                    $this->error('您的用户或者密码错误');
                }
            }else{
                $this->error($admin->getError());
            }
            return;
        }
        $this->display('login');
    }
}