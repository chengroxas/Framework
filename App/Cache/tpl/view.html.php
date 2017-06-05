<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>博文管理</title>
  <meta name="description" content="这是一个 table 页面">
  <meta name="keywords" content="table">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/App/Static/assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/App/Static/assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/App/Static/assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/App/Static/assets/css/admin.css">
  <link rel="stylesheet" href="/App/Static/css/thinkphp3.2.3-page.css">
</head>
<style>
    .table-main{padding:0px;}
</style>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<?php require $this->getIncludeFile('header.html')  ?>
<div class="am-cf admin-main">
  <!-- sidebar start -->
  <!-- sidebar end -->
  <!-- content start -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">博文管理</strong> / <small>Table</small></div>
      </div>

      <hr>
      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
              <a href="{:U('Article/index')}" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</a>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-form-group">
            <select data-am-selected="{btnSize: 'sm'}">
              <option value="option1">所有类别</option>
              <option value="option2">IT业界</option>
              <option value="option3">数码产品</option>
              <option value="option3">笔记本电脑</option>
              <option value="option3">平板电脑</option>
              <option value="option3">只能手机</option>
              <option value="option3">超极本</option>
            </select>
          </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button">搜索</button>
          </span>
          </div>
        </div>
      </div>

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main am-table-bordered">
              <thead>
              <tr>
                 <th class="table-id">ID</th>
                 <th class="table-author am-hide-sm-only">类型</th>
                 <th class="table-author am-hide-sm-only">标题</th>
                 <th class="table-num">作者</th>
                 <th class="table-time">修改时间</th>
                 <th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
			 <?php foreach($this->_data['article'] as $val) { ?>
              <tr>
                <td><?php echo $val['id'] ?></td>
                <td><?php echo $val['type'] ?></td>
                <td class="am-hide-sm-only"><?php echo $val['title'] ?></td>
				<td><?php echo $val['author'] ?></td>
				<td><?php echo $val['time'] ?></td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a href="{:U('Article/index',array('id'=>$log['id']))}" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      <a href="delete?id=<?php echo $val['id'] ?>" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</a>
                    </div>
                  </div>
                </td>
              </tr>
			<?php }?>
             
             
              </tbody>
            </table>
            <div class="am-cf">
				<!--共多少条记录--->
              <div class="am-fr page1">
				  <?php echo $this->_data['link'] ?>
              </div>
            </div>
            <hr />
            <p>注：.....</p>
          </form>
        </div>
      </div>
    </div>

	

  </div>
  <!-- content end -->
</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
