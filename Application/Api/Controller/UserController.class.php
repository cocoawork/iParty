<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/19
 * Time: 下午3:44
 */


namespace Api\Controller;
use Think\Controller;

class UserController extends Controller {

    //用户注册
    function userRegist() {
        $password = I('password');
        $phoneNum = I('phone');
        $model = M('user');
        $res = $model->where('phone='.$phoneNum)->find();
        $data = null;
        if (!empty($res)){
            //该手机号已经被注册了
            $data['code'] = 201;
            $data['info'] = "该手机号已被注册";
        }else {
            //该手机号没有被注册
            $user['username'] = "user".$phoneNum;
            $user['password'] = $password;
            $user['phone'] = $phoneNum;
            $user['headimage'] = 'defaultUsertHeadImage';
            $user['regist_time'] = time();
            $isSuccess = $model->add($user);
            if ($isSuccess) {
                $res = $model->where("phone=".$phoneNum)->find();
                $data['code'] = 100;
                $data['info'] = "注册成功!";
                $data['userid'] = $res['userid'];
            }else {
                $data['code'] = 200;
                $data['info'] = "注册失败!";
            }
        }
        echo json_encode($data);
    }


    //用户登录
    function userLogin() {
        //得到登录手机号和密码
        $user['phone'] = I('phone');
        $user['password'] = I('password');
        //数据库验证是否存在账号
        $model = M('user');
        $res = $model->where('phone = '.$user['phone'])->find();
        $data = null;
        if (!empty($res)) {
            //用户名存在  验证密码
            if (md5($res['password'].$res['phone'], false) == $user['password']) {
                //密码正确,验证通过
                $data['code'] = 100;
                $res['password'] = '';
                $data['info'] = $res;
            }else {
                $data['code'] = 201;
                $data['info'] = "密码错误";
            }
        }else {
            $data['code'] = 202;
            $data['info'] = "账号不存在!";
        }
        echo json_encode($data);
    }

    function updateUserinfo() {
        $uid = I('userid');
        $key = I('key');
        $val = I('value');
        $model = M('user');
        $res = $model->where("userid = ".$uid)->setField($key, $val);
        $data = null;
        if (isset($res)) {
            //更新成功
            $data['code'] = 100;
            $info = $model->where("userid = ".$uid)->find();
            $info['password'] = '';
            $data['info'] = $info;
        }else{
            $data['code'] = 200;
        }
        echo json_encode($data);
    }

    function isUserExist() {
        $phone = I('phone');
        $model = M('user');
        $res = $model->where("phone=".$phone)->find();
        $data = null;
        if (!empty($res)) {
            $data['code'] = "100";
            $data['data'] = $res['userid'];
        }else {
            $data['code'] = "200";
            $data['data'] = "用户不存在";
        }
        echo json_encode($data);
    }


}