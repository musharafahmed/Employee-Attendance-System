<?php include_once 'inc/functions.php'; ?>
<?php include_once 'inc/code.php'; ?>
<?php if(isset($_SESSION['user_login'])):
  redirect('index.php');
 ?>
  <?php else: ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in | <?=@$getSetting['title']?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" href="img/uploads/<?=@$getSetting['logo']?>">
  <style>
   #body{
      /*background-image: url(img/bg.png);*/
      background-attachment: fixed;
      background-position: top center;
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="hold-transition login-page" id="body">
<div class="login-box">
 <?php $dir = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "" : "") . "$_SERVER[HTTP_HOST]"; 
?>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <div class="login-logo">
      <a href="index.php"><?=@$getSetting['company_name']?></a>
    </div>
    <!-- <center>
      <h1>Login As <label class="text-danger"><?=@ucwords($_REQUEST['role'])?></label></h1>
    </center> -->
    <img src="img/uploads/<?=@$getSetting['logo']?>" width="120" height="120" class="img img-responsive center-block" alt="">
    <p class="login-box-msg lead"></p>
  <?php getMessage(@$msg,@$sts); ?>
    <form action="" method="post">
     
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="user_email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="user_password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
       <button type="submit" class="btn btn-success btn-flat pull-left" name="login_btn"><span class="glyphicon glyphicon-log-in"></span> Sign In</button>
              <!-- <a href="index.php" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-home"></span> Home</a> -->
                <a href="#forget_password" data-toggle="modal" class="btn btn-primary pull-right btn-flat">I forgot my password</a><br>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="btn-group">
             
          </div><!-- group -->
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
  
   <!--  <a href="register.html" class="text-center">Register a new membership</a> -->
  </div>
  <!-- /.login-box-body -->
  <div class="modal fade" id="forget_password">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"></div><!-- header -->
        <div class="modal-body">
          <span class="forgetResponseMsg"></span>
          <form action="inc/ajax_forget_email.php" method="post" id="forget_form">
             <input type="hidden" value="<?=$dir?>" name="server">
            <div class="form-group">
              <label for="">Enter Email address</label>
              <input type="text" class="form-control" placeholder="Enter Email Address" required name="email">
            </div><!-- group -->
            <button id="forget_email_btn" class="btn btn-success btn-flat" type="submit" name="forget_email">Send Link</button>
          </form>
        </div>
        <!-- Body -->
      </div><!-- content -->
    </div><!-- dialog -->
  </div><!-- modal -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
  $("#forget_form").unbind().bind('submit',function(){
    var form = $(this);
    $.ajax({
      url:form.attr('action'),
      type:form.attr('method'),
      data:form.serialize(),
      dataType:"text",
      success:function(response){
        $(".forgetResponseMsg").html(response);
        $("#forget_email_btn").attr('disabled',"disabled");
      }
    });
    return false;
  })
</script>
</body>
</html>
<?php endif; ?>



