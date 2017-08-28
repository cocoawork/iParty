<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/24
 * Time: 下午4:56
 */

namespace Api\Model;
use Think\Model\RelationModel;

class FriendModel extends RelationModel {
    protected $_link = array(
        'user' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name'   => 'user',
            'mapping_name' => 'userinfo',
            'foreign_key'  => 'userid',
            'mapping_fields' => array('userid', 'username', 'phone', 'gender', 'regist_time', 'headimage')
        ),
    );

}
