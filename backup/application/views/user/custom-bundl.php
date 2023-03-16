<main class="main-contents payment-page">
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
		<div class="product-wrapper">
			<div class="left-col">
				<div class="bundl-head">
					<div class="image">
						<img src="<?= base_url(); ?>assets_user/images/bundl-icons/bundls-img5.png" alt="">
					</div>
					<h4><?= $this->lang->line('customize_bunndle'); ?></h4>
				</div>
				<form class="bundl-name">
					<div class="form-group">
						<label><?= $this->lang->line('name_bundle'); ?></label>
						<input type="text" id="custom-bundl" class="form-control" placeholder="name of project" value="<?php if($this->session->userdata('project_name')){ echo $this->session->userdata('project_name'); } ?>">
						<ul class="valid-error text-purple"></ul>
					</div>
				</form>
				<!-- <div class="bundl-desc">
					<h3>BUNDL DETAILS</h3>
					<p>Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
					<ul class="statics">
						<li>
							<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> 5,000 SAR
						</li>
						<li>
							<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> 5 working days
						</li>
					</ul>
				</div> -->

				<div class="bundl-desc">
					<h3><?= $this->lang->line('bundle_detail'); ?></h3>
					<p><?= $this->lang->line('description_custom_bundl'); ?></p>
				</div>

				<!-- Add-on section -->
				<div id="addon-section">
					<?php $this->load->view('user/addon-section', ['language' => $language]); ?>
				</div>

			</div>

			<!-- side bar -->
			<div id="rightSide" class="right-col">
				<?php $this->load->view('user/side-bar', ['language' => $language]); ?>
			</div>

		</div>

	</div>
</main>