<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>新聞群組列表</title>
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
          <li class="active"><a href="/topic">首頁</a></li>
          <li><a href="/topic/create">新增</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  <div class="container theme-showcase" role="main">
    <div class="jumbotron">

    </div>
    <?php if (!empty($message)):?>
    <div class="alert alert-success" role="alert">
      <a href="#" class="alert-link"><?php echo $message;?></a>
    </div>
    <?php endif;?>
    <div class="page-header">
      <h1>新聞列表</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>重要</th>
              <th>標題</th>
              <th>描述</th>
              <th>建立時間</th>
              <th>修改時間</th>
              <th>動作</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($items as $key => $row) {
                $label = ($row->is_feature == "1") ? "<span class='label label-warning'>置頂</span>" : "";
              ?>
              <tr>
                <td><?php echo ($key + 1); ?></td>
                <td><?php echo $label; ?></td>
                <td><?php echo htmlspecialchars($row->title); ?></td>
                <td><?php echo htmlspecialchars($row->description); ?></td>
                <td><?php echo $row->created_at; ?></td>
                <td><?php echo $row->updated_at; ?></td>
                <td>
                  <a href="/topic/delete/<?php echo $row->id; ?>" class="btn btn-sm btn-danger">刪除</a>
                  <a href="/topic/edit/<?php echo $row->id; ?>" class="btn btn-sm btn-info">修改</a>
                </td>
              </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
