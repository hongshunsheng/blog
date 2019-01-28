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
                    //echo 'yes';
                    //session('admin_name',$admin->admin_name);
                    $this->success('登陆成功',U('Index/index'));

                }else{
                    $this->error('您的用户或者密码错误');
                }
            }else{
                $this->error($admin->getError());
            }
            return;
        }
        if(session('id')){
            $this->error('您已经登陆过了,请勿重复操作！',U('Index/index'));
        }
        $this->display('login');
    }
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length = 4;
        $Verify->useNoise = true;
        $Verify->entry();
}
    public function logout(){
        session(null);
        $this->success('注销成功！',U('Login/index'));
    }
}