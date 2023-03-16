<?php
if($this->session->flashdata('order_id')){
	$order_id = $this->session->flashdata('order_id');
}elseif(isset($_GET['oid'])){
	$order_id = $_GET['oid'];
}elseif($this->cart->contents()){
	foreach ($this->cart->contents() as $key_cart => $value) {
		if(isset($value['options']['order_id']) && !empty($value['options']['order_id'])){
			$order_id = $value['options']['order_id'];
		}
	}
}else{
	redirect(base_url());
}

//check package is custom or not
$is_custom = true;
$pkg = $this->db->get_where('order_items', ['order_id' => $order_id, 'item_type' => 'package']);
if($pkg->num_rows() > 0){
	$is_custom = false;
}


$designs = $this->db->get_where('order_items', ['order_id' => $order_id, 'item_type !=' => 'package', 'status' => 0]);
if($designs->num_rows() > 0){
	$designs = $designs->result_array();
}else{
	$designs = [];
}
$branding_all_cats = $this->db->get_where("designs" , array("category_id" => 1))->result_array();
if($branding_all_cats){
	$branding_all_cats_ids = array_column($branding_all_cats, "id");
	$this->db->where_in("item_id" , $branding_all_cats_ids);
	$this->db->where('item_type' , 'addon');
	$this->db->where("order_id" , $order_id);
	$branding_guide_items = $this->db->get("order_items")->result_array();
	if($branding_guide_items){
		if(count($branding_guide_items) == 1){
			// if($branding_guide_items[0]['item_id'] == 3){
			// 	$show_logo = FALSE;
			// }else{
				$show_logo = TRUE;
			// }
		}else{
			$show_logo = TRUE;	
		}
	}else{
		$show_logo = TRUE;	
	}

}else{
	$show_logo = TRUE;
}
$order = $this->db->get_where('orders', ['id' => $order_id])->row_array();

//update order table for dashboard project sorting by last update
$this->db->update('orders', ['updated_on' => date('Y-m-d H:i:s')], ['id' => $order_id]);


//check branding questionnaire is already submitted or not
$check_answers = $this->db->get_where('answers_brand', ['order_id' => $order_id]);
if($check_answers->num_rows() > 0){
	$q_brand = true;
}else{
	$q_brand = false;
}
?>
<main class="main-contents payment-page questionnaire">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="steps-banenr">
			<div class="main-steps show">
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

		<?php if($this->session->flashdata('error')){ ?>
            <div class="text-danger border-message valid-error">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

		<?php if($this->session->flashdata('success')){ ?>
            <div class="text-success border-message valid-error">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

		
		<div class="section-title">
			<h1>
				<?php
				if($q_brand){
					echo $this->lang->line('questionnaire_text');
				}else{
					echo $this->lang->line('fill_questionnaire_text');
				}
				?>
				<span class="add-icon"></span>
			</h1>
			<!-- <p>Let's start by helping us understand your preferences</p> -->
			<p><?= $this->lang->line('questionnaire_lets_start'); ?></p>
		</div>
		<div class="inner-container">
			<div class="left-col">
				<div class="section-title sm border-0">
					<h1><?= $this->lang->line('project'); ?>: <?= $order['project_name']; ?></h1>
				</div>
				<?php if($q_brand == false): ?>
					<div class="section-title sm border-0 link-right" id="branding">
						<h1>
							<?= $this->lang->line('branding'); ?>
							<span class="add-icon"></span>
						</h1>
					</div>
					<form action="<?= base_url('branding-questions'); ?>" method="post" enctype="multipart/form-data" id="questionForm" class="question-form form-count">
						<input type="hidden" name="order_id" value="<?= $order_id; ?>">
						<h3 id="your-business" class="link-right" ><?= $this->lang->line('questionnaire_about_branding'); ?></h3>
						<!-- <div class="form-group">
							<label><?= $this->lang->line('questionnaire_projectname'); ?> <span>*</span></label>
							<input type="text" name="1" class="form-control validThis">
							<ul class="valid-error text-purple"></ul>
						</div> -->
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_industry'); ?> <span>*</span></label>
							<input type="text" name="2" class="form-control validThis">
							<ul class="valid-error text-purple text-purple"></ul>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $this->lang->line('questionnaire_business_location'); ?> <span>*</span></label>
									<div class="select-wrapper">
										<select name="country" class="validThis location-selector" id="countryId" >
											<option selected="selected" value="Saudi Arabia" data-countrycode="166">Saudi Arabia</option>
											<option value="United Arab Emirates" data-countrycode="199">United Arab Emirates</option>
											<?php 
											if($countries): 
												foreach ($countries as $key => $country):
													if( ($country['id'] != 166) && ($country['id'] != 199) ):
														?>
										    			<option value="<?= $country['name']; ?>" data-countrycode="<?= $country['id']; ?>"><?= $country['name']; ?></option>
														<?php
													endif; 
												endforeach;
											endif; 
											?>
										</select>
										<ul class="valid-error text-purple text-purple"></ul>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label><?= $this->lang->line('questionnaire_business_city'); ?></label>
									<div class="select-wrapper">
										<select name="city" class="validThis location-selector" id="cityId">
										    <?php
										    if($saudi_cities):
										    	foreach ($saudi_cities as $key => $city):
										    		?>
										    		<option value="<?= $city['name']; ?>"><?= $city['name']; ?></option>
										    		<?php
										    	endforeach;
										    endif;
										    ?>
										</select>
										<ul class="valid-error text-purple text-purple"></ul>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<?php
							if($designs): $i=0;
								foreach ($designs as $key => $design):
									if($design['item_type'] == 'logo'):
									?>
										<label><?= $this->lang->line('questionnaire_what_branding'); ?> <span>*</span></label>
									<?php else:  $i++; if($i > 1) {continue;}
										?>
										<label><?= $this->lang->line('questionnaire_what_branding_2'); ?> <span>*</span></label>
										<span class="business-error valid-error text-purple"></span>
									<?php
									endif;
								endforeach;
							endif;
							?>
							<ul class="h-list select-btns">
								<li class="radio">
									<label>
										<input type="radio" name="4" value="company" data-validme="business" class="validThis">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/company-img.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/company-img-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('company_select'); ?>
										</span>
										<ul class="valid-error text-purple text-purple"></ul>
									</label>
								</li>
								<li class="radio">
									<label>
										<input type="radio" name="4" value="product">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/product-img.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/product-img-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('product_select'); ?>
										</span>
										<ul class="valid-error text-purple text-purple"></ul>
									</label>
								</li>
								<li class="radio">
									<label>
										<input type="radio" name="4" value="services">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/services-icon.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/services-icon-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('services_select'); ?>
										</span>
										<ul class="valid-error text-purple text-purple"></ul>
									</label>
								</li>
							</ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_competitors'); ?><span>*</span></label>
							<!-- <input type="text" name="5" class="form-control validThis" > -->
							<textarea name="5" class="form-control validThis"></textarea>
							<ul class="valid-error text-purple text-purple"></ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_betterness'); ?></label>
							<!-- <input type="text" name="6" class="form-control" > -->
							<textarea name="6" class="form-control"></textarea>
							<ul class="valid-error text-purple text-purple"></ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_website'); ?></label>
							<input type="text" name="21" class="form-control" >
							<ul class="valid-error text-purple text-purple"></ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_have_social'); ?></label>
							<input type="text" name="22" class="form-control" >
							<ul class="valid-error text-purple text-purple"></ul>
						</div>

						<h3 class="padding-top-40 link-right" id="target-market"><?= $this->lang->line('about_target'); ?></h3>
						<!-- <div class="form-group">
							<label>What is your target customers' gender? <span>*</span></label>
							<ul class="h-list select-btns padding-bottom-20">
								<li class="checkbox">
									<label>
										<input type="checkbox" name="7[]" value="male" data-id="male">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/male-icon.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/male-icon-hover.png" class="hover-img" alt="">
											</figure>
											Male
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="7[]" value="female" class="validThis" data-id="female">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/female-icon.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/female-icon-hover.png" class="hover-img" alt="">
											</figure>
											Female
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
							</ul>
						</div> -->
						<div class="form-group target-customers">
							<label class="padding-bottom-30"><?= $this->lang->line('questionnaire_ageof_customers'); ?><span>*</span></label>
							<span class="gender-error valid-error text-purple"></span>
							<span class="gender_sub-error valid-error text-purple"></span>
							<ul class="h-list align-items-center padding-bottom-40">
								<li class="select-btns">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="7[]" data-validme="gender" value="female" id="checkFemale" data-id="female" class="validThis">
											<span>
												<figure>
													<img src="<?= base_url(); ?>assets_user/images/female-icon.png" alt="">
													<img src="<?= base_url(); ?>assets_user/images/female-icon-hover.png" class="hover-img" alt="">
												</figure>
												<?= $this->lang->line('female_text'); ?>
											</span>
										</label>
									</div>
								</li>
								<li class="age-selector" id="female">
									<ul>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" data-validme="gender_sub" value="1-10">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img1.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img1-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_10y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" value="11-17">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img2.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img2-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_17y'); ?>
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" value="18-23">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img3.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img3-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_23y'); ?>
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" value="24-30">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img4.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img4-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_30y'); ?>
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" value="31-40">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img5.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img5-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_40y'); ?>
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" value="41-60">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img6.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img6-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_60y'); ?>
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[female][]" value="61-70">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img7.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/female-icons/img7-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('female_70y'); ?>
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>		
										</li>
									</ul>
								</li>
							</ul>
							<ul class="h-list align-items-center padding-bottom-20">
								<li class="select-btns">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="7[]" data-validme="gender" value="male" id="checkMale" data-id="male" class="validThis">
											<span>
												<figure>
													<img src="<?= base_url(); ?>assets_user/images/male-icon.png" alt="">
													<img src="<?= base_url(); ?>assets_user/images/male-icon-hover.png" class="hover-img" alt="">
												</figure>
												<?= $this->lang->line('male_text'); ?>
											</span>
										</label>
									</div>
								</li>
								<li class="age-selector" id="male">
									<ul>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]"  data-validme="gender_sub" value="1-10">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img1.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img1-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_10y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]" value="11-17">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img2.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img2-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_17y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]" value="18-23">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img3.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img3-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_23y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]" value="24-30">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img4.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img4-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_30y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]" value="31-40">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img5.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img5-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_40y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]" value="41-60">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img6.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img6-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_60y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>
										</li>
										<li>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="8[male][]" value="61-70">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img7.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/male-icons/img7-hover.png" class="hover-img" alt="">
														</figure>
														<?= $this->lang->line('male_70y'); ?> 
													</span>
													<ul class="valid-error text-purple"></ul>
												</label>
											</div>		
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_what_else'); ?></label>
							<!-- <input type="text" name="9" class="form-control" > -->
							<textarea name="9" class="form-control"></textarea>
							<ul class="valid-error text-purple"></ul>
						</div>
						<h3 class="padding-top-40 link-right" id="your-brand"><?= $this->lang->line('about_brand'); ?></h3>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_unique'); ?><span>*</span></label>
							<!-- <input type="text" name="10" class="form-control validThis"> -->
							<textarea name="10" class="form-control validThis"></textarea>
							<ul class="valid-error text-purple"></ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_overall_message'); ?><span>*</span></label>
							<!-- <input type="text" name="11" class="form-control validThis"> -->
							<textarea name="11" class="form-control validThis"></textarea>
							<ul class="valid-error text-purple"></ul>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_brand_character'); ?><span>*</span></label>
							<div class="progress-slider">
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('classic_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('modern_compare'); ?></span>
									<input class="range-slider" type="range" name="12[classic]" min="0" max="100" step="1" value="50">
								</div>
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('mature_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('youthful_compare'); ?></span>
									<input class="range-slider" type="range" name="12[mature]" min="0" max="100" step="1" value="50">
								</div>
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('feminine_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('masculine_compare'); ?></span>
									<input class="range-slider" type="range" name="12[feminine]" min="0" max="100" step="1" value="50">
								</div>
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('economical_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('luxurious_compare'); ?></span>
									<input class="range-slider" type="range" name="12[economical]" min="0" max="100" step="1" value="50">
								</div>
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('playful_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('sophisticated_compare'); ?></span>
									<input class="range-slider" type="range" name="12[playful]" min="0" max="100" step="1" value="50">
								</div>
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('abstract_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('literal_compare'); ?></span>
									<input class="range-slider" type="range" name="12[abstract]" min="0" max="100" step="1" value="50">
								</div>
								<div class="bar">
									<span class="label-left"><?= $this->lang->line('geometric_compare'); ?></span>
									<span class="label-right"><?= $this->lang->line('organic_compare'); ?></span>
									<input class="range-slider" type="range" name="12[geometric]" min="0" max="100" step="1" value="50">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label><?= $this->lang->line('questionnaire_choise'); ?><span>*</span></label>
							<span class="font-error valid-error text-purple"></span>
							<ul class="h-list select-btns grid-view padding-top-20">
								<li class="radio">
									<label>
										<input type="radio" name="13" value="classic" data-validme="font" class="validThis">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img1.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img1-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('classic_select'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="radio">
									<label>
										<input type="radio" name="13" value="modern">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img2.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img2-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('modern_select'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="radio">
									<label>
										<input type="radio" name="13" value="handwritten">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img3.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img3-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('handwritten_select'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="radio">
									<label>
										<input type="radio" name="13" value="typewriter">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img4.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img4-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('typewriter_select'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="radio">
									<label>
										<input type="radio" name="13" value="surprise me">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img5.png" alt="">
												<img src="<?= base_url(); ?>assets_user/images/font-samples/img5-hover.png" class="hover-img" alt="">
											</figure><?= $this->lang->line('surprise_select'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
							</ul>
						</div>
						<div class="form-group padding-top-40">
							<label>
								<?= $this->lang->line('questionnaire_color_scheme'); ?><span>*</span>
								<span class="color-error valid-error text-purple"></span>
								<i><?= $this->lang->line('questionnaire_press_color'); ?></i>
							</label>
							<ul class="h-list select-colors select-btns grid-4 padding-top-20">
								<input type="radio" name="24" value="given_exact" style="display: none;">
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" data-validme="color"  value="0000FF" class="validThis">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img1.jpg" alt="">
											</figure><?= $this->lang->line('color_blue'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="008000">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img2.jpg" alt="">
											</figure><?= $this->lang->line('color_green'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="40E0D0">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img3.jpg" alt="">
											</figure><?= $this->lang->line('color_turquoise'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="FFFF00">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img4.jpg" alt="">
											</figure><?= $this->lang->line('color_yellow'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
	
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="FFA500">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img5.jpg" alt="">
											</figure><?= $this->lang->line('color_orange'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="FF0000">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img6.jpg" alt="">
											</figure><?= $this->lang->line('color_red'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="FFC0CB">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img7.jpg" alt="">
											</figure><?= $this->lang->line('color_pink'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="800080">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img8.jpg" alt="">
											</figure><?= $this->lang->line('color_purple'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
	
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="A52A2A">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img9.jpg" alt="">
											</figure><?= $this->lang->line('color_brown'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="808080">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img10.jpg" alt="">
											</figure><?= $this->lang->line('color_grey'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="FFFFFF">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img11.jpg" alt="">
											</figure><?= $this->lang->line('color_white'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="14[cs][]" value="000000">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/color-samples/img12.jpg" alt="">
											</figure><?= $this->lang->line('color_black'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
							</ul>
						</div>
						<div class="separator">
							<span><?= $this->lang->line('or'); ?></span>
						</div>
	
						<div class="form-group">
							<div id="colorpick"></div>
							<ul class="h-list select-btns grid-4 pickup-color">
								<li class="color-pallete">
									<!-- <div id="color-picker"></div> -->
									<div class="relative">
										<span id="colorpicker-preview"></span>
										
										<button type="button" class="color-picker">+<input type="radio" name="24" value="color_pallet" style="display: none;"></button>
									</div>
									<ul class="selected-colors">
										
									</ul>
									<label><?= $this->lang->line('color_customize'); ?></label>
									<ul class="valid-error text-purple"></ul>
								</li>
								<li class="radio surprise-color">
									<label>
										<input type="radio" name="14" value="surprise me">
										<input type="radio" name="24" value="surprise_me" style="display: none;">
										<span>
											<figure>
												<img src="<?= base_url(); ?>assets_user/images/surprise-color-pallete.jpg" alt="">
											</figure><?= $this->lang->line('color_surprize'); ?>
										</span>
										<ul class="valid-error text-purple"></ul>
									</label>
								</li>
							</ul>
						</div>
	
						<!-- Logo Questionnaire -->
						<?php
						if($designs && $show_logo):
							$logoCount = 0;
							foreach ($designs as $key => $design): 
								if($logoCount > 0){continue;}
								$design_cat = $this->db->get_where('designs', ['category_id' => 1, 'id' => $design['item_id']]);
								if($design['item_type'] == 'logo' || ($design_cat->num_rows() > 0 && $show_logo)):
									$logoCount++
									?>
									<input type="hidden" name="logo_status" value="1">
									<h3 class="padding-top-40 link-right" id="your-logo"><?= $this->lang->line('about_logo'); ?></h3>
									<div class="form-group">
										<label><?= $this->lang->line('questionnaire_like_in_logo'); ?><span>*</span></label>
										<input type="text" name="17" class="form-control validThis">
										<span class="structure-error valid-error text-purple"></span>
									</div>
									<div class="form-group">
										<label><?= $this->lang->line('questionnaire_select_slogan'); ?> </label>
										<input type="text" name="18" class="form-control">
									</div>
									<div class="form-group">
										<label>
											<?= $this->lang->line('questionnaire_logo_structure'); ?><span>*</span> </label>
										<span class="structure-error valid-error text-purple"></span>
										<ul class="h-list select-btns grid-4 padding-top-20">
											<li class="radio">
												<label>
													<input type="radio" name="19" data-validme="structure" value="Typographic">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img1.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img1-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_typographic'); ?>
													</span>
												</label>
											</li>
											<li class="radio">
												<label>
													<input type="radio" name="19" value="Iconic">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img2.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img2-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_iconic'); ?>
													</span>
												</label>
											</li>
											<li class="radio">
												<label>
													<input type="radio" name="19" value="Both (Typographic & Iconic)">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img3.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img3-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_both'); ?>
													</span>
												</label>
											</li>
											<li class="radio">
												<label>
													<input type="radio" name="19" value="Surprise me">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img4.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/structure-samples/img4-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_surprise'); ?>
													</span>
												</label>
											</li>
										</ul>
									</div>
									<div class="form-group padding-top-40">
										<label>
											<?= $this->lang->line('questionnaire_logo'); ?><span>*</span> </label>
										<span class="design-error valid-error text-purple"></span>
										<ul class="h-list select-btns grid-4 padding-top-20">
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" data-validme="design" value="watercolor">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img1.png" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img1-hover.png" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_watercolor'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="geometric">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img2.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img2-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_geometric'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="mascot">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img3.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img3-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_mascot'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="abstract">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img4.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img4-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_abstract'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="signature">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img5.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img5-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_signature'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="emblem">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img6.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img6-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_emblem'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="pictorial">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img7.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img7-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_pictorial'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="minimal">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img8.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img8-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_minimal'); ?>
													</span>
												</label>
											</li>

											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="linear">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img9.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img9-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_linear'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="hand">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img10.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img10-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_hand'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="letterform">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img11.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img11-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_letterform'); ?>
													</span>
												</label>
											</li>
											<li class="checkbox">
												<label>
													<input type="checkbox" name="20[]" value="surprise">
													<span>
														<figure>
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img12.jpg" alt="">
															<img src="<?= base_url(); ?>assets_user/images/brand-samples/img12-hover.jpg" class="hover-img" alt="">
														</figure><?= $this->lang->line('logo_surprise'); ?>
													</span>
												</label>
											</li>
										</ul>
									</div>

									<?php
									break;
								endif;
							endforeach;
						endif;
						?>		
						<!-- End Logo Questionnaire -->

						<div class="form-group padding-top-40">
							<label><?= $this->lang->line('questionnaire_communicate_designer'); ?></label>
							<!-- <input type="text" name="15" placeholder="<?= $this->lang->line('placeholder_write'); ?>" class="form-control"> -->
							<textarea name="15" placeholder="<?= $this->lang->line('placeholder_write'); ?>" class="form-control"></textarea>
							<ul class="valid-error text-purple"></ul>
						</div>
						<!-- <div class="form-group"> -->
							<label><?= $this->lang->line('questionnaire_any_img_doc'); ?></label>
							<ul class="text-purple mt-2" style="font-size: 14px;">Maximum size is 5MB</ul>
							<!-- <br> -->
							<!-- <span></span> -->
							
							<div class="uploader-wrapper mt-4">
								<!-- <div class="dropfiles" >
									<div class="file-uploader">
										<span class="placeholder"><?= $this->lang->line('placeholder_type'); ?></span>
										<div class="uploader-icon">
											<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
										</div>
									</div>
								</div>
								<div class="uploader-icon2"></div> -->
								<div id="dz0" class="files-holder dropzone">
									<div class="uploader-icon">
											<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
									</div>
								</div>
								<ul class="text-purple mt-2" id="max_file_error"></ul>
								<div id="gg_jd" class="form-group padding-top-40">
									<label><?= $this->lang->line('questionnaire_large_file_size'); ?></label>
									<textarea name="23" class="form-control"></textarea>
									<ul class="valid-error text-purple"></ul>
								</div>
								<script type="text/javascript">
									$('.dz-message').append('<br><img class="uploader-icon" style="width: 30px; margin-top:5px;" src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">');
									var divID = "#dz0";
									Dropzone.autoDiscover = false;
									Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drag files here";
									var dz0 = new Dropzone(divID, {
							            url: "<?= base_url('dropzone-files'); ?>",
							            paramName: "files",
							            maxFilesize: 5,
							            acceptedFiles : '.ico,.png,.jpg,.jpeg,.pdf,.ai,.psd,.eps,.indd,.doc,.docx,.ppt,.pptx,.xlsx,.xls',
							            addRemoveLinks : true,
							            dictRemoveFile : '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>',
							            dictCancelUpload : '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>',
							            parallelUploads: 1,
							            uploadMultiple: true,
							            autoProcessQueue: false,
							           	previewsContainer: divID,
							            clickable: true,
							           	maxFiles: 15,
							            init: function() {
							                this.on('addedfile', function(file){
							                    this.options.addRemoveLinks = true;
							                    this.options.dictRemoveFile = '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>';
							                    this.options.dictCancelUpload = '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>';
							                    $('#max_file_error').html("");
							                    if (file.type.match(/.pdf/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/pdf-icon.png'); ?>");
												}
												if (file.type.match(/.ai/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/ai-icon.png'); ?>");
												}
												if (file.type.match(/.docx/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/docx-icon.png'); ?>");
												}
												if (file.type.match(/.doc/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/docx-icon.png'); ?>");
												}
												if (file.type.match(/.eps/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/eps-icon.png'); ?>");
												}
												if (file.type.match(/.id/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/id-icon.png'); ?>");
												}
												if (file.type.match(/.ppt/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/ppt-icon.png'); ?>");
												}
												if (file.type.match(/.pptx/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/ppt-icon.png'); ?>");
												}
												if (file.type.match(/.psd/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/psd-icon.png'); ?>");
												}
												if (file.type.match(/.xlsx/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/xlsx-icon.png'); ?>");
												}
												if (file.type.match(/.xls/)) {
												    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/xlsx-icon.png'); ?>");
												}
							                });
							                this.on('sending', function(file, xhr, formData){
							                	this.options.dictRemoveFile = 'X';
							                	this.options.dictCancelUpload = 'X';
							                    var order_id = "<?= isset($order_id) ? $order_id : ''; ?>";
							                    formData.append('order_id', order_id);
							                });
							                this.on("processing", function() {
											    this.options.autoProcessQueue = true;
											});
							                this.on("success", function(file, filename) { 
							                    this.options.addRemoveLinks = false;
							                    this.options.dictRemoveFile = '';

							                    //this.processQueue();
							                });
							                this.on("maxfilesexceeded", function (file) {
						                        // this.removeAllFiles();
						                        // this.addFile(file);
						                        $('#max_file_error').html("<?= $this->lang->line('big_files_error') ?>");
						                        this.removeFile(file);
						                    });
						                    this.on("error", function(file, message) { 
						                    	if(message.search("File is too big") != -1){
								                	$('#max_file_error').html("<?= $this->lang->line('big_files_error') ?>");
								                	this.removeFile(file); 
						                    	}else{
						                    		$('#max_file_error').html("");
						                    	}
										    });
							            }// end init function
							        });
							        // console.log(dz0.options);

							       
								</script>
							</div>
						<!-- </div> -->
						
						<!-- <div class="inner-section border-0"> -->
							
							<div class="button-row padding-top-40">
								<ul class="valid-error text-purple"></ul>
								<button type="submit" class="btn btn-default submit-btns" data-except="except" id="firstForm"><?= $this->lang->line('questionnaire_btn_submit1'); ?></button>
								<label class="success-label" style="display: none;"><?= $this->lang->line('questionnaire_submit_success'); ?></label>
								<a href="javascript:void(0)" onclick="myFunction()" class="saved-link"><?= $this->lang->line('save_for_later_link'); ?></a>
									<!-- <a onclick="myFunction()">Click me</a> -->
								<a href="<?= base_url('dashboard'); ?>" class="process-link"><?= $this->lang->line('goto_dashbord_link'); ?></a>
							</div>
						<!-- </div> -->
					</form>
				<?php endif; ?>

				<!-- questionnaire for designs -->
				<?php 
					$jd = true;
					if($q_brand == false){
						// $designs = '';
						$jd = false;
					} 
				?>

				<?php if($designs):$i=0;
					foreach ($designs as $key => $design):
						if($design['item_type'] == 'logo'){continue;}
						$design_detail = $this->db->get_where('designs', ['id' => $design['item_id']])->row_array();
						$questionnaire = $this->db->get_where('questions_design', ['design_id' => $design['item_id']])->row_array();
						if($questionnaire):
							if($questionnaire['language'] == 0 &&
							   $questionnaire['measurement'] == 0 &&
							   $questionnaire['content'] == 0 &&
							   $questionnaire['textbox'] == 0 &&
							   $questionnaire['attachment'] == 0
							){
								$branding_ids_db = $this->db->get_where("designs" , ['category_id' => 1])->result_array();
								if($branding_ids_db){
									$branding_ids = array_column($branding_ids_db, "id");
								}else{
									$branding_ids = array();
								}
								if($design['item_type'] == 'addon' && in_array($design['item_id'], $branding_ids)){
									continue;
								}
								$this->db->update('order_items', ['status' => 1], ['id' => $design['id']]);
								continue;
							}
							//print_r($questionnaire);
					?>
					
						<!-- <div class="section-title sm border-0 link-right" id="branding">
							<h1>
								<?= strtoupper($design['item_name']); ?>
								<span class="add-icon"></span>
							</h1>
						</div> -->
						<form action="<?= base_url('save-questions'); ?>" method="post" id="qform" class="question-form form-count">
							<input type="hidden" name="item_id" value="<?= isset($design['id']) ? $design['id'] : null; ?>">
							<div class="inner-section border-0">
								<div class="section-title sm border-0 link-right" id="card-<?= $key; ?>">
									<h1>
										<?= isset($design['item_name']) ? strtoupper($design['item_name']) : ''; ?>
										<span class="add-icon"></span>
									</h1>
								</div>

								<?php if( (isset($questionnaire)) && ($questionnaire['language'] == 1)): ?>
									<h3><?= $this->lang->line('questionnaire_language_text'); ?></h3>
									<div class="form-group">
										<ul class="h-list">
											<li class="radio">
												<label>
													<input type="radio" name="language" value="english" checked="checked">
													<span><?= $this->lang->line('questionnaire_english'); ?> </span>
												</label>
											</li>
											<li class="radio">
												<label>
													<input type="radio" name="language" value="arabic">
													<span><?= $this->lang->line('questionnaire_arabic'); ?> </span>
												</label>
											</li>
										</ul>
									</div>
								<?php endif; ?>

								<?php if( (isset($questionnaire)) && ($questionnaire['measurement'] == 1)): 
									if( (! empty($design_detail['width'])) || (! empty($design_detail['height']))){
										$mt = $design_detail['width'].'X'.$design_detail['height'].' '.$design_detail['unit'];
									}else{
										$mt = '';
									}
								?>
									<h3><?= $this->lang->line('questionnaire_measurement'); ?></h3>
									<div class="form-group">
										<ul class="h-list">
											<?php if(!empty($mt)): ?>
												<li class="radio">
													<label>
														<input type="radio" checked="checked" value="<?= $mt; ?>" id="default" name="measurement" class="default">
														<span><?= $this->lang->line('satndard_measurement_1').' '.$mt ?></span>
													</label>
												</li>
											<?php endif; ?>

											<li>
												<ul class="h-list inner-list">
													<li class="radio">
														<label>
															<input type="radio" id="custom" name="measurement" class="custom" <?= empty($mt) ? 'checked="checked"' : ''; ?>>
															<span><?= $this->lang->line('customize_text'); ?> </span>
														</label>
													</li>
													<li>
														<div class="measure-value">
															<span class="<?= !empty($mt) ? 'disThis disabled' : ''; ?>"><?= $this->lang->line('measurement_width'); ?></span>
															<input type="text"
																name="width" 
																<?= !empty($mt) ? 'disabled="disabled"' : ''; ?>
																oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
																class="form-control validThis">
														</div>
													</li>
													<li class="radio">
														<div class="measure-value">
															<span class="<?= !empty($mt) ? 'disThis disabled' : ''; ?>"><?= $this->lang->line('measurement_height'); ?></span>
															<input type="text" 
																name="height" 
																<?= !empty($mt) ? 'disabled="disabled"' : ''; ?>
																oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
																class="form-control validThis">
														</div>
													</li>
													<li>
														<select name="unit" class="selectpicker" <?= !empty($mt) ? 'disabled="disabled"' : ''; ?> title="inch">
															<option value="inch" selected="selected">inch</option>
															<option value="pixel"><?= $this->lang->line('unit_pixel'); ?></option>
															<option value="mm"><?= $this->lang->line('unit_mm'); ?></option>
															<option value="cm"><?= $this->lang->line('unit_cm'); ?></option>
														</select>
													</li>
												</ul>
											</li>
										</ul>
										<div class="measurement-error text-purple"></div>
									</div>
								<?php endif; ?>

								<?php
								$answered_items = $this->db->get_where('answer_design', ['order_id' => $design['order_id']]);
								$content_flag = false;
								if($answered_items->num_rows() > 0){
									$content_flag = true;
								} ?>

									<ul class="h-list content">
									<li>
										<h3><?= $this->lang->line('questionnaire_content'); ?></h3>
									</li>
								<?php if( (isset($questionnaire)) && ($questionnaire['content'] == 1) && ($content_flag == true) ):
									
								?>
										<li class="checkbox">
											<label>
												<input id="bawa" type="checkbox" name="content" class="chk-content">
												<span><?= $this->lang->line('content_same'); ?></span>
											</label>
										</li>
										<li>
											<select id="slc-content" name="content-slc" class="selectpicker slc-content poped disabled">
												<option><?= $this->lang->line('content_choose'); ?></option>
											</select>
										</li>
								<?php endif; ?>
									</ul>

								<?php if( (isset($questionnaire)) && ($questionnaire['textbox'] == 1)): ?>
									<div class="form-group margin-bottom-10">
										<!-- <input type="text" name="textbox" class="form-control validThis" placeholder="<?= $this->lang->line('write_something_here'); ?>...">
										<ul class="valid-error text-purple"></ul> -->
										<textarea type="text" name="textbox" class="form-control validThis" placeholder="<?= $this->lang->line('write_something_here'); ?>..."></textarea>
										<ul class="valid-error text-purple"></ul>
									</div>
								<?php endif; ?>

								<?php if( (isset($questionnaire)) && ($questionnaire['attachment'] == 1)): ?>

									<div class="uploader-wrapper">
										<!-- <div class="dropfiles" >
											<div class="file-uploader">
												<span class="placeholder"><?= $this->lang->line('placeholder_type'); ?></span>
												<div id="<?= 'ca' . ($key + 1); ?>" class="uploader-icon">
													<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
												</div>
											</div>
										</div> -->
										<ul class="text-purple my-2" style="font-size: 14px;">Maximum size is 5MB</ul>
										<div id="<?= 'dz' . ($key + 1); ?>" class="files-holder dropzone"></div>
										<ul class="text-purple mt-2" id="max_file_error_<?= ($key + 1) ?>"></ul>
										<div class="form-group padding-top-40">
											<label><?= $this->lang->line('questionnaire_large_file_size'); ?></label>
											<textarea name="file_link" class="form-control"></textarea>
											<ul class="valid-error text-purple"></ul>
										</div>
										<script type="text/javascript">
											var divID = "<?= '#dz' . ($key + 1); ?>";
											var trigger = "<?= '#ca' . ($key + 1); ?>";
											Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drag files here";
											Dropzone.autoDiscover = false;
											var <?= 'dz' . ($key + 1); ?> = new Dropzone(divID, {
									            url: "<?= base_url('dropzone-files'); ?>",
									            paramName: "files",
									            maxFilesize: 5,
									            acceptedFiles : '.ico,.png,.jpg,.jpeg,.pdf,.ai,.psd,.eps,.indd,.doc,.docx,.ppt,.pptx,.xlsx,.xls',
									            addRemoveLinks : true,
									            dictRemoveFile : '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>',
									            parallelUploads: 1,
									            uploadMultiple: true,
									            autoProcessQueue: false,
									           	previewsContainer: divID,
									           	maxFiles: 15,
									            clickable: true,
									            init: function() {
									                this.on('addedfile', function(file){
									                    this.options.addRemoveLinks = true;
									                    this.options.dictRemoveFile = '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>';
									                    $("#max_file_error_<?= ($key + 1) ?>").html("");
									                    if (file.type.match(/.pdf/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/pdf-icon.png'); ?>");
														}
														if (file.type.match(/.ai/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/ai-icon.png'); ?>");
														}
														if (file.type.match(/.docx/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/docx-icon.png'); ?>");
														}
														if (file.type.match(/.doc/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/docx-icon.png'); ?>");
														}
														if (file.type.match(/.eps/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/eps-icon.png'); ?>");
														}
														if (file.type.match(/.id/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/id-icon.png'); ?>");
														}
														if (file.type.match(/.ppt/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/ppt-icon.png'); ?>");
														}
														if (file.type.match(/.pptx/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/ppt-icon.png'); ?>");
														}
														if (file.type.match(/.psd/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/psd-icon.png'); ?>");
														}
														if (file.type.match(/.xlsx/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/xlsx-icon.png'); ?>");
														}
														if (file.type.match(/.xls/)) {
														    this.emit("thumbnail", file, "<?= base_url('assets_user/images/file-icons/xlsx-icon.png'); ?>");
														}
									                });
									                this.on('sending', function(file, xhr, formData){
									                	this.options.dictRemoveFile = 'X';
									                    var item_id = "<?= isset($design['id']) ? $design['id'] : ''; ?>";
									                    formData.append('item_id', item_id);
									                    var order_id = "<?= isset($design['order_id']) ? $design['order_id'] : ''; ?>";
									                    formData.append('order_id', order_id);
									                    formData.append('q_type', 'design');

									                });
									                this.on("processing", function() {
													    this.options.autoProcessQueue = true;
													});
									                this.on("success", function(file, filename) { 
									                    this.options.addRemoveLinks = false;
									                    this.options.dictRemoveFile = '';
									                    //this.processQueue();
									                });
									                this.on("maxfilesexceeded", function (file) {
								                        $('#max_file_error2').html("<?= $this->lang->line('big_files_error') ?>");
						                        		this.removeFile(file);
								                    });
								                    this.on("error", function(file, message) { 
								                    	if(message.search("File is too big") != -1){
										                	$("#max_file_error_<?= ($key + 1) ?>").html("<?= $this->lang->line('big_files_error') ?>");
										                	this.removeFile(file); 
								                    	}else{
								                    		$("#max_file_error_<?= ($key + 1) ?>").html("");
								                    	}
												    });
									            }// end init function
									        });

										</script>
									</div>

								<?php endif; ?>
								<?php if($jd == true){ ?>
								<div class="button-row padding-top-40">
									<button id="sbmt" class="btn btn-default submit-btns"><?= $this->lang->line('questionnaire_btn_submit2'); ?></button>
									<!-- <button id="sbmt_jd" class="btn btn-default" data-toggle="modal" data-target="#completionModal"><?= $this->lang->line('questionnaire_btn_submit2'); ?></button> -->
									<label class="success-label itemMsg" style="display: none;"><?= $this->lang->line('questionnaire_submit_success'); ?></label>
									<a href="#" class="save-link"><?= $this->lang->line('save_for_later_link'); ?></a>
									<a href="<?= base_url('dashboard'); ?>" class="process-link"><?= $this->lang->line('goto_dashbord_link'); ?></a>
								</div>
								<?php } ?>
							</div>
						</form>
						<!-- <div class="inner-container">
						<div class="left-col">
						<div class="inner-section border-0"> -->
							<?php if($jd == false){ ?>
						<div class="question-form form-count">
							<div class="button-row padding-top-40">
								<!-- <button id="sbmt_jd" class="btn btn-default" data-toggle="modal" data-target="#completionModal"><?= $this->lang->line('questionnaire_btn_submit2'); ?></button> -->
								<button class="btn btn-default" onclick="scroll_submit()"><?= $this->lang->line('questionnaire_btn_submit2'); ?></button>
								<label class="success-label itemMsg" style="display: none;"><?= $this->lang->line('questionnaire_submit_success'); ?></label>
								<a href="#" class="save-link"><?= $this->lang->line('save_for_later_link'); ?></a>
								<a href="<?= base_url('dashboard'); ?>" class="process-link"><?= $this->lang->line('goto_dashbord_link'); ?></a>
							</div>

							<!-- <div class="modal fade form-completion-modal" id="completionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  	<div class="modal-dialog" role="document">
							  		<div class="modal-content">
							  			<div class="modal-header">
							  				<h4><?= $this->lang->line('alert_'); ?></h4>
									      	<button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  			</div>
									  	<div class="modal-body">
									        <p><?= $this->lang->line('submit_form_first'); ?></p>
									  	</div>
									  	<div class="modal-footer">
									        <button type="button" id="gggg" class="close close_modal" data-dismiss="modal" aria-label="Close"><?= $this->lang->line('ok_'); ?></button>
									  	</div>
									</div>
							    </div>
							</div> -->
						</div>
						<?php } ?>
						<!-- </div>
						</div>
						</div> -->
						<script>	
							// $(".close_modal").click(function() {
							// 	$('html, body').animate({
							//         scrollTop: $("#gg_jd").offset().top
							//     }, 2000)
							// });

							function scroll_submit(){
								swal({
					                title: "<?= $this->lang->line('submit_form_first'); ?>",
					                text: "",
					                type: "info",
					                confirmButtonText: "<?= $this->lang->line('ok_'); ?>",
					                confirmButtonClass: '',
					                showCancelButton: false,
					                cancelButtonText: "<?= $this->lang->line('cancel'); ?>",
					                cancelButtonClass: ''
					            },function(isConfirm) {
					                if (isConfirm) {
					                    $('html, body').animate({
									        scrollTop: $("#gg_jd").offset().top
									    }, 2000);
									    // $("button").removeClass("cancel");
					                }
					            });
					            $("button").removeClass("cancel");
					            // $('.confirm').css('box-shadow','11px -9px 0 1px #000','important');
					            $('.confirm').removeAttr("style").attr("style", "box-shadow: 11px -9px 0 1px #000 !important");;
					            // $("#foo").removeAttr("style");
							}
						</script>
					<?php 
						endif;
					endforeach;
				else:
					?>
					<div class="question-form">
						<div class="button-row padding-top-40">
							<a href="<?= base_url('dashboard'); ?>" class="process-link"><?= $this->lang->line('goto_dashbord_link'); ?></a>
						</div>
					</div>
				<?php endif; ?>

				<?php if($q_brand): ?>
					<div class="question-form" id="finalMsg" style="display: none;">
						<div class="button-row padding-top-40">
							<label class="success-label"><?= $this->lang->line('Thank_you_for_completing_all_your_design_items'); ?></label>
							<a href="<?= base_url('dashboard'); ?>" class="process-link"><?= $this->lang->line('goto_dashbord_link'); ?></a>
						</div>
					</div>
				<?php endif; ?>

				<div class="question-form"  id="saveLinkMsg" style="display: none;">
					<div class="button-row padding-top-40">
						<a href="<?= base_url('dashboard'); ?>" class="process-link"><?= $this->lang->line('goto_dashbord_link'); ?></a>
					</div>
				</div>


			</div><!-- // .left-col -->
			<div class="right-col">
				<div class="navigation-wrapper">
					<ul class="navigation-links">
						<span class="vertical-border"></span>
						<li>
							<?php if($designs): ?>
								<?php if(!$q_brand): ?>
									<ul class="inner">
										<li class="main-link">
											<a href="#branding"><?= $this->lang->line('branding'); ?></a>
										</li>
										<li>
											<a href="#your-business"><?= $this->lang->line('questionnaire_your_business_link'); ?></a>
										</li>
										<li>
											<a href="#target-market"><?= $this->lang->line('questionnaire_target_market_link'); ?></a>
										</li>
										<li>
											<a href="#your-brand"><?= $this->lang->line('questionnaire_brend_link'); ?></a>
										</li>
										<?php
										foreach ($designs as $key => $design):
											if ($design['item_type'] == 'logo'):
												?>
												<li>
													<a href="#your-logo"><?= $this->lang->line('questionnaire_logo_link'); ?></a>
												</li>
												<?php
											endif;
										endforeach;
										?>
									</ul>
								<?php endif; ?>
							<?php endif; ?>

							<?php if($designs): ?>

								<ul class="inner">
									<?php
									$is_design = false;
									foreach ($designs as $key => $design){
										if(in_array($design['item_type'], ['design','addon','custom_addon'])){
											$is_design = true;
										}
									}
									if($is_design == true):
										?>
										<li class="main-link">
											<a href="#"><?= $this->lang->line('questionnaire_design'); ?></a>
										</li>
									<?php endif; ?>
									
									<?php foreach ($designs as $key => $design): 
										if($design['item_type'] == 'logo'){continue;}
										$questionnaire = $this->db->get_where('questions_design', ['design_id' => $design['item_id']])->row_array();
										if($questionnaire):	
											if($questionnaire['language'] == 0 &&
											   $questionnaire['measurement'] == 0 &&
											   $questionnaire['content'] == 0 &&
											   $questionnaire['textbox'] == 0 &&
											   $questionnaire['attachment'] == 0
											){continue;}
										?>
											<li>
												<a href="#card-<?= $key; ?>"><?= strtoupper($design['item_name']); ?></a>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>


						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</main>
<?php if (isset($q_brand) && !$q_brand) {
	$saved_answers = $this->db->get_where('answers_brand_ex', ['order_id' => $order_id]);
	if ($saved_answers->num_rows() > 0) {
		$saved_answers = $saved_answers->row_array()['answers'];
	
?>
<script type="text/javascript">
	$(document).ready(function() {
		var datayo = <?php echo $saved_answers; ?>;
		console.log('datayodatayo', datayo);
		var els = $('#questionForm').find(':input').get();
		console.log('els', els);
		$.each(els, function() {
            if (this.name && datayo[this.name]) {
                if(this.type == 'checkbox' || this.type == 'radio') {
                    $(this).attr("checked", (datayo[this.name] == $(this).val()));
                } else {
                	console.log(datayo[this.name]);
                    $(this).val(datayo[this.name]);

                }
            }
        });
	});
</script>
<?php }} ?>
<script>

	$(document).ready(function() {
	  $(window).keydown(function(event){
	  	const element = event.target;
	    if(event.keyCode == 13) {
	  		if (element.tagName == 'TEXTAREA') {

	  		} else {
	  			event.preventDefault();
		    	return false;
	  		}
	    }
	  });
	});

	

	function myFunction() {
		// let ssssss = $('#questionForm').serializeArray();
		// console.log('serializeArray', ssssss);

		// if(typeof data != 'object') {
	        // return all data
	        var orderId = '<?= $order_id; ?>';
	        var els_ = $('#questionForm').find(':input').get();
	        var form_data = {};

	        $.each(els_, function() {
	        	console.log('this.name', this.name);
	        	console.log('$(this).val()', $(this).val());
	            if (this.name && !this.disabled && (this.checked
	                            || /select|textarea/i.test(this.nodeName)
	                            || /text|hidden|password/i.test(this.type))) {
	                form_data[this.name] = $(this).val();
	            }
	        });
	        // return form_data;
	        console.log('form_data', form_data);
	        $.ajax({
		      type: 'post',
		      url: '<?= base_url('save-questions-for-later'); ?>',
		      data: {'form_data':form_data, 'order_id':orderId},
		      success: function(msg){

		        }
			});
	    // }

	}

	$('.dz-message').append('<br><img style="width: 30px; margin-top:5px;" src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">');
	$(window).on("load", function(){
      $("html, body").animate({ scrollTop: 0 }, 1000);
    });

	$(document).ready(function(){

		$(".surprise-color").on("click", function(){
			if($(this).find("input[name=14]").is(":checked")){
				$(this).parents().find(".select-colors input")
					.prop("checked", false)
					.removeClass("validThis");
				$(".selected-colors").empty();
			}
			$(this).find("input[name=24]").prop("checked", true);
		});

		$(".select-colors .checkbox").on("click", function(){
			if($(this).find("input").is(":checked")){
				$(this).parents().find(".surprise-color input").prop("checked", false);
				$(".selected-colors").empty();
				$(this).addClass("validThis");
			}
			$(this).parent('.select-colors').find("input[name=24]").prop("checked", true);
		});

		$(".color-picker").on("click", function(){
			//console.log('clicked');
			
			$(this).find("input[name=24]").prop("checked", true);
			$(this).parents().find(".surprise-color input, .select-colors input")
				.prop("checked", false)
				.removeClass("validThis");	
			

			var hex = $(".ui-colorpicker-hex-input").val();

			$('<input>').attr({
			    type: 'hidden',
			    name: '14[cp][]',
			    value: '#' + hex
			}).appendTo('#colorpick');


			var clrbox = "<li style='background: #" + hex + "'><a href='#' class='remove-color'></a></li>";
			$(".selected-colors").append(clrbox);
		});

		//measurement functionality
		$('.custom').on('change', function(event){
			$(this).closest('form')
				.find('input[name=width],input[name=height],select[name=unit]')
				.prop("disabled", !$(this).is(':checked'));
			$('.selectpicker').selectpicker('refresh');
			$(this).closest('form').find('.disThis').removeClass('disabled');
		});
		$('.default').on('change', function(event){
			$(this).closest('form')
				.find('input[name=width],input[name=height],select[name=unit]')
				.prop("disabled", $(this).is(':checked'));
			$('.selectpicker').selectpicker('refresh');
			$(this).closest('form').find('.disThis').addClass('disabled');
		});
	});

	$(document).ready(function() {

		//color picker functionality
		$('#colorpicker-preview').colorpicker({
	        parts: [ 'map', 'bar', 'hex', 'rgb', 'cmyk', 'preview'],
            alpha: false
	    });

		$(document).on("click", ".remove-color", function(e){
			e.preventDefault();
			var clr = $(this).parent().css('backgroundColor');
			var chex = hexc(clr);
			$('#colorpick').children('input[value="'+chex+'"]').remove();
			$(this).parent().remove();

		 	var height1 = $(".color-pallete .relative").height();
	      	var height2 = $(".color-pallete .selected-colors").height();
	      	$(".surprise-color figure").css("height", height1+height2);
		});

		function hexc(colorval) {
		    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		    delete(parts[0]);
		    for (var i = 1; i <= 3; ++i) {
		        parts[i] = parseInt(parts[i]).toString(16);
		        if (parts[i].length == 1) parts[i] = '0' + parts[i];
		    }
		    return '#' + parts.join('');
		}

		// content functionality
		$('.chk-content').on('change', function(event){
			//event.preventDefault();
			var e = $(this);
			if(e.is(':checked')) {
				var item_id = e.closest('form').find('input[name=item_id]').val();
				e.closest('form').find('.slc-content').removeClass('disabled');
				//console.log(item_id);
				$.ajax({
			      type: 'post',
			      url: '<?= base_url('get-order-items'); ?>',
			      data: {'item_id':item_id},
			      success: function(msg){
			        e.closest('form')
			        	.find('select[name=content-slc]')
			        	.html(msg)
			        	.selectpicker('refresh');
			        }
				});
			}else{
				e.closest('form').find('.slc-content').addClass('disabled');
			}
		});

		$('select[name=content-slc]').on('change mouseenter', function(event){
		//$('.poped').on('change', function(event){
			//alert('asdasd');
			element = $(this);
			var item_id = element.val();
			element.closest('form').find('input[name=content]').val(item_id);

			$.ajax({
				type: 'post',
				url: '<?= base_url('get-order-items-detail'); ?>',
				data: {'item_id':item_id},
				success: function(resp){
					var data = $.parseJSON(resp);
					console.log(data);

					if(data.status == true){
						element.closest('form')
						.find('input[name=textbox]')
						.val(data.data.textbox);

						element.closest('form')
						.find('textarea[name=textbox]')
						.html(data.data.textbox);
					}
				}
			});
		});

		// save for later functionality
		$('.save-link').on('click',function(event){
			event.preventDefault();
			var form = $(this).closest('form');
			form.slideUp(1200);
			//form.remove();

			var formNames = $('.form-count').filter(function() {
			    return $(this).css('display') !== 'none';
			}).length;
			
			//console.log(formNames);
			if(formNames == 1){
				$("#saveLinkMsg").show();
			}
		});


		//get city by country
		$('#countryId').on('change', function(event){
			event.preventDefault();
			var countryId = $(this).find(':selected').data('countrycode');
			//console.log(countryId);
			$.ajax({
		      	type: 'post',
		      	url: '<?= base_url('get-cities'); ?>',
		      	data: {'country_id':countryId},
		      	success: function(msg){
		      		//console.log(msg);
		      		$('#cityId').html(msg);
		        }
			});
		});

		//age selector handler
		$('#checkFemale').on("change", function(event){
			if($(this).is(":checked")){
				$("#female").find('input:checkbox[name="8[female][]"]').addClass('validThis');
			}else{
				$("#female").find('input:checkbox[name="8[female][]"]').removeClass('validThis').prop('checked', false);
			}
		});

		$('#checkMale').on("change", function(event){
			if($(this).is(":checked")){
				$("#male").find('input:checkbox[name="8[male][]"]').addClass('validThis');
			}else{
				$("#male").find('input:checkbox[name="8[male][]"]').removeClass('validThis').prop('checked', false);
			}
		});

		// multiple form submit functionality
		$('.submit-btns').on('click', function(event){
			event.preventDefault();

			// $(this).attr("disabled" , "disabled");

			var dropzoneID = $(this).parent().siblings('.uploader-wrapper').find('.files-holder').attr('id');
			file_uploading_reference =  $(this).parent().siblings('.uploader-wrapper').find("[id*=max_file_error]");

			var btn = $(this);
			var except = btn.data('except');

			// if( ! except){
			// 	alert("yes");
			// }else{
			// 	alert("no");
			// }
			// return;
			var form = $(this).closest('form');
		    var selectedElements = form.find(".validThis");
		    var validation = false;
		    var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
		    var errorClass = ".valid-error";
		    var e;
		    var eName;
		    //console.log('valid: ',selectedElements);

		    if(selectedElements.length > 0){
		        if (form[0].checkValidity()) {
		            selectedElements.each(function(){
		                e = $(this);
		                eName = e.attr('name');
		                validClass = e.attr('data-validme');
		                var isDisabled = e.prop('disabled');
		                //console.log(isDisabled);
		                if(isDisabled == true) {
		                	validation = true;
		                	return;
		                }

			            //validate checkbox inputs
			            if(e.is('input:checkbox')){
			                if( ! $('input:checkbox[name="'+eName+'"]:checked').length) {
			                    $('.'+validClass+'-error').html(errorMsg).show();
			                    $('html, body').animate({ scrollTop: $('.'+validClass+'-error').offset().top }, 'slow');
			                    validation = false;
			                    return false;
			                }
			            }

			            //validate checkbox inputs
			            if(e.is('input:radio')){
			                if( ! $('input:radio[name="'+eName+'"]:checked').length) {
			                    $('.'+validClass+'-error').html(errorMsg).show();
			                    $('html, body').animate({ scrollTop: $('.'+validClass+'-error').offset().top }, 'slow');
			                    validation = false;
			                    return false;
			                }
			            }

			            //validate measurement inputs in design questionnaire
			            if(eName == 'height' || eName == 'width'){
				            if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
			                    e.focus();
			                    $('.measurement-error').html(errorMsg).addClass('text-purple').show();
			                    validation = false;
			                    return false;
			                }
			            }

		                if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
		                    e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
		                    validation = false;
		                    return false;
		                }else{
		                    validation = true;
		                    e.parent().find(errorClass).html('').hide();
		                }
		            });
		        }else{
		            alert("<?= $this->lang->line('all_enable_fields_required'); ?>");
		        }
		    }

		    if( (selectedElements.length == 0) || (validation == true) ){
		    	var data = new FormData(form[0]);
		    	/*$.each(form.find('input[type=file]').files, function(i, file) {
				    data.append('file[]', file);
				});*/

				if(data.has('19')){
					var q19 = $('input[name="19"]:checked').val();
					data.set('19', q19);
				}
				//console.log(data.get('20[]'));
				var dzee = eval('('+ dropzoneID +')');
						//console.log(dzee);
				if(dzee.files.length > 0){
					btn.text('<?= $this->lang->line("sending"); ?>').attr('disabled',true);
			    	dzee.processQueue();
			    	console.log("In");
			    	file_uploading_reference.html("<?= $this->lang->line('files_still_uploading') ?>");
			    	// return;
			    	dzee.on('queuecomplete', function(file){
			    		console.log("in");
			    		file_uploading_reference.html("");
				    	$.ajax({
							type: 'post',
							url: form.attr('action'),
							data: data,
							contentType: false,
		    				processData: false,
		    				beforeSend: function(){ 
								btn.text('<?= $this->lang->line("sending"); ?>').attr('disabled',true);
							},
							success: function(msg){
								console.log('msg', msg);

								<?php if(isset($content_flag) && $content_flag == false){ ?>
									location.reload();
								<?php } ?>

								btn.parent().find('.save-link').hide();
								//btn.parent().find('.process-link').hide();

								btn.val('Submit').attr('disabled',false).hide();

								// trigger drop zone
							    var dzee = eval('('+ dropzoneID +')');
								//console.log(dzee);
								// if(dzee.files.length > 0){
							   //  	dzee.processQueue();
							   //  	dzee.on('queuecomplete', function(file){
							   //  		btn.parent().find('.itemMsg').show();
										// if( ! except){
										// 	form.slideUp(1200);
										// }

										// //check how many questionnaires are remain and show last link to dashboard
										// if(msg == 'zain'){
										// 	$('#finalMsg').show();
										// 	location.replace("<?= base_url('dashboard'); ?>");
										// }else{
										// 	var formNames = $('.form-count').filter(function() {
										// 	    return $(this).css('display') !== 'none';
										// 	}).length;
											
										// 	//console.log(formNames);
										// 	if(formNames <= 1){
										// 		$("#saveLinkMsg").show();
										// 		location.replace("<?= base_url('dashboard'); ?>");
										// 	}
										// }


										// //page redirect for branding questionnaire only
										// var isCustom = "<?= $is_custom; ?>"; 
										// var isBranding = "<?= base_url('branding-questions'); ?>"; 
										// var currentQuestionnaire = form.attr('action'); 
										// if(isBranding == currentQuestionnaire){
										// 	if(isCustom == "true"){
										// 		//if package is custom then just refresh the page
										// 		location.reload();
										// 	}else{
										// 		location.replace("<?= base_url('dashboard'); ?>");
										// 	}
										// }
							   //  	});
									
								// }else{
									btn.parent().find('.itemMsg').show();
									if( ! except){
										form.slideUp(1200);
									}

									//check how many questionnaires are remain and show last link to dashboard
									if(msg == 'zain'){
										$('#finalMsg').show();
										location.replace("<?= base_url('dashboard'); ?>");
									}else{
										var formNames = $('.form-count').filter(function() {
										    return $(this).css('display') !== 'none';
										}).length;
										
										//console.log(formNames);
										if(formNames == 1){
											$("#saveLinkMsg").show();
											location.replace("<?= base_url('dashboard'); ?>");
										}
									}


									//page redirect for branding questionnaire only
									var isCustom = "<?= $is_custom; ?>"; 
									var isBranding = "<?= base_url('branding-questions'); ?>"; 
									var currentQuestionnaire = form.attr('action'); 
									if(isBranding == currentQuestionnaire){
										if(isCustom == "true"){
											//if package is custom then just refresh the page
											location.reload();
										}else{
											location.replace("<?= base_url('dashboard'); ?>");
										}
									}
								// }

							}
						});
			    	});
		    	}else{
		    		console.log("in");
				    	$.ajax({
							type: 'post',
							url: form.attr('action'),
							data: data,
							contentType: false,
		    				processData: false,
		    				beforeSend: function(){ 
								btn.text('<?= $this->lang->line("sending"); ?>').attr('disabled',true);
							},
							success: function(msg){
								console.log('msg', msg);

								<?php if(isset($content_flag) && $content_flag == false){ ?>
									location.reload();
								<?php } ?>

								btn.parent().find('.save-link').hide();
								//btn.parent().find('.process-link').hide();

								btn.val('Submit').attr('disabled',false).hide();

								// trigger drop zone
							    var dzee = eval('('+ dropzoneID +')');
								//console.log(dzee);
								if(dzee.files.length > 0){
							    	dzee.processQueue();
							    	dzee.on('queuecomplete', function(file){
							    		btn.parent().find('.itemMsg').show();
										if( ! except){
											form.slideUp(1200);
										}

										//check how many questionnaires are remain and show last link to dashboard
										if(msg == 'zain'){
											$('#finalMsg').show();
											location.replace("<?= base_url('dashboard'); ?>");
										}else{
											var formNames = $('.form-count').filter(function() {
											    return $(this).css('display') !== 'none';
											}).length;
											
											//console.log(formNames);
											if(formNames <= 1){
												$("#saveLinkMsg").show();
												location.replace("<?= base_url('dashboard'); ?>");
											}
										}


										//page redirect for branding questionnaire only
										var isCustom = "<?= $is_custom; ?>"; 
										var isBranding = "<?= base_url('branding-questions'); ?>"; 
										var currentQuestionnaire = form.attr('action'); 
										if(isBranding == currentQuestionnaire){
											if(isCustom == "true"){
												//if package is custom then just refresh the page
												location.reload();
											}else{
												location.replace("<?= base_url('dashboard'); ?>");
											}
										}
							    	});
									
								}else{
									btn.parent().find('.itemMsg').show();
									if( ! except){
										form.slideUp(1200);
									}

									//check how many questionnaires are remain and show last link to dashboard
									if(msg == 'zain'){
										$('#finalMsg').show();
										location.replace("<?= base_url('dashboard'); ?>");
									}else{
										var formNames = $('.form-count').filter(function() {
										    return $(this).css('display') !== 'none';
										}).length;
										
										//console.log(formNames);
										if(formNames == 1){
											$("#saveLinkMsg").show();
											location.replace("<?= base_url('dashboard'); ?>");
										}
									}


									//page redirect for branding questionnaire only
									var isCustom = "<?= $is_custom; ?>"; 
									var isBranding = "<?= base_url('branding-questions'); ?>"; 
									var currentQuestionnaire = form.attr('action'); 
									if(isBranding == currentQuestionnaire){
										if(isCustom == "true"){
											//if package is custom then just refresh the page
											location.reload();
										}else{
											location.replace("<?= base_url('dashboard'); ?>");
										}
									}
								}

							}
						});
		    	}
		    }
		});
	});

</script>