<div class="col-sm-12">
	<div class="proceed-text">
		<?php if($this->session->flashdata('error')){ ?>
            <div class="text-danger border-message valid-error">
                <strong><?= $this->lang->line('error'); ?></strong> <?= $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

		<?php if($this->session->flashdata('success')){ ?>
            <div class="text-success border-message valid-error">
                <strong><?= $this->lang->line('success'); ?></strong> <?= $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

		<!-- <h4>THANK YOU! YOU WILL GET AN EMAIL WITH THE DETAILS SHORTLY</h4> -->
	</div>
</div>

<form action="<?= base_url('recommend-response'); ?>" method="post" class="recommend-form">
	<h3><?= $this->lang->line('recommend'); ?></h3>
	<div class="row col-gap-100">
		<div class="col-sm-12">
			<div class="form-group with-icon">
				<input type="text" name="friend_name" class="form-control validThis" placeholder="<?= $this->lang->line('friend_name'); ?>*">
				<span class="icon name"></span>
				<span class="valid-error text-purple"></span>
			</div>
		</div>
		<!-- <div class="col-sm-12">
			<div class="form-group with-icon">
        <input type="tel" 
            name="phone"
            id="user-phone" 
            class="form-control phoneMask" 
            maxlength="11"
            oninput="this.value=this.value.replace(/[^0-9]/g,'');">
        <span class="icon phone"></span>
        <span class="valid-error text-purple"></span>
    </div>
		</div> -->
		<div class="col-sm-12">
			<div class="form-group with-icon">
				<input type="text" name="friend_email" class="form-control validThis" placeholder="<?= $this->lang->line('friend_email'); ?>* ">
				<span class="icon email"></span>
				<span class="valid-error text-purple"></span>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group with-icon">
				<!-- <input type="text" name="message" class="form-control validThis" placeholder="<?= $this->lang->line('message'); ?>"> -->
                <textarea name="message" class="form-control validThis" placeholder="<?= $this->lang->line('message'); ?>"></textarea>
				<span class="icon message"></span>
				<span class="valid-error text-purple"></span>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="button-row">
				<button type="submit" id="recommend-btn" class="btn btn-default"><?= $this->lang->line('send'); ?></button>
			</div>
		</div>
	</div>
</form>

<script>
    $(document).ready(function(){
        $("#user-phone").intlTelInput({
            allowDropdown: true,
            autoPlaceholder: "polite",
            placeholderNumberType: "MOBILE",
            formatOnDisplay: true,
            separateDialCode: true,
            nationalMode: false,
            autoHideDialCode: true,
            hiddenInput: "friend_phone",
            preferredCountries: [ "sa", "ae" ]
        });
       //$("#user-phone").intlTelInput("setNumber", "<?= isset($user['phone']) ? $user['phone'] : ''; ?>");
    });

    $("#recommend-btn").on("click", function(event){
    	event.preventDefault();

    	var e = $("input[name=friend_email]");
        if( ! isEmail(e.val())){
            e.focus().siblings('.valid-error').html("<?= $this->lang->line('email_is_not_valid'); ?>").addClass('text-purple').show();
            return false;
        }
        $(this).attr("disabled" , "disabled");
        $(this).closest('form').submit();

    });
</script>