<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/24
 * Time: 下午4:44
 */

namespace Api\Controller;
use Think\Controller;
class FriendController extends Controller {


    //添加好友
    function addFriend() {
        $data['myid'] = I('myid');
        $data['userid'] = I('userid');
        $data['time'] = time();
        $data['nickname'] = I('nickname');
        $friend = M('friend');
        $res = $friend->add($data);
        $result = null;
        if (!empty($res)) {
            //添加成功
            $result['code'] = 100;
        }else {
            //添加失败
            $result['code'] = 200;
        }
        echo json_encode($result);
    }


    function updateNickname() {
        $myid = I('myid');
        $userid = I('userid');
        $nickname = I('nickname');
        $friend = M('friend');
        $res = $friend->where("myid=".$myid." AND userid=".$userid)->setField('nickname', $nickname);
        $result = null;
        if (!empty($res)) {
            //修改成功
            $result['code'] = 100;
            $result['nickname'] = $nickname;
        }else {
            //修改失败
            $result['code'] = 200;
            $result['nickname'] = null;
        }
        echo json_encode($result);
    }


    //获取好友列表
    function getFriendList() {
        $myid = I('myid');
        $friend = D('friend');
        $res = $friend->relation(true)->where("myid=".$myid)->select();
        $data = null;
        if (!empty($res)) {
            $data['code'] = 100;
            $data['data'] = $res;
        }else {
            $data['code'] = 200;
            $data['data'] = [];
        }
        echo json_encode($data);
    }


    /*根据userid查询用户信息
     * */
    function getUserInfo() {
        $userid = I('userid');
        $myid = I('myid');
        //先查询是否为好友关系
        $friend = D('friend');
        $res = $friend->relation(true)->where("myid=".$myid." AND userid=".$userid)->find();
        $data = null;
        if (!empty($res)) {
            //是好友关系
            $data['code'] = 100;
            $data['data'] = $res;
        }else {
            //不是好友关系
            $user = M('user');
            $res = $user->where('userid='.$userid)->find();
            if (!empty($res)) {
                $res['password'] = '';
                $data['code'] = 101;
                $data['data'] = $res;
            }else {
                $data['code'] = 200;
                $data['data'] = [];
            }
        }
        echo json_encode($data);
    }

    function isFriendWith() {
        $myid = I('myid');
        $userid = I('userid');
        $friend = M('friend');
        $res = $friend->relation(true)->where("myid=".$myid."userid=".$userid)->find();
        $data = null;
        if (!empty($res)) {
            $data['code'] = 100;
            $data['data'] = $res;
        }else{
            $data['code'] = 200;
            $data['data'] = 'not friend';
        }
        echo json_encode($data);
    }

}


