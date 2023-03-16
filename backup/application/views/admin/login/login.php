<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title;?>|Login</title>
    <link rel="icon" href="<?php echo base_url();?>assets_admin/favicon/favicon.ico" type="image/ico" sizes="16x16"> 
    <?php// define("IMAGE_PATH", base_url()); ?>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets_admin/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <!--  <link href="<?php echo IMAGE_PATH;?>assets_admin/css/custom.min.css" rel="stylesheet"> -->
    <link href="<?php echo base_url();?>assets_admin/css/custom.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets_admin/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets_admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>


    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets_admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets_admin/vendors/nprogress/nprogress.js"></script>

    <!-- validator -->
    <script src="<?php echo base_url();?>assets_admin/vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets_admin/js/custom.js"></script>

</head>

<body class="login" style="overflow: hidden;">
    <?php if($this->session->flashdata('login_error')){ ?>
    <div class="alert">
        <div class="alert alert-error alert-dismissible fade in txt-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
            <?php  echo $this->session->flashdata('login_error'); ?>
        </div>
    </div>
    <?php }?>
    <?php if($this->session->flashdata('login_success_message')){ ?>
    <div class="alert">
        <div class="alert alert-success alert-dismissible fade in txt-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <?php  echo $this->session->flashdata('login_success_message');   ?>
        </div>
    </div>
    <?php }?>
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form name="login" id="login" method="post" action="<?= base_url('admin/login'); ?>" novalidate>
                        <h1>Admin Login</h1>
                        <div class="item form-group item-one">
                            <div><input name="username" id="username" type="text" class="form-control" placeholder="Username" required="required" /></div>
                        </div>
                        <div class="item form-group item-one">
                            <input name="password" id="password" type="password" class="form-control" placeholder="Password" required="required" />
                        </div>

                        <button type="submit" class="btn btn-default submit">Log in</button>

                        <div class="separator">

                            <!-- <img width="100%" src="<?php echo IMAGE_PATH;?>upload/logo.png" style="margin-top: 40px; margin-bottom: 20px;"> -->
                            <p><?php echo '©' . date('Y') . ' All Rights Reserved ' . $site_title;?></p>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>