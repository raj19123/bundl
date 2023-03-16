<?php $user = isset($this->session->userdata('site_user')->id) ? $this->session->userdata('site_user')->id : ''; ?>

<!DOCTYPE html>
<html dir="<?= ($ln == 'ar') ? 'rtl' : 'ltr'; ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BundlDesigns</title>

	<link rel="icon" href="<?php echo base_url();?>assets_admin/favicon/favicon.ico" type="image/ico" sizes="16x16">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<!-- <link href="<?php //base_url(); ?>assets_user/css/bootstrap4.min.css" rel="stylesheet">	 -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.21/r-2.2.5/datatables.min.css"/>

	<link href="<?= base_url(); ?>assets_user/css/jquery-ui.css" rel="stylesheet">		
	<link href="<?= base_url(); ?>assets_user/css/slick.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/css/select2.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/css/bootstrap-select.min.css" rel="stylesheet">
	<!-- <link href="<?php //base_url(); ?>assets_user/css/wcolpick.css" rel="stylesheet"> -->
	<!-- <link href="<?php //base_url(); ?>assets_user/DataTables/datatables.min.css" rel="stylesheet"> -->
	<link href="<?= base_url(); ?>assets_user/css/dropzone.css" rel="stylesheet">
	<!-- <link href="<?= base_url(); ?>assets_admin/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet"> -->
	<link href="<?= base_url(); ?>assets_user/css/jquery.colorpicker.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/css/styles.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets_user/PhoneMask/css/intlTelInput.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets_admin/sweetalert/dist/sweetalert.css" rel="stylesheet">
	
	<!-- <link href="<?php //base_url(); ?>assets_user/DataTables/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet"> -->
	<!-- <link href="<?php //base_url(); ?>assets_user/DataTables/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet"> -->
 
	<script src="<?= base_url(); ?>assets_user/js/jquery-3.3.1.js"></script>
	<script src="<?= base_url(); ?>assets_user/js/jquery-ui.js"></script>
	<script src="<?= base_url(); ?>assets_user/js/popper.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.21/r-2.2.5/datatables.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
	
	<!-- <script src="<?php //base_url(); ?>assets_user/js/bootstrap4.min.js"></script> -->
	<script src="<?= base_url(); ?>assets_user/js/slick.js"></script>
	<script src="<?= base_url(); ?>assets_user/js/select2.js"></script>
	<script src="<?= base_url(); ?>assets_user/js/jquery.bootstrap-touchspin.js"></script>
	<script src="<?= base_url(); ?>assets_user/js/bootstrap-select.min.js"></script>
	<!-- <script src="<?php //base_url(); ?>assets_user/js/wcolpick.js"></script> -->
	
	
	<!-- <script src="<?php //base_url(); ?>assets_user/DataTables/datatables.min.js"></script> -->
	<!-- <script src="<?php //base_url(); ?>assets_user/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script> -->
	<!-- <script src="<?php //base_url(); ?>assets_user/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script> -->

	<script src="<?= base_url(); ?>assets_user/js/dropzone.js"></script>
	<!-- <script src="<?= base_url(); ?>assets_admin/vendors/dropzone/dist/dropzone.js"></script> -->
	<script src="<?= base_url(); ?>assets_user/js/jquery.colorpicker.js"></script>
	
	<!-- Phone Mask -->
	<script src="<?= base_url(); ?>assets_user/PhoneMask/js/intlTelInput-jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets_user/PhoneMask/js/utils.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets_admin/sweetalert/dist/sweetalert.min.js"></script>

	<script src="<?= base_url(); ?>assets_user/js/custom.js"></script>
	<script src="<?= base_url(); ?>assets_admin/js/zee.js"></script>
	
</head>
<body class="<?= ($ln == 'ar') ? 'rtl' : 'ltr'; ?>">

	<div class="top-bar">
	<?php
	$today = date('Y-m-d');
	$promo = $this->db->order_by('created_at', 'DESC')->get_where('coupons', ['status' => 1 , 'show_on_web' => "yes" , 'expiry >=' => $today, 'id !=' => 8])->row_array();
	if($promo){
		?>
			<?php $banner_text = $promo['banner_text_'.$language];
		    $banner_text = str_replace('{code}', '<span>'.$promo['code'].'</span>', $banner_text); 
		    $banner_text = str_replace('{percent}', '<span>'.$promo['discount'].'%</span>', $banner_text); 
		    echo $banner_text;
		    ?>
		<?php
	}
	?>
	</div>

	<header class="main-header">
	    <div class="container-fluid"> 
	        <div class="row align-items-center">
	            <div class="col-sm-3 col-4">
	                <div class="logo-holder">
	                    <a href="<?= base_url(); ?>">
	                        <img src="<?= base_url(); ?>assets_user/images/logo.jpg" alt="">
	                    </a>
	                </div>
	            </div>
	            <div class="col-sm-9 col-8">
	                <div class="nav-wrap">
	                    <ul class="h-list">
	                        <li id="srchForm">
	                            <a href="javascript:void(0);" class="search-icon"></a>
	                            <form action="<?= base_url('search'); ?>" class="search-form" >
	                                <span class="input-addon"></span>
	                                <input type="text" id="search" name="query" class="form-control" placeholder="search">
	                            </form>
	                        </li>
	                        <li class="account-dropdown">
	                            <!-- <a id="profile" href="javascript:void(0);" class="user-icon" data-toggle="modal" data-target="#login-modal"></a> -->
	                            <a  href="#" class="user-icon"></a>
	                            <ul class="navigation">
	                            	<li>
	                            		<a href="#" id="profile"><?= ($user != '') ? $this->lang->line('header_my_files') : $this->lang->line('header_login'); ?></a>
	                            	</li>
	                            	<?php if($user != ''): ?>
		                            	<!-- <li>
		                            		<a href="<?php //base_url('profile'); ?>">profile</a>
		                            	</li>
		                            	<li>
		                            		<a href="<?php //base_url('purchases'); ?>">order history</a>
		                            	</li>
		                            	<li>
		                            		<a href="<?php //base_url('logout'); ?>">logout</a>
		                            	</li> -->
		                            	<li>
		                            		<a href="<?= base_url('profile'); ?>"><?= $this->lang->line('header_prifile_li'); ?></a>
		                            	</li>
		                            	<li>
		                            		<a href="<?= base_url('purchases'); ?>"><?= $this->lang->line('header_orderhistory_li'); ?></a>
		                            	</li>
		                            	<li>
		                            		<a href="<?= base_url('logout'); ?>"><?= $this->lang->line('header_logout_li'); ?></a>
		                            	</li>
		                            <?php endif; ?>
	                            </ul>
	                        </li>
	                        <li>
                            	<a href="<?= base_url('cart'); ?>" class="cart-icon">
                            	<?php if($this->cart->contents()): ?>
                                	<span class="counter" id="cart-count"><?= count($this->cart->contents()); ?></span>
                            	<?php endif; ?>
                            	</a>
	                        </li>
	                        <li class="lang-links">
	                        	<?php 
	                        	$arabic_link = '<a href="'.base_url('language/arabic/?url=').base_url($_SERVER['REQUEST_URI']).'" class="arabic">ع  </a>';
	                        	$english_link = '<a href="'.base_url('language/english/?url=').base_url($_SERVER['REQUEST_URI']).'" class="enlish"> En </a>';

	                        	if($this->session->userdata('site_lang')){
	                        		$language = $this->session->userdata('site_lang');
	                        		if($language == 'arabic'){
		                        		echo $english_link;
	                        		}else{
	                        			echo $arabic_link;
	                        		}
	                        	}else{
	                        		echo $arabic_link;
	                        	}
	                        	?>
	                        </li>
	                        <li class="menu">
	                            <button type="button" class="navbar-toggle" id="menu-toggle">
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                            </button>   
	                        </li>
	                    </ul>
	                    <nav class="navigation">
	                        <ul class="navbar">
	                            <li>
	                                <!-- <a href="<?php //base_url(); ?>">Bundls</a> -->
	                                <a href="<?= base_url(); ?>"><?= $this->lang->line('header_bundl_li'); ?></a>
	                            </li>
	                            <li>
	                                <!-- <a href="<?php //base_url('our-work'); ?>">Our Work</a> -->
	                                <a href="<?= base_url('our-work'); ?>"><?= $this->lang->line('header_ourwork_li'); ?></a>
	                            </li>
	                            <li>
	                                <a href="<?= base_url('about'); ?>"><?= $this->lang->line('header_aboutus_lii'); ?></a>
	                                
	                            </li>
	                            <li>
	                                <!-- <a href="<?php //base_url('contact-us'); ?>">Contact Us</a> -->
	                                <a href="<?= base_url('contact-us'); ?>"><?= $this->lang->line('header_contectus_lii'); ?></a>
	                                
	                            </li>

	                        </ul>
	                    </nav>       
	                </div>
	            </div>
	        </div>
	    </div>
	</header>

<script type="text/javascript">
	$(document).ready(function() {
		$('#profile').on('click', function(event) {
			event.preventDefault();
			var user_id = "<?= isset($this->session->userdata('site_user')->id) ? $this->session->userdata('site_user')->id : ''; ?>";
			if( ! user_id){
				window.location.href = "<?= base_url('?register=email'); ?>";
				//$('#login-modal').modal('show');
			}else{
				window.location.href = "<?= base_url('dashboard'); ?>";
			}
		});

		var register = "<?= isset($_GET['register']) ? $_GET['register'] : ''; ?>";
		var user_id = "<?= isset($this->session->userdata('site_user')->id) ? $this->session->userdata('site_user')->id : ''; ?>";
		if(! user_id){	
			if(register){
				$('#login-modal').modal('show');
				if(register == 'email'){
					$('#register-email').focus();
				}
				if(register == 'popup'){
					$('.show-register').click();
				}
			}
		}
	});
</script>

<script type="text/javascript">
	// search functionality
	$('#search').on('keypress', function(event){
		var search = $(this);
		var form = search.closest('form');
		if(event.which == 13) {
	        form.submit();
	    }
	});
</script>