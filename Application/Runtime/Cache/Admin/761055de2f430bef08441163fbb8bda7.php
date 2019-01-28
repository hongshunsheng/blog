<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/blog/Application/Admin/Public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/blog/Application/Admin/Public/css/main.css"/>
    <script type="text/javascript" src="http://localhost/blog/Application/Admin/Public/js/libs/modernizr.min.js"></script>
    <script type="text/javascript" src="http://localhost/blog/Application/Admin/Public/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="http://localhost/blog/Application/Admin/Public/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" src="http://localhost/blog/Application/Admin/Public/ueditor/lang/zh-cn.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="/blog/index.php/Admin/Index/index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#">管理员<?php echo $_SESSION['admin_name']?></a></li>
                <li><a href="/blog/index.php/Admin/Article/edit/id/<?php echo $_SESSION['id']?>">修改密码</a></li>
                <li><a href="/blog/index.php/Admin/Login/logout/">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
    <div class="sidebar-title">
        <h1>菜单</h1>
    </div>
    <div class="sidebar-content">
        <ul class="sidebar-list">
            <li>
                <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                <ul class="sub-menu">
                    <li><a href="/blog/index.php/Admin/Article/lst"><i class="icon-font">&#xe008;</i>文章管理</a></li>
                    <li><a href="/blog/index.php/Admin/Column/lst"><i class="icon-font">&#xe005;</i>分类管理</a></li>
                    <li><a href="/blog/index.php/Admin/Link/lst"><i class="icon-font">&#xe012;</i>友情链接</a></li>
                    <li><a href="/blog/index.php/Admin/Admin/lst"><i class="icon-font">&#xe052;</i>管理员管理</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">文章管理</a><span class="crumb-step">&gt;</span><span>修改文章</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                            <th><i class="require-red">*</i>文章标题：</th>
                            <td>
                                <input type="hidden" name="article_id" value="<?php echo ($article["id"]); ?>"/>
                                <input class="common-text required" id="article_title" name="article_title" size="50" value="<?php echo ($article["title"]); ?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>文章描述：</th>
                            <td>
                                <textarea style="width:420px;height: 100px;" name="article_desc"><?php echo ($article["desc"]); ?></textarea>
                            </td>
                        </tr>
                        <?php if($article['pic'] != ''): ?><tr>
                                <th>图片信息：</th>
                                <td>
                                    <img src="/blog<?php echo ($article["pic"]); ?>" height="50"/>
                                </td>
                            </tr><?php endif; ?>
                        <tr>
                            <th><i class="require-red">*</i>更新图片：</th>
                            <td>
                                <input class="" id="pic" name="article_pic" type="file"/>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>所属栏目：</th>
                            <td>
                                <select name="column_id">
                                    <option>default</option>
                                    <?php if(is_array($columns)): $i = 0; $__LIST__ = $columns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo["id"] == $article['column_id']): ?>selected="selected"<?php endif; ?>
                                        value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>内容：</th>
                            <td>
                                <textarea name="content" id="content"><?php echo ($article["content"]); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                            </td>
                        </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
<script type="text/javascript">
    //var ue = UE.getEditor('container');
    UE.getEditor('content',{initialFrameWidth:1000,initialFrameHeight:200,})
    //引入富文本编辑器
</script>
</body>
</html>