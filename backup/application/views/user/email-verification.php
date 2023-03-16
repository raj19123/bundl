<main class="main-contents work-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<section class="contact-us">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('email_varification'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
			<!-- <h4 class="register-message" >You have been registered successfully.<br> A verification email has been sent to <?= isset($email) ? $email : ''; ?> . Please visit your registered email.</h4> -->
			<h4 class="register-message" ><?= $this->lang->line('email_varification_description'); ?></h4>
		</section>
	</div>
</main>