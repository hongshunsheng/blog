<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model {
    protected $_validate = array(
        array('article_title','require','标题不能为空！',1,'regex',3), //不能为空
        array('article_desc','require','简介不能为空！',1,'regex',3), //不能为空
        array('content','require','内容不能为空！',1,'regex',3), //不能为空
        array('article_title','unique','标题已存在！',0,'unique',3), //名称唯一
    );
}