<section class="contact-us">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="section-title">
		<h1>
			<!-- CONTACT US -->
			<?= $this->lang->line('header_contectus_lii'); ?>
			<span class="add-icon"></span>
		</h1>
	</div>
	<form class="contact-form">
		<div class="form-group with-icon">
			<input type="text" name="cname" class="form-control" placeholder="<?= $this->lang->line('contactus_name'); ?>">
			<span class="icon name"></span>
			<ul id="cname-error" class="text-purple valid-error"></ul>
		</div>
		<div class="form-group with-icon">
			<input type="tel" 
				name="cphone" 
				id="contact-phone" 
				class="form-control phoneMask" 
				maxlength="11"
				oninput="this.value=this.value.replace(/[^0-9]/g,'');">
			<span class="icon phone"></span>
			<ul id="cphone-error" class="text-purple valid-error"></ul>
		</div>
		<div class="form-group with-icon">
			<input type="text" name="cemail" class="form-control" placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>">
			<span class="icon email"></span>
			<ul id="cemail-error" class="text-purple valid-error"></ul>
		</div>
		<div class="form-group with-icon">
			<!-- <input type="text" name="cmsg" class="form-control" placeholder="<?= $this->lang->line('contactus_message'); ?>"> -->
			<textarea name="cmsg" class="form-control" placeholder="<?= $this->lang->line('contactus_message'); ?>"></textarea>
			<span class="icon message"></span>
			<ul id="cmsg-error" class="text-purple valid-error"></ul>
		</div>
		<div class="button-row">
			<button type="submit" id="contact-us-send" class="btn btn-default"><?= $this->lang->line('send_btn'); ?></button>
			<div class="proceed-text" style="display: none;" id="cMsg">
				<h4><?= $this->lang->line('contactus_received_alert'); ?></h4>
			</div>
			<div class="proceed-text" style="display: none;" id="sendingCU">
				<!-- <h4>SENDING...</h4> -->
				<h4><?= $this->lang->line('contactus_sending'); ?></h4>
			</div>

			<div class="proceed-text" style="display: none;" id="showErrorCU">
				<h4 id="errMsgCU"></h4>
			</div>
		</div>
		<div class="button-row">
			<div class="row contact-icons-row">
				<!-- <div class="col-6" style="text-align: right;"><p>You can send us an email on</p></div> -->
				<div class="col-6" style="text-align: left; font-weight: bold;">
					<img src="assets_user/images/email_images/mailbox-new.png" class="mail-icon">
					<p>info@bundldesigns.com</p>
				</div>
				<!-- <div class="col-6" style="text-align: right;"><p>or whatsapp us on</p></div> -->
				<div class="col-6" style="text-align: left; font-weight: bold;">
					<img src="assets_user/images/email_images/whatsapp-new.png" class="whatsapp-icon">
					<p>+(966) 547754124</p>
				</div>
			</div>
		</div>
	</form>
</section>

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

	$('#contact-us-send').on('click', function(event){
		event.preventDefault();
		$("#showErrorCU").hide();

		var e = $("input[name=cname]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#showErrorCU").show();
            $("#cname-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }

        e = $("input[name=cphone]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#showErrorCU").show();
            //$("#errMsgCU").html('Phone number is required. Please fill the field carefully!');
            $("#cphone-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }else{
        	e.val($("#contact-phone").intlTelInput('getNumber'));
        }

        e = $("input[name=cemail]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#showErrorCU").show();
            //$("#errMsgCU").html('Email is required. Please fill the field carefully!');
            $("#cemail-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }

        if(!isEmail(e.val())){
        	e.focus();
            //$("#showErrorCU").show();
            //$("#errMsgCU").html('Email is not valid. Please fill the field carefully!');
            $("#cemail-error").html("<?= $this->lang->line('email_is_not_valid'); ?>");
            return false;
        }

        e = $("textarea[name=cmsg]");
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            //$("#showErrorCU").show();
            //$("#errMsgCU").html('Your brief message is required. Please fill the field carefully!');
            $("#cmsg-error").html("<?= $this->lang->line('this_value_is_required'); ?>");
            return false;
        }

		var form = $(this).closest('form');
		var data = form.serializeArray();
		console.log(data);
		$(this).hide();
		$('#sendingCU').show();

		$.ajax({
			type: 'post',
			url: '<?= base_url('contact-us-email'); ?>',
			data: data,
			success: function(msg){
				//console.log(msg);
				$('#sendingCU').hide();
				if(msg == 'success'){
					$('#cMsg').show();
				}else{
					$("#showErrorCU").show();
            		$("#errMsgCU").html("<?= $this->lang->line('communication_process_failed_try_again'); ?>");
					setTimeout(window.location.reload(), 90000);
					//window.location.reload();
				}
			}
		});
	});
</script>