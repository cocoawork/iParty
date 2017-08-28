<?php
/**
 * Created by PhpStorm.
 * User: cocoawork
 * Date: 2017/4/22
 * Time: 上午12:04
 */


namespace Api\Controller;
use Think\Controller;
require 'vendor/autoload.php';
use Qiniu\Auth;


class PictureController extends  Controller {

    function getQiniuToken() {
        $accessKey = 'J-PXKHthwCtojHrvumnGkeOQLvWpUnOG2troB3tL';
        $secretKey = '7StvZw3lohdX8I35pzpHgjlQde8Ls_3RdoFCI06d';
        $auth = new  Auth($accessKey, $secretKey);
        $bucket = 'iparty';
        $token = $auth->uploadToken($bucket);
        echo $token;
    }



    function addPicture() {
        $data['partyid'] = I('partyid');
        $data['userid'] = I('userid');
        $data['url'] = I('url');
        $data['creat_time'] = time();
        $picture = M('picture');
        $res = $picture->add($data);
        $result = null;
        if (!empty($res)) {
            //上传成功
            $result['code'] = 100;
        }else {
            //上传失败
            $result['code'] = 200;
        }
        echo json_encode($result);
    }




}