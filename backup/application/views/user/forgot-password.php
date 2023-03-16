<main class="main-contents work-page">
	<div class="scrolltop">
        <i class="fas fa-arrow-up"></i>
    </div>
    <div class="container">
		<section class="contact-us">
			<div class="section-title">
				<h1>
					<?= $this->lang->line('login_fordot_pass_link'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>

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

			<p class="contact-form"><strong><?= $this->lang->line('forgot_password_msg'); ?></strong></p>
			<br>
			
			<form method="post" id="forgot" action="<?= base_url('reset-password'); ?>" class="contact-form">
                <div class="form-group with-icon">
                    <input type="text" name="email" id="email" class="form-control validThis" placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>">
                    <span class="icon email"></span>
                    <ul class="valid-error text-purple"></ul>
                </div>
                <div class="button-row">
                    <button type="submit" id="send" class="btn btn-default"><?= $this->lang->line('send_btn'); ?></button>
                </div>
            </form>
		</section>
	</div>
</main>

<script>

	$('#send').on('click', function(event) {
        event.preventDefault();

        var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
        var errorClass = ".valid-error";
        var e;

        e = $('#email');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }
        if( ! isEmail(e.val())){
            e.focus().parent().find(errorClass).html("<?= $this->lang->line('email_is_not_valid'); ?>").addClass('text-purple').show();
            return false;
        }

        $('#forgot').submit();
    });


	
</script>