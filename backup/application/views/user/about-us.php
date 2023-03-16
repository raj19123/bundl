
<main class="main-contents about-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<section class="about-bundl">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('aboutus'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>

			<h2 dir="ltr">@Bundl</h2>
			<div class="desc">
				<p><?= $about['upper_section_'.$language]; ?></p>
				<p class="highlight"><?= $about['middle_section_'.$language]; ?></p>
				<p><?= $about['lower_section_'.$language]; ?></p>
			</div>
		</section>
		<section class="offers">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('aboutus_whatoffer'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
			<div class="inner">
				<div class="row">
					<div class="col-sm-4">
						<div class="image">
							<img src="<?= base_url(); ?>assets_user/images/offers/icon-branding.png" alt="">
						</div>
						<h4><?= $this->lang->line('aboutus_branding'); ?></h4>
						<p><?= $this->lang->line('whatoffer_branding_description'); ?></p>
					</div>
					<div class="col-sm-4">
						<div class="image">
							<img src="<?= base_url(); ?>assets_user/images/branding-icons/Bundl_icons-09.png" alt="">
						</div>
						<h4><?= $this->lang->line('aboutus_graphic'); ?></h4>
						<p><?= $this->lang->line('whatoffer_graphic_description'); ?></p>
					</div>
					<div class="col-sm-4">
						<div class="image">
							<img src="<?= base_url(); ?>assets_user/images/branding-icons/Bundl_icons-08.png" alt="">
						</div>
						<h4><?= $this->lang->line('web_design'); ?></h4>
						<p><?= $this->lang->line('web_design_description'); ?></p>
					</div>
				</div>
			</div>
		</section>
		<section class="how-it-works">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('howit_work'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
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
			<div class="inner">
				<?php if($settings && !empty($settings['video_home_page'])): ?>
					<video controls="" preload="metadata" playsinline="true" >
			        	<source src="<?= base_url('uploads/settings/') . $settings['video_home_page'].'#t=0.5'; ?>" type="video/mp4">
			        </video>
			    <?php endif; ?>
			</div>
		</section>
		<section class="payment-methods">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('aboutus_paymentmethod'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
			<div class="row center">
				<div class="col-sm-6">
					<div class="head">
						<div class="image">
							<img src="<?= base_url(); ?>assets_user/images/visa.png" alt="visa card" style="height: 100px;">
							<img src="<?= base_url(); ?>assets_user/images/mastercard.png" alt="master card" style="height: 56px;">
						</div>
						<!-- <h4><?//= $this->lang->line('aboutus_craditcard'); ?></h4> -->
					</div>
					<!-- <p><?//= $this->lang->line('aboutus_graphic_description'); ?></p> -->
				</div>
				<!-- <div class="col-sm-6">
					<div class="head right">
						<div class="image">
							<img src="<?php //base_url(); ?>assets_user/images/mada.png" alt="">
						</div>
						<h4><?php //$this->lang->line('aboutus_sadadpay'); ?></h4>
					</div>
					<p><?php //$this->lang->line('web_design_description'); ?></p>
				</div> -->
			</div>
			<div class="button-row">
				<a href="<?= base_url(); ?>" class="btn btn-default"><?= $this->lang->line('get_started_btn'); ?></a>
			</div>
		</section>
	</div>
</main>
