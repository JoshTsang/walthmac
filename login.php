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
    <style type="text/css">
      html {
          background: #0D7BD5 url('img/glow.png') no-repeat center center;
      }
      
      body {
        height: 100%;
        background-color: transparent;
      }
      
      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -100px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      
      .loginSection {
          min-height: 300px;
          margin-left: auto;
          margin-right: auto;
          width: 250px;
          margin-top: 15%;
          display: none;
      }
      
     .logo {
          width: 100%;
          margin-top: 5%;
          color: #FFFFFF;
          text-align: center;
      }
      
      #jsWarning {
          min-height: 300px;
          margin-left: auto;
          margin-right: auto;
          width: 250px;
          margin-top: 20%;
          color: #FFFFFF;
      }
      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
    </style>

    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="wrap">
        <div class="logo"><h1 style="color: #FFFFFF">沃思测控</h1></div>
        <div id="jsWarning">
            <p>网页显示需要Javascript的支持!<br/>您的浏览器不支持Javascript，请使用支持Javascript的浏览器访问！</p>
        </div>
        <div class="loginSection"> 
            <div style="   margin-top: 5%; margin-bottom: 20px" >
              <div class="alert alert-error fade in hide" id="loginErr">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <span id="warning"></span>
              </div>
              <form>
                  <input id="username" type="text" id="uname" placeholder="用户名"><br/>
                  <input id="passwd" type="password" id="passwd" placeholder="密码">
              </form>
              <a id="login" class="btn btn-primary" style="min-width=80px;margin-left: 150px">登 陆</a>
              <div id="push"></div>
        </div>
        </div>
    </div >
    <div id="footer">
       <?php include "footer.inc.php"; ?>
    </div>
    <script type="text/javascript" src="js/md5.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript">
        $(document).ready(
            function(){
                $("#jsWarning").hide();
                $(".loginSection").css("display", "block");
            }
        )
    </script>
  </body>
</html>