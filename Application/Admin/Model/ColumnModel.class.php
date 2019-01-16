<?php
namespace Admin\Model;
use Think\Model;
class ColumnModel extends Model {
    protected $_validate = array(
        array('column_name','require','栏目不能为空！',1,'regex',3), //不能为空
        array('column_name','unique','栏目已存在！',0,'unique',3), //栏目名称唯一
    );
}