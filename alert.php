<?php
    require "element.php";
    require 'lib/html.inc.php';
    $elements = new element();
    $html = new HtmlStructure();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>walthmac</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <style type="text/css">
      body {
        background-color: transparent;
        padding-top: 40px;
      }
      .navbar-fixed-top {
        margin-bottom: 0 !important;
      }
    </style>

    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php $elements->navBar(2); ?>
    <div class="container-fluid" style="margin-left: -20px; margin-right: -20px">
        <?php $html->alert(); ?>
    </div>
    <?php include "footer.inc.php"; ?>
    <script type="text/javascript" src="js/alerts.js"></script>
  </body>
</html>
