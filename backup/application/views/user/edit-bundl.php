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
				<form class="bundl-name">
					<div class="section-title sm">
						<h1>
							<?= $this->lang->line('edit_bundl'); ?>
							<span class="add-icon"></span>
						</h1>
					</div>
					<div class="form-group">
						<select id="slc-bundl" class="selectpicker" title="<?= $this->lang->line('choose_your_bundl'); ?>">
							<?php
							if($orders){
								foreach ($orders as $key => $order) {
									?>
									<option value="<?= $order['id']; ?>" <?= ($this->uri->segment(2) == $order['id']) ? 'selected' : ''; ?> ><?= $order['project_name']; ?></option>
									<?php
								}
							}
							?>
						</select>
						<ul class="valid-error text-purple"></ul>
					</div>
				</form>
				<!-- REMOVE BUNDL DETAIL -->
				<!-- <div class="bundl-desc">
					<h3><?= $this->lang->line('edit_detail'); ?></h3>
					<p id="pd"><?= $this->lang->line('bundl_detail'); ?></p>
				</div> -->

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

<script type="text/javascript">
	$('#slc-bundl').on('change', function(event){
		event.preventDefault();
		var order_id = $(this).val();
		
		$.ajax({
			type: 'post',
			url: '<?= base_url('get-order-detail'); ?>',
			data: {'order_id':order_id},
			success: function(msg){
				//console.log(msg);
				$('#pd').html(msg);
			}
		});
	});
</script>
				
		<!-- <div class="section-title sm sm-width margin-left-0">
			<h1>
				YOU MIGHT ALSO LIKE
				<span class="add-icon"></span>
			</h1>
		</div>
		<div class="bundl-slider">
			<div class="bunbl-box">
				<div class="head">
					<div class="icon">
						<img src="src/images/bundl-icons/bundls-img1.png" alt="">
					</div>
					<h4>THE NEWBIE</h4>
					<p>< basic branding ></p>
				</div>
				<div class="body">
					<ul class="list">
						<li>Concept & Direction</li>
						<li>Logo Design</li>
						<li>Visual Identity: <span>(Color scheme + Typography + Visual elements)</span></li>
						<li>Business Card</li>
						<li>Letterhead</li>
						<li>Envelope</li>
					</ul>
					<h6 class="price">3,000 SAR</h6>
				</div>
				<div class="button-row">
					<a href="#" class="btn btn-default select-btn">SELECT</a>
				</div>
			</div>
			<div class="bunbl-box">
				<div class="head">
					<div class="icon">
						<img src="src/images/bundl-icons/bundls-img2.png" alt="">
					</div>
					<h4>THE SOCIALITE</h4>
					<p>< branding + social media ></p>
				</div>
				<div class="body">
					<ul class="list">
						<li>Concept & Direction</li>
						<li>Logo Design</li>
						<li>Visual Identity: <span>(Color scheme + Typography + Visual elements)</span></li>
						<li>Business Card</li>
						<li>Letterhead</li>
						<li>Envelope</li>
						<li>Facebook Cover</li>
						<li>Twitter header</li>
						<li>Instagram Template</li>
						<li>5 Social media posts</li>
					</ul>
					<h6 class="price">5,000 SAR</h6>
				</div>
				<div class="button-row">
					<a href="#" class="btn btn-default select-btn">SELECT</a>
				</div>
			</div>
			<div class="bunbl-box">
				<div class="head">
					<div class="icon">
						<img src="src/images/bundl-icons/the_professional.jpg" alt="">
					</div>
					<h4>THE PROFFESIONAL</h4>
					<p>< branding + website ></p>
				</div>
				<div class="body">
					<ul class="list">
						<li>Concept & Direction</li>
						<li>Logo Design</li>
						<li>Visual Identity: <span>(Color scheme + Typography + Visual elements)</span></li>
						<li>Business Card</li>
						<li>Letterhead</li>
						<li>Envelope</li>
						<li>Facebook Cover</li>
						<li>Twitter header</li>
						<li>Instagram Template</li>
						<li>5 Social media posts</li>
						<li>Web Banner Design </li>
						<li>Website Design:<span>(Slider + Menu + Contact form + 1-5 service pages design + Social media links)</span></li>
					</ul>
					<h6 class="price">10,000 SAR</h6>
				</div>
				<div class="button-row">
					<a href="#" class="btn btn-default select-btn">SELECT</a>
				</div>
			</div>
			<div class="bunbl-box">
				<div class="head">
					<div class="icon">
						<img src="src/images/bundl-icons/big_shot.jpg" alt="">
					</div>
					<h4>THE BIG SHOT</h4>
					<p>< branding + E-commerce ></p>
				</div>
				<div class="body">
					<ul class="list">
						<li>Concept & Direction</li>
						<li>Logo Design</li>
						<li>Visual Identity: <span>(Color scheme + Typography + Visual elements)</span></li>
						<li>Business Card</li>
						<li>Letterhead</li>
						<li>Envelope</li>
						<li>Facebook Cover</li>
						<li>Twitter header</li>
						<li>Instagram Template</li>
						<li>5 Social media posts</li>
						<li>Web Banner Design </li>
						<li>E-Commerce Website Design:<span>(Slider + Menu + Contact form + Products Pages + Cart + Payment Gateway + Social media links + Reports)</span></li>
					</ul>
					<h6 class="price">15,000 SAR</h6>
				</div>
				<div class="button-row">
					<a href="#" class="btn btn-default select-btn">SELECT</a>
				</div>
			</div>
			<div class="bunbl-box">
				<div class="head">
					<div class="icon">
						<img src="src/images/bundl-icons/icon-wd-lg.png" alt="">
					</div>
					<h4>THE WEBSTER</h4>
					<p>< customise your website ></p>
				</div>
				<div class="body">
					<p>Lorem ipsum dorem ipset<br> peret delet Lorem ipsum<br> dorem ipset peret delet Lorem ipsum dorem ipset peret delet Lorem ipsum dorem ipset peret delet Lorem ipsum dorem ipset peret delet Lore</p>
				</div>
				<div class="button-row">
					<a href="#" class="btn btn-default select-btn">SELECT</a>
				</div>
			</div>
			<div class="bunbl-box">
				<div class="head">
					<div class="icon">
						<img src="src/images/bundl-icons/the_professional.jpg" alt="">
					</div>
					<h4>THE PROFFESIONAL</h4>
					<p>< branding + website ></p>
				</div>
				<div class="body">
					<ul class="list">
						<li>Concept & Direction</li>
						<li>Logo Design</li>
						<li>Visual Identity: <span>(Color scheme + Typography + Visual elements)</span></li>
						<li>Business Card</li>
						<li>Letterhead</li>
						<li>Envelope</li>
						<li>Facebook Cover</li>
						<li>Twitter header</li>
						<li>Instagram Template</li>
						<li>5 Social media posts</li>
						<li>Web Banner Design </li>
						<li>Website Design:<span>(Slider + Menu + Contact form + 1-5 service pages design + Social media links)</span></li>
					</ul>
					<h6 class="price">10,000 SAR</h6>
				</div>
				<div class="button-row">
					<a href="#" class="btn btn-default select-btn">SELECT</a>
				</div>
			</div>
		</div> -->
	</div>
</main>