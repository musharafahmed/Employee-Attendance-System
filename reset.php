<?php include_once 'inc/functions.php'; ?>
<?php include_once 'inc/code.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Password | <?=@$getSetting['title']?></title>
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
</head>
<body class="hold-transition login-page" id="body">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
     <div class="login-logo">
         <img src="img/uploads/<?=@$getSetting['logo']?>" width="120" height="120" class="img img-responsive center-block" alt="">
      <a href="index.php"><b><?=@$getSetting['company_name']?></b></a>
     
    </div>
    <center> <p class="text-muted text-center">Reset Your Password</p></center>
  <?php if(!empty($msg)){getMessage(@$msg,@$sts);} ?>
    <form action="" method="post">
             <input type="hidden" value="<?=$dir?>" name="server">
            <div class="form-group">
              <label for="">New Password</label>
              <input type="password" class="form-control" placeholder="*********" required name="new_password">
            </div><!-- group -->
            <div class="form-group">
              <label for="">Confirm Password</label>
              <input type="password" class="form-control" placeholder="*********" required name="confirm_password">
            </div><!-- group -->
            <button class="btn btn-success btn-flat" type="submit" name="reset_password">Reset Password</button>
          </form>
    <!-- /.social-auth-links -->
  
   <!--  <a href="register.html" class="text-center">Register a new membership</a> -->
  </div>
  <!-- /.login-box-body -->
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
</script>
</body>
</html>

