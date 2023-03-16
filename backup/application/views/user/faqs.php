<main class="main-contents question-page faq-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="section-title">
			<h1>
				<!-- FAQS -->
				<?= $this->lang->line('faqs'); ?>
				<span class="add-icon"></span>
			</h1>
		</div>
		<!-- <h3 class="tab-title">QUESTION CATEGORY</h3> -->
		<h3 class="tab-title"><?= $this->lang->line('faqs_question_category'); ?></h3>
			
			<!-- for-web -->
			<div class="dashboard-tabs">
				<ul class="nav nav-tabs hide-on-mobile" id="myTab" role="tablist">
					<?php
					if($cats):
						foreach ($cats as $key => $cat): $i = $key + 1;
							$file = $this->db->get_where('files', ['id' => $cat['design_icon_id']])->row_array();

							?>
							<li class="nav-item">
							    <a class="nav-link <?= ($i == 1)?'active':''; ?>" 
							    	id="<?= $i; ?>-tab" 
							    	data-toggle="tab" 
							    	href="#<?= $i; ?>" 
							    	role="tab" 
							    	aria-controls="<?= $i; ?>" 
							    	aria-selected="<?= ($i == 1)?'true':'false'; ?>">
							    	
							    	<span class="item">
							    		<img src="<?= './uploads/icons/' . $file['name']; ?>" alt="">
							    		<?= $cat['name_'.$language]; ?>
							    	</span>
							    </a>
							</li>
							<?php
						endforeach;
					endif;
					?>
				</ul>

				<div class="dashboard-tabs dropdown-for-mobile show-on-mobile" style="margin-bottom: 20px;">
					<a href="#" class="toggler">
						<?= $this->lang->line('faqs'); ?>
					</a>
					<div class="hide-show">	
						<ul class="nav nav-tabs faq-menu" id="myTab" role="tablist">
							<?php
							if($cats):
								foreach ($cats as $key => $cat): $i = $key + 1;
									$file = $this->db->get_where('files', ['id' => $cat['design_icon_id']])->row_array();

									?>
									<li class="nav-item">
									    <a class="nav-link <?= ($i == 1)?'active':''; ?>" 
									    	id="<?= $i; ?>-tab" 
									    	data-toggle="tab" 
									    	href="#<?= $i; ?>" 
									    	role="tab" 
									    	aria-controls="<?= $i; ?>" 
									    	aria-selected="<?= ($i == 1)?'true':'false'; ?>">
									    	
									    	<span class="item">
									    		<img src="<?= './uploads/icons/' . $file['name']; ?>" alt="">
									    		<?= $cat['name_'.$language]; ?>
									    	</span>
									    </a>
									</li>
									<?php
								endforeach;
							endif;
							?>
						</ul>
					</div>
				</div>		
				<div class="tab-content" id="myTabContent">

					<?php 
					if($cats):
						//print_r($cats);
						foreach ($cats as $key => $cat): $i = $key + 1;
							$faqs = $this->db->get_where('faqs', ['category_id' => $cat['id']])->result_array();
							$file = $this->db->get_where('files', ['id' => $cat['design_icon_id']])->row_array();
							?>
							<div class="tab-pane fade <?= ($i == 1)?'show active':''; ?>"
								id="<?= $i; ?>"
								role="tabpanel"
								aria-labelledby="<?= $i; ?>-tab">

								<h3 class="bundl-names show-on-mobile">
									<span class="item">
							    		<img src="<?= './uploads/icons/' . $file['name']; ?>" alt="">
							    		<?= $cat['name_'.$language]; ?>										    	
							    	</span>
								</h3>

								<div class="question-form">
									<div class="section-title sm">
										<!-- <h1>ORDERS</h1> -->
										<h1><?= $cat['name_'.$language]; ?></h1>
										<span class="add-icon"></span>
									</div>

									<?php 
									if($faqs):
										foreach ($faqs as $key => $faq):
										 	?>
											<div class="form-group">
												<!-- <label>What is your project name? </label> -->
												<label><?= $faq['question_'.$language]; ?></label>	
												<div class="form-control p-height"><?= $faq['answer_'.$language]; ?></div>
											</div>
											<?php
										endforeach;
									endif;
									?>

								</div>
							</div>
							<?php
						endforeach;
					endif;
					?>
					
				</div>
			</div>


		<div class="recommend-form">
			<!-- <h3>Cant find what your looking for? drop us an email</h3> -->
			<h3><?= $this->lang->line('faqs_order_footer'); ?></h3>
		</div>
		<?php $this->load->view('user/contact-us-section', ['language' => $language]); ?>
	</div>
</main>

<script>
	$(document).ready(function(){
		$(".p-height p").css({"color": "gray"});
	});
</script>