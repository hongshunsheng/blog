<?php
namespace Admin\Model;
use Think\Model;
class LinkModel extends Model {
    protected $_validate = array(
        array('title','require','链接名称不能为空！',1,'regex',3), //
        array('url','require','链接地址不能为空！',1,'regex',3), //
        array('title','unique','链接名称不能重复！',0,'unique',3), //

    );
}