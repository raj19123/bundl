<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title;?></title>
    <link rel="icon" href="<?php echo base_url();?>assets_admin/favicon/favicon.ico" type="image/ico" sizes="16x16"> 
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- date range picker -->
    <link href="<?php echo base_url();?>assets_admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- date time picker -->
    <link href="<?php echo base_url();?>assets_admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets_admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>assets_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="<?php echo base_url();?>assets_admin/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- progress bar -->
    <link href="<?php echo base_url();?>assets_admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url();?>assets_admin/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets_admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Image Picker -->
    <link href="<?php echo base_url();?>assets_admin/image-picker/image-picker.css" rel="stylesheet">


<!--	<link rel="stylesheet" type="text/css" href="<?php // echo IMAGE_PATH; ?>assets_admin/vendors/bootstrap-daterangepicker/daterangepicker.css"/>-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_admin/vendors/select2/dist/css/select2.css"/>
    <!-- Custom Theme Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_admin/css/custom.css" />
    <link href="<?php echo base_url();?>assets_admin/sweetalert/dist/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_admin/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets_admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets_admin/vendors/jquery/dist/jquery3.js"></script> -->
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets_admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
     <!-- FastClick -->
    <script src="<?php echo base_url();?>assets_admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets_admin/vendors/nprogress/nprogress.js"></script>
    <script src="<?php echo base_url();?>assets_admin/editor/nicEdit.js"></script>
    <script src="<?php echo base_url();?>assets_admin/tinymce_4.7.3/tinymce.min.js"></script>
    
    
    <!-- iCheck --> 
    <script src="<?php echo base_url();?>assets_admin/vendors/iCheck/icheck.min.js"></script>
    <!-- NProgress -->
    

	
    <script src="<?php echo base_url();?>assets_admin/vendors/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_admin/vendors/select2/dist/js/select2.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets_admin/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script type="text/javascript" src="<?php //echo base_url();?>assets_admin/js/deletesweetalert.js"></script> -->
    
    <!-- Dropzone.js -->
    <script src="<?php echo base_url();?>assets_admin/vendors/dropzone/dist/dropzone.js"></script>
	<script src="<?php echo base_url();?>assets_admin/vendors/moment/min/moment.min.js"></script>

    
    <script src="<?php echo base_url();?>assets_admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<!-- DateTimePicker.js -->
    <script src="<?php echo base_url();?>assets_admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- validator -->
    <script src="<?php echo base_url();?>assets_admin/vendors/validator/validator.js"></script>
    <script src="<?php echo base_url();?>assets_admin/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- knob -->
    <script src="<?php echo base_url();?>assets_admin/vendors/jquery-knob/js/jquery.knob.js"></script>
    <!-- Switchery -->
    <script src="<?php echo base_url();?>assets_admin/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Image Picker -->
    <script src="<?php echo base_url();?>assets_admin/image-picker/image-picker.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/js/masonry.js"></script>
    
    <!-- sweet alerts css loadded in header -->
 
  </head>
  <style type="text/css">
    .profile_info{
        padding: 10px;
    }

    .img-circle.profile {
    }
	/*.mce-branding{
		display: none;
	}*/
 
	@media print {
		.printmeBTNFunction  {
			display: none;
		}
		.nav-md .container.body .right_col {
			margin-left: 2px !important;
		}
	}
  </style>
  

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col printmeBTNFunction">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a class="site_title">
                    <!-- <img width="100%" src="<?php echo base_url();?>assets_admin/images/user.png">  -->
                    <span>Bundl Administration</span>
                </a>
            </div>

            <!-- <div class="profile_pic" style="width: 100% !important; float: none !important; ">
                <?php 
                if(isset($this->loginUser->profile_picture)){?> 
                      <center><img src="<?php echo base_url();?>upload/profile_images/<?php echo $this->loginUser->profile_picture;?>" class="img-circle profile"></center>   
                <?php }else{ ?>
                    <center><img class="img-circle profile" src="<?php echo base_url().'assets_admin/images/user.png';?>"></center>                    
                <?php }?>                
            </div> -->
            <div class="clearfix"></div>
            <br />
			<?php $this->load->view('admin/template_sidebar');?>
          </div>
        </div>

        <?php $this->load->view('admin/template_topnavigation');?>
        
        <div class="right_col" role="main" style="min-height: 1716px; clear: both;">
            <?php echo $main_content;?>
        </div>
          
		<?php $this->load->view('admin/template_footer');?>

      </div><!-- end .main_container -->
    </div><!-- end .container .body -->

    <script src="<?php echo base_url();?>assets_admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url();?>assets_admin/js/custom.js"></script>
    <script src="<?php echo base_url();?>assets_admin/js/zee.js"></script>

  </body>
</html>