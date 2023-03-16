<main class="main-contents work-page">
    <div class="scrolltop">
        <i class="fas fa-arrow-up"></i>
    </div>
	<div class="container">
		<section class="contact-us">
			<div class="section-title">
				<h1>
					<?= $this->lang->line('reset_password_text'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>

			<?php if($this->session->flashdata('error')){ ?>
                <div class="text-danger border-message valid-error">
                    <strong><?= $this->lang->line('error'); ?></strong> <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            
			<form method="post" action="<?= base_url('set-forgot-password'); ?>" class="contact-form	">
                
                <div class="form-group with-icon">
                    <input type="hidden" name="code" value="<?= isset($code) ? $code : ''; ?>">
                    <input type="password" name="password" class="form-control validThis" placeholder="enter password">
                    <span class="icon password"></span>
                    <ul class="valid-error"></ul>
                </div>
                
                <div class="form-group with-icon">
                    <input type="password" name="confirmPassword" class="form-control validThis" placeholder="confirm password">
                    <span class="icon password"></span>
                    <ul class="valid-error"></ul
 >               </div>
                
                <div class="button-row">
                    <button type="submit" class="btn btn-default"><?= $this->lang->line('send_btn'); ?></button>
                </div>

            </form>
		</section>
	</div>
</main>