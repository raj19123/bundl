<style type="text/css">
	.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 120vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center;
}
</style>
<main class="main-contents payment-page stack-on-mobile">
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
		<?php //print_r($cart_contents); ?>
		<div class="product-wrapper">
			
			<div class="left-col">
				<div class="bundl-head">
					<div class="image">
						<img src="<?= base_url('uploads/icons/') . $icon['name']; ?>" alt="icon">
					</div>
					<h4><?= isset($package['name_'.$language]) ? $package['name_'.$language] : ''; ?></h4>
				</div>
			
			<form id="bundl-form">
				<input type="hidden" name="package_id" value="<?= isset($package['id']) ? $package['id'] : ''; ?>" />
				<!-- <input type="hidden" name="package_name" value="<?= isset($package['name_english']) ? $package['name_english'] : ''; ?>" />
				<input type="hidden" name="package_price" value="<?= isset($package['price']) ? $package['price'] : '0'; ?>" />
				<input type="hidden" name="package_time" value="<?= isset($package['time']) ? $package['time'] : '0'; ?>" />
				<input type="hidden" name="package_qty" value="1" />
				 -->
				<div class="bundl-name">
					<div class="form-group">
						<label><?= $this->lang->line('name_bundle'); ?></label>
						<input type="text" 
							id="project_name" 
							name="project_name" 
							class="form-control validThis" 
							placeholder="<?= $this->lang->line('placeholder_pro'); ?>"
							value="<?php if($this->session->userdata('project_name')){ echo $this->session->userdata('project_name'); } ?>">
						<ul class="valid-error text-purple"></ul>
					</div>
				</div>
				<div class="bundl-desc">
					<h3><?= $this->lang->line('bundle_detail'); ?></h3>
					<p><?= isset($package['description_'.$language]) ? $package['description_'.$language] : ''; ?></p>
					<ul class="statics">
						<li>
							<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> <?= $package['price']; ?> <?= $this->lang->line('sar'); ?> 
						</li>
						<li>
							<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $package['time']; ?> <?= $this->lang->line('work_days'); ?> 
						</li>
					</ul>
				</div>

			<?php 
			if(isset($components)):
				foreach ($components as $key => $component):
					if($component['slug'] == 'branding-identity'):
			?>
				<div class="brand-identy">
					<div class="inner-title">
						<span class="icon">
							<img src="<?= base_url(); ?>assets_user/images/pencil-icon.png" alt="">
						</span>
						<h2><?= strtoupper($component['name_'.$language]); ?></h2>
					</div>
					<ul class="h-list">
						<li>
							<p><?= $this->lang->line('logo_design'); ?></p>
						</li>
						<li>
							<div class="radio">
								<label>
									<input type="radio" 
										name="logo" 
										value="arabic"
										<?php 
										if($cart_contents){
											foreach ($cart_contents as $key => $value) {
												if($value['options']['type'] == 'logo'){
													if($value['name'] == 'arabic'){
														echo 'checked="checked"';
													}
												}
											}	
										} 
										?>
										class="logo_language">
									<span><?= $this->lang->line('arbi'); ?></span>
								</label>
							</div>
						</li>
						<li>
							<div class="radio">
								<label>
									<input type="radio" 
										name="logo" 
										value="english" 
										<?php 
										$chk = 'checked="checked"';
										if($cart_contents){
											foreach ($cart_contents as $key => $value) {
												if($value['options']['type'] == 'logo'){
													if($value['name'] == 'english'){
														$chk = 'checked="checked"';
													}
												}
											}	
										}
										echo $chk;
										?>
										class="logo_language">
									<span><?= $this->lang->line('engl'); ?></span>
								</label>
							</div>
						</li>
						<li>
							<div class="radio">
								<label>
									<input type="radio" 
										id="both" 
										name="logo" 
										value="both"
										<?php 
										if($cart_contents){
											foreach ($cart_contents as $key => $value) {
												if($value['options']['type'] == 'logo'){
													if($value['name'] == 'both'){
														echo 'checked="checked"';
													}
												}
											}	
										}
										?>
										class="logo_language"> 
									<span><?= $this->lang->line('both'); ?></span>
								</label>
							</div>
						</li>
						<li>
							<?php 
							$design_ids = $this->package_model->get_design_ids([$component['id']]);
							//$logo = $this->db->where_in('id', $design_ids)->get('designs')->row_array();
							$logo = $this->db->where('slug', 'logo')->where_in('id', $design_ids)->get('designs')->row_array();
							//print_r($designs);
							?>
							<ul class="statics brand logo_price" style="display: none;">
								<li>
									<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= $logo['dual_lang_price']; ?> <?= $this->lang->line('sar'); ?>
								</li>
								<li>
									<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $logo['dual_lang_time']; ?> <span> <?= $this->lang->line('day'); ?></span>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			<?php
				endif;
			endforeach; 
		endif; 
		?>


			<?php 
			if(isset($components)):
				$printed_designs = [];
				foreach ($components as $key => $component):
					if($component['slug'] != 'branding-identity'):
					?>

				<div class="brand-design" style="margin-bottom: 40px;">
					<div class="inner-title">
						<span class="icon">
							<img src="<?= base_url(); ?>assets_user/images/pencil-icon.png" alt="">
						</span>
						<h2>
							<?= $component['name_'.$language]; ?>
							<span><?= $component['slogan_'.$language]; ?></span>
						</h2>
					</div>
					<table class="payment-table auto-responsive" cellpadding="0" cellspacing="0">
						<tbody>
							<?php 
							$design_ids = $this->package_model->get_design_ids([$component['id']]);
							$designs = $this->db->where_in('id', $design_ids)->get('designs')->result_array();
							//print_r($designs);
							
							if($designs): 
								foreach ($designs as $k => $design):
									if ( ! in_array($design['id'], $printed_designs)):
										array_push($printed_designs, $design['id']);
										$price = $design['price'];
										$time = $design['time'];
										
										//component design wise qty added by admin
										$component_design_qty = $this->db->get_where('component_design', ['component_id' => $component['id'], 'design_id' => $design['id']])->row_array();
										$component_design_qty = $component_design_qty['quantity'];
									
										if($cart_contents){
											$item_counts = array_count_values(array_column($cart_contents, 'id'));
											foreach ($cart_contents as $key => $value) {
												if($value['options']['type'] == 'design'){
													if($value['id'] == $design['id']){
														$qty = $item_counts[$design['id']];
														$price = (float)$value['price'] * (int)$qty;
														$time = (float)$value['time'] * (int)$qty;
													}
												}
											}	
										}
												
								?>
								<tr>
									<td><?= $design['name_'.$language]; ?></td>
									<td>
										<ul class="statics brand show-on-quantity ">
											<li>
												<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt="">
												<i class="i-tag">+&nbsp;</i><div class="showPrice">&nbsp;<?= $design['price']; ?></div> <span> <?= $this->lang->line('sar'); ?></span>
											</li>
											<li>
												<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt="">
												<div class="showTime"><?= $design['time']; ?></div> <span> <?= $this->lang->line('day'); ?></span>
											</li>
										</ul>
										<input type="hidden" name="designs[<?= $design['id']; ?>][price]" 
											value="<?= $price; ?>" class="get-price">
										<input type="hidden" name="designs[<?= $design['id'] ?>][time]" 
											value="<?= $time; ?>" class="get-time">
										<input type="hidden" name="designs[<?= $design['id'] ?>][component_id]" 
											value="<?= $component['id']; ?>">
									</td>
									<td>
										<?php if($design['type'] == 'side'): ?>
										<ul class="h-list justify-end">
											<li><?= $this->lang->line('side'); ?>:</li>
											<li>
												<select name="designs[<?= $design['id'] ?>][mtype]"
													data-price="<?= $design['price']; ?>" 
													data-init-price="<?= $design['price']; ?>"
													data-time="<?= $design['time']; ?>"
													data-init-time="<?= $design['time']; ?>"
													data-price-increment="<?= $design['price_increment']; ?>"
													data-time-increment="<?= $design['time_increment']; ?>"
													class="selectpicker metrisi-type page-fold-change">
													
													<option value="one-side"><?= $this->lang->line('one_side'); ?></option>
													<option value="two-side"><?= $this->lang->line('two_side'); ?></option>
													<option value="three-side"><?= $this->lang->line('three_side'); ?></option>
												</select>
											</li>
										</ul>
										<br />
										<?php endif; ?>

										<?php if($design['type'] == 'fold'): ?>
										<ul class="h-list justify-end">
											<li>fold:</li>
											<li>
												<select name="designs[<?= $design['id'] ?>][mtype]" 
													data-price="<?= $design['price']; ?>" 
													data-init-price="<?= $design['price']; ?>"
													data-time="<?= $design['time']; ?>"
													data-init-time="<?= $design['time']; ?>"
													data-price-increment="<?= $design['price_increment']; ?>"
													data-time-increment="<?= $design['time_increment']; ?>"
													class="selectpicker metrisi-type page-fold-change">
													
													<option value="mono-fold"><?= $this->lang->line('mono_fold'); ?></option>
													<option value="bi-fold"><?= $this->lang->line('bi_fold'); ?></option>
													<option value="tri-fold"><?= $this->lang->line('tri_fold'); ?></option>
												</select>
											</li>
										</ul>
										<br />
										<?php endif; ?>

										<?php if($design['type'] == 'page'): ?>
										<ul class="h-list justify-end">
											<li>pages:</li>
											<li>
												<div class="input-group plus-minus-input">
				                                    <a href="javascript:void(0)" class="btn page_dec_btn" data-field="quantity">
				                                    	-
				                                    </a>
				                                    <input class="form-control input-group-field page_range" type="text" value="1 - 10" name="designs[<?= $design['id'] ?>][mtype]" data-preval="1" readonly>
				                                    <a href="javascript:void(0)" class="btn page_inc_btn" data-field="quantity">
				                                    	+
				                                    </a>
				                                </div>
											</li>
										</ul>
										<br />
										<?php endif; ?>
									<input type="text" 
										name="designs[<?= $design['id']; ?>][qty]" 
										data-init-price="<?= $design['price']; ?>"
										data-init-time="<?= $design['time']; ?>"
										data-price-increment="<?= $design['price_increment']; ?>"
										data-time-increment="<?= $design['time_increment']; ?>"
										data-component-qty="<?= $component_design_qty; ?>"
										class="touchspin qtyspin" 
										min="0" 
										value="<?php 
												$quty = $component_design_qty;
												if($cart_contents){
													$item_counts = array_count_values(array_column($cart_contents, 'id'));
													foreach ($cart_contents as $key => $value) {
														if($value['options']['type'] == 'design'){
															if($value['id'] == $design['id']){
																$quty = $item_counts[$design['id']];
															}
														}
													}	
												}
												echo $quty;
												?>" 
										readonly="">
								</td>
							</tr>
							
							<?php 
						endif; 
					endforeach; 
				endif; 
				?>
							
						</tbody>
					</table>
				</div>

				<?php
			endif;
			endforeach; 
		endif; 
		?>
		
		<div class="button-row margin-top-40">
			<button type="submit" id="add-to-cart" class="btn btn-default">
				<?php 
				if($cart_contents){
					echo $this->lang->line('update_to_cart');
				}else{
					echo $this->lang->line('addto_cart');
				}
				?>
			</button>
		</div>

			</form>

				<!-- Add-on section -->
				<div id="addon-section" style="display: none;">
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


<script>

	<?php if($cart_contents){ ?>
		$(document).ready(function(){
			$('#addon-section').show();
		});
	<?php } ?>

	$('.logo_language').click(function(){
		if($(this).prop('checked') && $(this).val() == 'both'){
			$('.logo_price').show();
		}else{
			$('.logo_price').hide();
		}
	});

	$('#add-to-cart').on('click', function(event){
		event.preventDefault();

		var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
	    var errorClass = ".valid-error";
		e = $('#project_name');
	    if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
	        e.focus().parent().find(errorClass).html(errorMsg).addClass('text-danger').show();
	        return false;
	    }else{
	    	e.parent().find(errorClass).html('').removeClass('text-danger').hide();
	    }
		
		var btn = $(this);

		var data = $('#bundl-form').serializeArray();
		//console.log(data);
		$.ajax({
			type: 'post',
			url: '<?= base_url('add-cart'); ?>',
			data: data,
			success: function(msg){
				console.log(msg);
				//$('#rightSide').html('<div class="vertical-center"><img src="<?= base_url('assets_user/images/loading.gif'); ?>"></div>');
				$('#addon-section').show();
				$('#rightSide').html(msg);
				btn.closest('.success-label').show();
				btn.closest('.save-link').hide();
				btn.closest('.process-link').hide();
				btn.html("<?= $this->lang->line('update_to_cart'); ?>");

				//console.log(msg);
			}
		});
	});

	$('.page-fold-change').on('change', function(event){
		event.preventDefault();

		var price = $(this).data('init-price');
		var time = $(this).data('init-time');
		var priceIncrement = $(this).data('price-increment');
		var timeIncrement = $(this).data('time-increment');
		var qty = $(this).closest('tr').find('.qtyspin').val();

		//Price and Time Calculation
		//Formula: Price + (Quantity * Increment Amount)
		var priceIncrementAmount = (parseFloat(price) * parseInt(priceIncrement)) / 100;
		var timeIncrementAmount = (parseFloat(time) * parseInt(timeIncrement)) / 100;
		
		if($(this).val() == 'mono-fold' || $(this).val() == 'one-side'){
			var subtotalPrice = parseFloat(price) * parseInt(qty);
			var subtotalTime = parseFloat(time) * parseInt(qty);
		}

		if($(this).val() == 'bi-fold' || $(this).val() == 'two-side'){
			var subtotalPrice = (parseFloat(price) + priceIncrementAmount)  * parseInt(qty);
			var subtotalTime = (parseFloat(time) + timeIncrementAmount)  * parseInt(qty);
		}

		if($(this).val() == 'tri-fold' || $(this).val() == 'three-side'){
			var subtotalPrice = (parseFloat(price) + priceIncrementAmount + priceIncrementAmount)  * parseInt(qty);
			var subtotalTime = (parseFloat(time) + timeIncrementAmount + timeIncrementAmount)  * parseInt(qty);
		}

		subtotalPrice = isFloat(subtotalPrice) ? subtotalPrice.toFixed(2) : subtotalPrice;
		subtotalTime = isFloat(subtotalTime) ? subtotalTime.toFixed(1) : subtotalTime;

		$(this).closest("tr").find(".statics").removeClass("show-on-quantity");
		$(this).closest('tr').find('.showPrice').html(subtotalPrice);
		$(this).closest('tr').find('.showTime').html(subtotalTime);

		//final price and time for process
		$(this).closest('tr').find('.get-price').val(subtotalPrice);
		$(this).closest('tr').find('.get-time').val(subtotalTime);

		
		$(this).data('price', subtotalPrice);
		$(this).data('time', subtotalTime);

		//console.log('priceIncrementAmount',priceIncrementAmount);
		//console.log('pretab',pretab);
		//console.log('price',price);
		//console.log('priceIncrement',priceIncrement);
		//console.log('subtotalPrice',subtotalPrice);
		//console.log('subtotalTime', subtotalTime);
	});

	$('.qtyspin').on('touchspin.on.startspin', function(event){
		//event.preventDefault(); touchspin.on.startdownspin

		var price1 = $(this).data('init-price');
		var time1 = $(this).data('init-time');
		var componentQty = $(this).data('component-qty');

		var priceIncrement = $(this).data('price-increment');
		var timeIncrement = $(this).data('time-increment');

		//Price and Time Calculation
		//Formula: Price + (Quantity * Increment Amount)
		var priceIncrementAmount = (parseFloat(price1) * parseInt(priceIncrement)) / 100;
		var timeIncrementAmount = (parseFloat(time1) * parseInt(timeIncrement)) / 100;

		var qty = parseInt($(this).val()) - parseInt(componentQty);
		console.log(qty);
		//var qty = parseInt($(this).val()) -1;

		if(qty > 0){
			price2 = parseFloat(priceIncrementAmount) * qty;
			time2 = parseFloat(timeIncrementAmount) * qty;

			$(this).closest('tr').find('.showPrice').html(price2);
			$(this).closest('tr').find('.showTime').html(time2);

			//final price and time for process
			$(this).closest('tr').find('.get-price').val(price2);
			$(this).closest('tr').find('.get-time').val(time2);
		}else{
			$(this).closest('tr').find('.showPrice').html('0');
			$(this).closest('tr').find('.showTime').html('0');

			//final price and time for process
			$(this).closest('tr').find('.get-price').val(0);
			$(this).closest('tr').find('.get-time').val(0);
		}
	});

</script>
