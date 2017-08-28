<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/21
 * Time: 下午2:40
 */
namespace Api\Model;
use Think\Model\RelationModel;

class PartyModel extends RelationModel {

    protected $_link = array(
      'user' => array(
          'mapping_type' => self::BELONGS_TO,
          'class_name'   => 'user',
          'mapping_name' => 'from',
          'foreign_key'  => 'userid',
          'mapping_fields' => array('userid', 'username', 'phone', 'gender', 'regist_time', 'headimage')
      ),
        'partymember' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name'   => 'partymember',
            'foreign_key'  => 'partyid',
            'mapping_name' => 'members',
            'mapping_fields'=>array('id', 'userid', 'jointime')
        ),
        'picture' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name'   => 'picture',
            'foreign_key'  => 'partyid',
            'mapping_name' => 'pics',
            'mapping_fields'=>array('picid', 'userid', 'url', 'partyid', 'creat_time')
        ),
    );

}

