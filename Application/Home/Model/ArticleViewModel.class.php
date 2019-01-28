<?php
namespace Home\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends ViewModel  {
    /*
     * 视图通常是指数据库的视图，视图是一个虚拟表，其内容由查询定义。
     * 同真实的表一样，视图包含一系列带有名称的列和行数据。
     * 但是，视图并不在数据库中以存储的数据值集形式存在。
     * 行和列数据来自由定义视图的查询所引用的表，并且在引用视图时动态生成。
     * 对其中所引用的基础表来说，视图的作用类似于筛选。
     */
    public $viewFields = array(
        'Article'=>array('id','title','desc'=>'article_desc','pic','content','time','_type'=>'LEFT'),
        'Column'=>array('column_name','_as'=>'TheColumn', '_on'=>'Article.column_id=TheColumn.id')
    );
    //'type'=>'LEFT',这里的_type定义对下一个表有效，因此要注意视图模型的定义顺序。
}