<?php include_once 'inc/functions.php'; ?>

<?php if(!isset($_SESSION['user_login'])):
  redirect('login.php');
 ?>
  <?php else: ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=TITLE?></title>
  <?php include_once 'inc/links.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include_once 'inc/header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once 'inc/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--
    <section class="content-header">
      <h1>
        Today
        <small> <?=date('D, d-M-Y')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
 -->
    <!-- Main content -->

    <section class="content" id="content">
     <?php if(!empty($_REQUEST['nav'])): ?>
    <div class="hidden-print">
         <a  style="position: absolute;z-index: 1000;right: 20px;" href="index.php?nav=<?=@$_REQUEST['nav']?>" class="btn btn-danger btn-sm"><span class="fa fa-refresh"></span> Refresh</a>
    </div>
     <?php endif; ?>
      <span class="responseMessage fixedNotify"></span>
     <span  class="fixedNotify"> <?php if(!empty(@$msg)){getMessage(@$msg,@$sts);} ?></span>
      <?php include_once $page; ?>
      <?php if(@$_REQUEST['nav']==base64_encode("developer_mode")): ?>
     <div class="row">
       <div class="col-sm-6">
        <h3>Permissions</h3>
          <pre> <?php print_r($permissions); ?> </pre>
       </div><!-- col -->
       <div class="col-ms-6">
         <h3>Current Roles</h3>
         <pre> <?php print_r($user_permission); ?> </pre>
           <h3>Access to Files</h3>
           <pre><?php print_r($files) ?> </pre>
       </div><!-- col -->
     </div><!-- row -->
   <?php endif; ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'inc/footer.php'; ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


</body>
</html>
<?php endif; ?>

