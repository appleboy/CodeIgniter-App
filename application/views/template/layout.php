<!doctype html>
<html class="no-js" lang="<?php echo $lang; ?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $site_title; ?></title>
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="keywords" content="<?php echo $site_keywords; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo $meta_tag; ?>
<?php echo $styles; ?>
<!-- JS -->
<?php echo $scripts_header; ?>
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
    <?php echo $content; ?>
  </div>
    <?php echo $scripts_footer; ?>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
(function (b,o,i,l,e,r) {b.GoogleAnalyticsObject=l;b[l]||(b[l]=
function () {(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
e=o.createElement(i);r=o.getElementsByTagName(i)[0];
e.src='//www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
