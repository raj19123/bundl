<main class="main-contents work-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<section class="contact-us">
			<div class="section-title">
				<h1>
					<!-- RESET PASSWORD -->
					<?= $this->lang->line('reset_password_text'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>

			<?php if($this->session->flashdata('error')){ ?>
                <div class="text-danger border-message valid-error">
                    <strong><?= $this->lang->line('error'); ?>!</strong> <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>

			<?php if($this->session->flashdata('success')){ ?>
                <div class="text-success border-message valid-error">
                    <strong><?= $this->lang->line('success'); ?></strong> <?= $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
			
			<form method="post" action="<?= base_url('reset-password'); ?>" class="contact-form	">
                
                <input type="hidden" name="email" value="<?= isset($user['email']) ? $user['email'] : ''; ?>">
                
                <div class="button-row">
                    <button type="submit" class="btn btn-default"><?= $this->lang->line('resend_btn'); ?></button>
                </div>
            </form>
		</section>
	</div>
</main>