<style>
	.main-steps .box h5 {min-height: 36px; letter-spacing: 2px;}
	@media screen and (max-width: 767px) {
		.main-steps .box h5 {min-height: auto}
	}
</style>

<main class="main-contents payment-page webster-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="steps-banenr">
			<div class="main-steps">
				<div class="row stack-on-600">
					<div class="col-sm-4 col">
						<div class="box step1">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/cube.png" alt="">
							</div>
							<div class="desc">
								<h4>1</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_1_heading');  ?><!-- </a> -->
								</h5>
								<p>
				                    <?= $this->lang->line('step_1_description'); ?>
				                </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step2">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/circle-1.jpg" alt="">
							</div>
							<div class="desc">
								<h4>2</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_2_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                        <?= $this->lang->line('step_2_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step3">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/cone.png" alt="">
							</div>
							<div class="desc">
								<h4>3</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_3_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                        <?= $this->lang->line('step_3_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step4">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/pipe.png" alt="">
							</div>
							<div class="desc">
								<h4>4</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_4_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                        <?= $this->lang->line('step_4_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col">
						<div class="box step5">
							<div class="image">
								<img src="<?= base_url(); ?>assets_user/images/plane.png" alt="">
							</div>
							<div class="desc">
								<h4>5</h4>
								<h5>
									<!-- <a href="#"> --><?= $this->lang->line('step_5_heading'); ?><!-- </a> -->
								</h5>
								<p>
			                       <?= $this->lang->line('step_5_description'); ?>
			                    </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if($this->session->flashdata('success') || $this->session->flashdata('error')){ ?>
			<div class="proceed-text" id="cMsg">
				<h4><?= ($this->session->flashdata('success')) ? $this->session->flashdata('success') : $this->session->flashdata('error'); ?></h4>
			</div>
		<?php } ?>
		<div class="product-wrapper">
			<div class="left-col">
				<div class="head-wrapper">
					<div class="bundl-head">
						<!-- <div class="image">
							<img src="<?= base_url(); ?>assets_user/images/bundl-icons/wd-icon.png" alt="">
						</div> -->
						<h4 style="margin: initial;"><?= (isset($package) && ($package === TRUE)) ? $this->lang->line('premium') : $this->lang->line('the_webster'); ?></h4>
					</div>
				</div>
				<form class="bundl-name" method="post" action="<?= base_url('request-webster') ?>">
					<input type="hidden" id="request_for" name="request_for" value="<?= ($package === TRUE) ? 'premium' : 'webster'; ?>">
					<div class="form-group">
						<label><?= $this->lang->line('name_bundle'); ?></label>
						<input type="text" id="project_name" name="project_name" class="form-control" placeholder="<?= $this->lang->line('placeholder_pro'); ?>">
						<ul  id="project_name-error" class="valid-error text-purple"></ul>
					</div>
					<!-- <div class="form-group">
						<label><?= $this->lang->line('bundl_details'); ?></label>
						<p><textarea class="form-control" name="details" placeholder="<?= $this->lang->line('tell_us_about_your_project'); ?> ....." style="min-height: 120px"></textarea></p>
						<ul id="details-error" class="text-purple valid-error"></ul>
					</div> -->
					<section class="contact-us">
						<div class="contact-form">
							<div class="form-group with-icon">
								<input type="text" name="customer_name" class="form-control" placeholder="<?= $this->lang->line('contactus_name'); ?>">
								<span class="icon name"></span>
								<ul id="customer_name-error" class="text-purple valid-error"></ul>
							</div>
							<div class="form-group with-icon">
								<input type="tel" 
									name="mobile_number" 
									id="contact-phone" 
									class="form-control phoneMask" 
									maxlength="11"
									oninput="this.value=this.value.replace(/[^0-9]/g,'');">
								<span class="icon phone"></span>
								<ul id="mobile_number-error" class="text-purple valid-error"></ul>
							</div>
							<div class="form-group with-icon">
								<input type="text" name="email" class="form-control" placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>">
								<span class="icon email"></span>
								<ul id="email-error" class="text-purple valid-error"></ul>
							</div>
							<div class="form-group with-icon">
								<input type="text" name="message" class="form-control" placeholder="<?= $this->lang->line('contactus_message'); ?>">
								<span class="icon message"></span>
								<ul id="message-error" class="text-purple valid-error"></ul>
							</div>
							<div class="button-row">
								<button type="submit" id="webster-send" class="btn btn-default">
									<?= $this->lang->line('request_a_call_back'); ?>
								</button>
								
								<div class="proceed-text" style="display: none;" id="sendingCU">
									<!-- <h4>SENDING...</h4> -->
									<h4><?= $this->lang->line('contactus_sending'); ?></h4>
								</div>
							</div>
						</div>
					</section>
					</form>

<script type="text/javascript">

	$(document).ready(function(){
	    $("#contact-phone").intlTelInput({
	        allowDropdown: true,
	        autoPlaceholder: "polite",
	        placeholderNumberType: "MOBILE",
	        formatOnDisplay: true,
	        separateDialCode: true,
	        nationalMode: false,
	        autoHideDialCode: true,
	        preferredCountries: [ "sa", "ae" ]
	    });
	    //$("#contact-phone").intlTelInput("setNumber", "+96651234569");
	});

	$('#webster-send').on('click', function(event){
		event.preventDefault();

		var e = $("input[name=project_name]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            $("#project_name-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }

        /*var e = $('textarea[name=details]');;
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            $("#details-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }*/

		var e = $("input[name=customer_name]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            $("#customer_name-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }

        e = $("input[name=mobile_number]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#errMsgCU").html('Phone number is required. Please fill the field carefully!');
            $("#mobile_number-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }else{
        	e.val($("#contact-phone").intlTelInput('getNumber'));
        }

        e = $("input[name=email]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#errMsgCU").html('Email is required. Please fill the field carefully!');
            $("#email-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }

        if(!isEmail(e.val())){
        	e.focus();
            //$("#errMsgCU").html('Email is not valid. Please fill the field carefully!');
            $("#email-error").html("<?= $this->lang->line('email_is_not_valid'); ?>");
            return false;
        }

        e = $("input[name=message]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#errMsgCU").html('Your brief message is required. Please fill the field carefully!');
            $("#message-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }
        


		var form = $(this).closest('form');
		var data = form.serializeArray();
		console.log(data);
		$(this).hide();
		$('#sendingCU').show();
        $(this).closest('form').submit();


		// $.ajax({
		// 	type: 'post',
		// 	url: '<?= base_url('contact-us-email'); ?>',
		// 	data: data,
		// 	success: function(msg){
		// 		//console.log(msg);
		// 		$('#sendingCU').hide();
		// 		if(msg == 'success'){
		// 			$('#cMsg').show();
		// 		}else{
		// 			$("#showErrorCU").show();
  //           		$("#errMsgCU").html('Communication process has been failed. Try again later.');
		// 			setTimeout(window.location.reload(), 90000);
		// 			//window.location.reload();
		// 		}
		// 	}
		// });

	});
</script>
			</div>
		</div>
	</div>
</main>