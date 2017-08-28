<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/20
 * Time: 下午2:06
 */


namespace Api\Controller;
use Think\Controller;

class PartyController extends Controller {

    /*发起一个Party
     *
     * */
    function creatParty() {
        $data['userid'] = I('userid');  //创建人id
        $data['title'] = I('title');    //party的标题
        $data['place'] = I('place');    //party的地点
        $data['lat'] = I('lat');        //经纬度
        $data['lon'] = I('lon');        //经纬度
        $data['start_time'] = I('start_time'); //party开始时间
        $data['party_description'] = I('party_description');//简介
        $data['creat_time'] = time();       //创建时间
        $party = M('party');
        $isOK = $party->where("userid=".$data['userid']." AND start_time=".$data['start_time'])->select();  //不允许同一创建人创建多个同时进行的party
        if (!empty($isOK)) {
            //重复创建
            $result['code'] = 201;
            $result['info'] = "recreat error";
            echo json_encode($result);
            return;
        }
        $res = $party->add($data);
        $result = null;
        if (!empty($res)) {
            //创建成功
            $result['code'] = 100;
            $result['info'] = "creat successful";
            //创建成功之后往member表中插入一条数据 表示我创建的我肯定也join
            $temp = $party->where('partyid='.$res)->find();
            $member = M('partymember');
            $member->add(array('partyid'=>$temp['partyid'], 'userid'=>$data['userid'],'jointime'=>time()));
            $result['data'] = $temp;
        }else {
            //创建失败
            $result['code'] = 200;
            $result['info'] = "creat fail";
        }
        echo json_encode($result);
    }

    /*我创建的Party
     * */
    function myCreatPartyList() {
        $userid = I('userid');
        $page = I('page');
        $pageSize = 10;
        $party = D('party');
        $res = $party->relation(true)->where('userid='.$userid)->select();
        // $res = $party->relation(true)->where('userid='.$userid)->limit(($page-1)*$pageSize, ($page-1)*$pageSize+$pageSize)->select();
        $data = null;
        if (!empty($res)) {
            //查找成功
            $data['code'] = 100;
            $data['data'] = $res;
        }else {
            $data['code'] = 200;
            $data['data'] = [];
        }
        echo json_encode($data);
    }

    /*
     * 我参与的Party
     * */
    function myJoinPartyList() {
        $userid = I('userid');
        $page = I('page');
        $pageSize = 10;
        $member = D('partymember');
        $res = $member->relation(true)->where('userid='.$userid)->limit(($page-1)*$pageSize, ($page-1)*$pageSize+$pageSize)->select();
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
        /*
         * 我参与的别人创建的Party
         * */
    function myJoinList() {
        // $userid = I('userid');
        // $page = I('page');
        // $pageSize = 10;
        // $member = D('partymember');
        // $res = $member->relation(true)->where('userid='.$userid.' AND partyinfo.userid !='.$userid)->limit(($page-1)*$pageSize, ($page-1)*$pageSize+$pageSize)->select();
        // $t = $member->getLastSql();
        // echo json_encode($t);
        // $data = null;
        // if (!empty($res)) {
        //     $data['code'] = 100;
        //     $data['data'] = $res;
        // }else {
        //     $data['code'] = 200;
        //     $data['data'] = [];
        // }
        // echo json_encode($data);
        $userid = I('userid');
        $page = I('page');
        $pageSize = 10;
        $member = D('partymember');
        $res = $member->relation(true)->where('userid='.$userid)->select();
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

    /*判断指定用户是否加入了某个party
     * */
    function userShouldJoinedParty() {
        $userid = I('userid');
        $partyid = I('partyid');
        $member = M('partymember');
        $res = $member->where("partyid=".$partyid." AND userid=".$userid)->select();
        $data = null;
        if (!empty($res)) {
            //查找到了  已加入
            $data['code'] = 100;
            $data['data'] = $res;
        }else {
            //未查找到  未加入
            $data['code'] = 200;
            $data['data'] = [];
        }
        echo json_encode($data);
    }

    /*加入party
     * */
    function userJoinParty($userid, $partyid) {
        $member = M('partymember');
        $res = $member->add(array('partyid'=>$partyid, 'userid'=>$userid,'jointime'=>time()));
        $data = null;
        if (!empty($res)) {
            //加入成功
            $data['code'] = 100;
        }else {
            //加入失败
            $data['code'] = 200;
        }
        echo json_encode($data);
    }


    function getNearlyPartyList() {
        $lat = I('lat');
        $lon = I('lon');
        $page = I('page');
        $party = D('party');
        $party->field("*, (lat-".doubleval($lat).") AS sortlat,(lon-".doubleval($lon).") AS sortlon")->where()->order("sortlat, sortlon ASC");
        $res = $party->relation(true)->limit(($page-1)*10+1, $page*10)->select();
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

    function getPartyInfo() {
        $partyid = I('partyid');
        $party = D('party');
        $res = $party->relation(true)->where("partyid=".$partyid)->find();
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

        function addGroupChatId() {
            $partyid = I('partyid');
            $chatID = I('chatID');
            $party = M('party');
            $res = $party->where("partyid=".$partyid)->setField('groupchatid', $chatID);
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

        function getPartyInfoWithGroupChatID() {
            $chatID = I('chatID');
            $party = M('party');
            $res = $party->where("groupchatid=".$chatID)->find();
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

        function cancelMyCreatParty() {
            $userid = I('userid');
            $partyid = I('partyid');
            $party = M('party');
            $res1 = $party->where('userid='.$userid.' AND partyid='.$partyid)->delete();
            $data = null;
            if (!empty($res1)) {
                //删除party成功, 删除成员
                $member = M('partymember');
                $res2 = $member->where('partyid='.$partyid)->delete();
                if (!empty($res2)) {
                    //删除成员成功,删除图片
                    $picture = M('picture');
                    $res3 = $picture->where('partyid='.$partyid)->delete();
                    if (!empty($res3)) {
                        $data['code'] = 100;
                    }else{
                        $data['code'] = 200;
                    }
                }else{
                    $data['code'] = 200;
                }
            }else {
                $data['code'] = 200;
            }
            echo json_encode($data);
        }

        function quitParty() {
            $userid = I('userid');
            $partyid = I('partyid');
            $member = M('partymember');
            $res = $member->where('userid='.$userid.' AND partyid='.$partyid)->delete();
            $data = null;
            if (!empty($res)) {
                $data['code'] = 100;
            }else {
                $data['code'] = 200;
            }
            echo json_encode($data);
        }
    

}