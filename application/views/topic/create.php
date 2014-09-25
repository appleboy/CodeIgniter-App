<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>新聞群組列表::建立</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">新聞群組</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="/topic">首頁</a></li>
          <li class="active"><a href="/topic/create">新增</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  <div class="container theme-showcase" role="main">
    <div class="jumbotron">

    </div>
    <div class="page-header">
      <h1>建立新聞</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form role="form" action="/topic/create" method="POST">
          <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="請輸入標題">
          </div>
          <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="is_feature"> 是否置頂
            </label>
          </div>
          <button type="submit" class="btn btn-default">送出</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
