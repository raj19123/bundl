
<main class="main-contents dashboard-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>	
	<div class="container">

		<!-- add condition for steps banner -->


	<?php if($page == 'files') { ?>
		<div class="steps-banenr">
			<div class="main-steps inner">
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
	<?php } ?>


		<div class="section-title">
			<h1>
				<?= $this->lang->line('dashboard_text'); ?>
				<span class="add-icon"></span>
			</h1>
			<p><?= $this->lang->line('welcomeuser_text'); ?> <?= $this->User->full_name; ?></p>
		</div>

		<div class="dashboard-dropdown">
			<a href="#" class="toggler">
				<?= $this->lang->line('dashboard_manu'); ?>
			</a>
			<div class="dashboard-links">
				<ul>
					<li class="<?= ($page == 'profile') ? 'active' : ''; ?>">
						<a href="<?= base_url('profile'); ?>"><?= $this->lang->line('myprifile_li'); ?></a>
					</li>
					<li class="<?= ($page == 'files') ? 'active' : ''; ?>">
						<a href="<?= base_url('dashboard'); ?>"><?= $this->lang->line('myfiles_li'); ?></a>
					</li>
					<li class="<?= ($page == 'purchases') ? 'active' : ''; ?>">
						<a href="<?= base_url('purchases'); ?>"><?= $this->lang->line('orderhistory_li'); ?></a>
					</li>
					<li class="<?= ($page == 'feedback') ? 'active' : ''; ?>">
						<a href="<?= base_url('feedback'); ?>"><?= $this->lang->line('feedback_li'); ?></a>
					</li>
					<li class="<?= ($page == 'recommend') ? 'active' : ''; ?>">
						<a href="<?= base_url('recommend'); ?>"><?= $this->lang->line('recomended_li'); ?></a>
					</li>
					<li>
						<a href="<?= base_url('logout'); ?>"><?= $this->lang->line('logout_li'); ?></a>
					</li>
				</ul>
			</div>
		</div>