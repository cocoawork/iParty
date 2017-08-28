<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/28
 * Time: 上午10:09
 */

namespace Api\Controller;
use Think\Controller;
class OpenAppController extends Controller {
    function index() {
        $partyid = I('partyid');
        $this->assign('partyid', $partyid);
        $this->display();
    }
}