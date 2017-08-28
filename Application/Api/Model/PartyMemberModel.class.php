<?php
/**
 * Created by PhpStorm.
 * User: zhangtengfei
 * Date: 2017/4/21
 * Time: 下午3:00
 */


namespace Api\Model;
use Think\Model\RelationModel;

class PartyMemberModel extends RelationModel {
    protected $_link = array(
        'partymember' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name'   => 'party',
            'mapping_name' => 'partyinfo',
            'foreign_key'  => 'partyid',
            'mapping_key'  => 'partyid',
            'relation_deep'=>  true,
            'mapping_fields' => array('partyid', 'userid', 'title', 'place', 'lat','lon', 'start_time', 'creat_time', 'party_description', 'state'),
        ),
    );
}