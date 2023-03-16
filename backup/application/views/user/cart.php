<?php //if( ! $this->cart->contents()){ redirect(base_url()); } ?>

<main class="main-contents payment-page cart-page">
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

		<?php if($this->session->flashdata('error')){ ?>
            <div class="text-danger border-message valid-error">
                <strong><?= $this->lang->line('error'); ?></strong> <?= $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

		<?php if($this->session->flashdata('success')){ ?>
            <div class="text-success border-message valid-error">
                <strong><?= $this->lang->line('success'); ?></strong> <?= $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <?php //print_r($this->cart->contents()); ?>

		<div class="section-title">
			<h1>
				<?= $this->lang->line('cart_mycart'); ?>
				<span class="add-icon"></span>
			</h1>
		</div>
		<table class="cart-table" cellpadding="0" cellspacing="0">
			<thead>
				<th><?= $this->lang->line('cart_bundlename_li'); ?></th>
				<th><?= $this->lang->line('cart_items_li'); ?></th>
				<th><?= $this->lang->line('cart_description_li'); ?></th>
				<th><?= $this->lang->line('cart_adjustment_li'); ?></th>
			</thead>
			<?php if($this->cart->contents()): ?>
				<tbody>

					<?php
					$bundl_id = '';
					$isPackage = false;
					if($this->cart->contents()){
						foreach ($this->cart->contents() as $key => $value){
							if($value['options']['type'] == 'package'){
								$bundl_id = $value['id'];
								$isPackage = true;
							}
						}
					}

					if($isPackage == true):
					?>

					<tr>
						<td class="border-bottom-0">
							<div class="item">
								<h5><?= $this->session->userdata('project_name'); ?></h5>
								<?php 
								if($this->cart->contents()):
									foreach ($this->cart->contents() as $key => $value):
										if($value['options']['type'] == 'package'):
											?>
											<p class="date"><?= $value['name']; ?></p>
											<?php
										endif;
									endforeach;
								endif;
								?>
								<p class="date"><?= date('d/m/Y'); ?></p>
							</div>
						</td>
						<td colspan="3">
							<table class="inner-table empty-td">
								<tr>
									<td class="empty">&nbsp;</td>
									<td>
										<ul class="statics">
											<li>
												<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> 
												<?php 
												if($this->cart->contents()):
													foreach ($this->cart->contents() as $key => $value):
														if($value['options']['type'] == 'package'):
															echo preg_replace("/\.?0*$/",'',number_format( (float) $value['price'], 2, '.', ',')) .' '.  $this->lang->line('cart_sar');
														endif;
													endforeach;
												endif;
												?>
											</li>
											<li>
												<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt="">
												<?php 
												if($this->cart->contents()):
													foreach ($this->cart->contents() as $key => $value):
														if($value['options']['type'] == 'package'):
															echo $value['subtotal_time'] .' '. $this->lang->line('cart_days');
														endif;
													endforeach;
												endif;
												?>
											</li>
										</ul>
									</td>
									<td>
										<ul class="action-links">
											<!-- <li>
												<a href="#">
													<i class="fa fa-pencil"></i>
													edit
												</a>
											</li> -->
											<li>
												<a href="<?= base_url('cart-free'); ?>">
													<i class="fa fa-times"></i>
													<?= $this->lang->line('cart_discard'); ?>
												</a>
											</li>
										</ul>
									</td>
								</tr>

								<?php 
								$has_logo = false;
								if($this->cart->contents()){
									foreach ($this->cart->contents() as $key => $value){
										if($value['options']['type'] == 'logo'){
											$has_logo = true;
											break;
										}else{
											$has_logo = false;
										}
									}
								}
								if($has_logo):
								?>
								<tr>
									<td><?= $this->lang->line('cart_logo_identity'); ?></td>
									<td>
										<?php 
										if($this->cart->contents()):
											foreach ($this->cart->contents() as $key => $value):
												if($value['options']['type'] == 'logo'):
													if($value['name'] == 'both'){
														echo $this->lang->line('languages_both');
													}elseif($value['name'] == 'arabic'){
														echo $this->lang->line('languages_arabic');
													}elseif($value['name'] == 'english'){
														echo $this->lang->line('languages_english');
													}
												endif;
											endforeach;
										endif;
										?>

										<?php 
										if($this->cart->contents()):
											foreach ($this->cart->contents() as $key => $value):
												if($value['options']['type'] == 'logo' AND $value['name'] == 'both'):
													?>

													<ul class="statics brand">
														<li>
															<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= preg_replace("/\.?0*$/",'',number_format( (float) $value['price'], 2, '.', ',')); ?> <?= $this->lang->line('cart_sar'); ?>
														</li>
														<li>
															<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $this->cart->format_number($value['subtotal_time']); ?> <?= $this->lang->line('cart_days'); ?>
														</li>
													</ul>

													<?php
												endif;
											endforeach;
										endif;
										?>
									</td>
									<td class="empty">&nbsp;</td>
									</td>
								</tr>
								<?php endif; ?>

								<?php 
								if($this->cart->contents()):
									$cart_contents = $this->cart->contents();
									$named  = array_column($cart_contents, 'name');
									array_multisort($named, SORT_ASC, $cart_contents);
									foreach ($cart_contents as $key => $value):
										if($value['options']['type'] == 'design'):
										//print_r($value);
											/*if($value['price'] != 0):
												$value['qty'] += 1;
											endif;*/
											?>

											<tr>
												<td >
													- <?= $value['name']; ?>

												</td>
												<td>
													
													<!-- QTY: <span class="qty"><?= $value['qty']; ?></span> -->
													<!-- <i class="align-label"><?= $this->lang->line('cart_qty'); ?></i>
													<span class="qty" style="border: none;">
														<input type="text" name="designs[<?= $value['id']; ?>]" class="touchspin cartqty" value="<?= $value['qty']; ?>" readonly="">
													</span> -->

													<!-- <?php
													if(isset($value['options']['measurement_type']) && 
													   isset($value['options']['measurement_value']) &&
													   ($value['options']['measurement_type'] != 'quantity')):
													?>

													<ul class="option-list">
														<?php if($value['options']['measurement_type'] == 'side'): ?>
															<li>SIDE:</li>
															<li>
																<select name="mtype" class="selectpicker metrisi-type cartmtype">
																	<option value="one-side" <?= ($value['options']['measurement_value'] == 'one-side') ? 'selected' : ''; ?>>One-side</option>
																	<option value="two-side" <?= ($value['options']['measurement_value'] == 'two-side') ? 'selected' : ''; ?>>Two-side</option>
																	<option value="three-side" <?= ($value['options']['measurement_value'] == 'three-side') ? 'selected' : ''; ?>>Three-side</option>
																</select>
															</li>
														<?php endif; ?>

														<?php if($value['options']['measurement_type'] == 'fold'): ?>
															<li>FOLD:</li>
															<li>
																<select name="mtype" class="selectpicker metrisi-type cartmtype">
																	<option value="mono-fold" <?= ($value['options']['measurement_value'] == 'mono-fold') ? 'selected' : ''; ?>>Mono-fold</option>
																	<option value="bi-fold" <?= ($value['options']['measurement_value'] == 'bi-fold') ? 'selected' : ''; ?>>Bi-fold</option>
																	<option value="tri-fold" <?= ($value['options']['measurement_value'] == 'tri-fold') ? 'selected' : ''; ?>>Tri-fold</option>
																</select>
															</li>
														<?php endif; ?>

														<?php if($value['options']['measurement_type'] == 'page'): ?>

															<li>PAGES:</li>
															<li>
																<div class="input-group plus-minus-input">
								                                    <a href="javascript:void(0)" class="btn page_dec_btn" data-field="quantity">
								                                    	-
								                                    </a>
								                                    <input class="form-control input-group-field page_range cartmtype" type="text" value="<?= $value['options']['measurement_value']; ?>" name="mtype" data-preval="1" readonly>
								                                    <a href="javascript:void(0)" class="btn page_inc_btn" data-field="quantity">
								                                    	+
								                                    </a>
								                                </div>
															</li>
														<?php endif; ?>
													</ul>

													<?php endif; ?> -->

													<!-- <?php
													if($value['options']['roll_no'] > 1):
														?>
														<ul class="statics brand">
															<li>
																<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= $value['subtotal']; ?><?= $this->lang->line('cart_sar'); ?>
															</li>
															<li>
																<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $value['subtotal_time']; ?> <span><?= $this->lang->line('cart_days'); ?></span>
															</li>
														</ul>
														<?php
													endif;
													?> -->

													<ul class="action-links" style="display: inline-block;" >
														<li>
															<a href="#" data-rowid="<?= $value['rowid']; ?>" 
																data-new-val="<?= $value['id']; ?>"
																data-id="<?= $value['id']; ?>"
																data-cartmvalue="<?= $value['options']['measurement_value']; ?>" 
																data-carttime="<?= $value['subtotal_time']; ?>"  
																data-itemtype="addon"  
																class="cartival">
																<i class="fa fa-plus"></i>
																<?= $this->lang->line('cart_update'); ?>
															</a>
														</li>
													</ul>

												</td>
												<!-- <td class="empty">&nbsp;</td> -->
												<td>
													<ul class="action-links">
														<!-- <li>
															<a href="#" data-rowid="<?= $value['rowid']; ?>" 
																data-id="<?= $value['id']; ?>" 	
																data-cartmvalue="<?= $value['options']['measurement_value']; ?>" 
																data-carttime="<?= $value['subtotal_time']; ?>"  
																data-itemtype="addon"  
																class="cartival">
																<i class="fa fa-plus"></i>
																<?= $this->lang->line('cart_update'); ?>
															</a>
														</li> -->
														<!-- <li>
															<a href="<?= base_url('remove-cart/') . $value['rowid']; ?>">
																<i class="fa fa-times"></i>
																<?= $this->lang->line('cart_delete'); ?>
															</a>
														</li> -->
													</ul>
												</td>
												</td>
											</tr>

											<?php
										endif;
									endforeach;
								endif;
								?>
							</table>
						</td>
					</tr>

					<?php endif; ?>

					<?php
					$isAdjustment = false;
					if($this->cart->contents()){
						foreach ($this->cart->contents() as $key => $value){
							if($value['options']['type'] == 'adjustment'){
								$isAdjustment = true;
							}
						}
					}

					if($isAdjustment == true):
					?>

					<tr>
						<td>
							<div class="item">
								<h5><?= $this->session->userdata('project_name'); ?></h5>
								<p class="date"><?= $this->lang->line('cart_adjustment'); ?></p>
								<p class="date"><?= date('d/m/Y'); ?></p>
							</div>
						</td>
						<td colspan="3">
							<table class="inner-table">

								<?php 
								if($this->cart->contents()):
									//print_r($this->cart->contents());
									foreach ($this->cart->contents() as $key => $value):
										if($value['options']['type'] == 'adjustment'):
											$design_name = $this->db->get_where('order_items', ['id' => $value['options']['item_id']])->row_array();
											if($design_name['item_type'] == 'logo'){
												$adj_itm_name = $this->lang->line('logo').' ('.$design_name['item_name'].')';
											}else{
												$adj_itm_name = $design_name['item_name'];
											}
											?>

											<tr>
												<td> - <?= $value['name'].' '.$this->lang->line('of') .' '.$adj_itm_name . ''; ?></td>
												<td>
													<!-- <?php //echo $this->lang->line('cart_qty'); ?> <span class="qty"><?= $value['qty']; ?></span> -->
													<!-- <i class="align-label">QTY:</i> <span class="qty" style="border: none;"><input type="text" name="adj[<?= $value['id']; ?>]" class="touchspin cartqty" value="<?= $value['qty']; ?>" readonly=""></span> -->
													
													
													<ul class="statics brand">
														<li>
															<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= $this->cart->format_number($value['subtotal']); ?> <?= $this->lang->line('cart_sar'); ?>
														</li>
														<li>
															<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $this->cart->format_number($value['subtotal_time']); ?> <?= $this->lang->line('cart_days'); ?>
														</li>
													</ul>
												</td>
												<td>
													<ul class="action-links">
														<!-- <li>
															<a href="#" data-rowid="<?= $value['rowid']; ?>" data-id="<?= $value['id']; ?>" class="cartaddon">
																<i class="fa fa-pencil"></i>
																update
															</a>
														</li> -->
														<li>
															<a href="<?= base_url('remove-cart/') . $value['rowid']; ?>">
																<i class="fa fa-times"></i>
																<?= $this->lang->line('cart_delete'); ?>
															</a>
														</li>
													</ul>
												</td>
											</tr>

											<?php
										endif;
									endforeach;
								endif;
								?>
							</table>
						</td>
					</tr>

					<?php endif; ?>

					<?php
					$isAddon = false;
					if($this->cart->contents()){
						foreach ($this->cart->contents() as $key => $value){
							if( in_array($value['options']['type'], ['addon', 'custom_addon']) ){
								$isAddon = true;
							}
						}
					}

					if($isAddon == true):
					?>
						<tr>
							<td>
								<div class="item">
									<h5><?= $this->session->userdata('project_name'); ?></h5>
									<p class="date"><?= $this->lang->line('cart_addone'); ?></p>
									<p class="date"><?= date('d/m/Y'); ?></p>
								</div>
							</td>
							<td colspan="3">
								<!-- <table class="inner-table">
									<?php 
									/*if($this->cart->contents()):
										$cart_contents = $this->cart->contents();
										$named  = array_column($cart_contents, 'name');
										array_multisort($named, SORT_ASC, $cart_contents);
										
										foreach ($cart_contents as $key => $value):
											if( in_array($value['options']['type'], ['addon', 'custom_addon']) ): 
												
												?>

												<tr>
													<td>- <?= $value['name']; ?></td>
													<td>
														<?php
														if(isset($value['options']['measurement_type']) && 
														   isset($value['options']['measurement_value']) &&
														   ($value['options']['measurement_type'] != 'quantity')):
														?>

														<ul class="option-list">
															<?php if($value['options']['measurement_type'] == 'side'): ?>
																<li>SIDE:</li>
																<li>
																	<select name="mtype" class="selectpicker metrisi-type cartmtype">
																		<option value="one-side" <?= ($value['options']['measurement_value'] == 'one-side') ? 'selected' : ''; ?>>One-side</option>
																		<option value="two-side" <?= ($value['options']['measurement_value'] == 'two-side') ? 'selected' : ''; ?>>Two-side</option>
																		<option value="three-side" <?= ($value['options']['measurement_value'] == 'three-side') ? 'selected' : ''; ?>>Three-side</option>
																	</select>
																</li>
															<?php endif; ?>

															<?php if($value['options']['measurement_type'] == 'fold'): ?>
																<li>FOLD:</li>
																<li>
																	<select name="mtype" class="selectpicker metrisi-type cartmtype">
																		<option value="mono-fold" <?= ($value['options']['measurement_value'] == 'mono-fold') ? 'selected' : ''; ?>>Mono-fold</option>
																		<option value="bi-fold" <?= ($value['options']['measurement_value'] == 'bi-fold') ? 'selected' : ''; ?>>Bi-fold</option>
																		<option value="tri-fold" <?= ($value['options']['measurement_value'] == 'tri-fold') ? 'selected' : ''; ?>>Tri-fold</option>
																	</select>
																</li>
															<?php endif; ?>

															<?php if($value['options']['measurement_type'] == 'page'): ?>
																<li>PAGES:</li>
																<li>
																	<div class="input-group plus-minus-input">
									                                    <a href="javascript:void(0)" class="btn page_dec_btn" data-field="quantity">
									                                    	-
									                                    </a>
									                                    <input class="form-control input-group-field page_range cartmtype" type="text" value="<?= $value['options']['measurement_value']; ?>" name="mtype" data-preval="1" readonly>
									                                    <a href="javascript:void(0)" class="btn page_inc_btn" data-field="quantity">
									                                    	+
									                                    </a>
									                                </div>
																</li>
															<?php endif; ?>

															</ul>

														<?php endif; ?>

														<ul class="statics brand">
															<li>
																<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= $value['subtotal']; ?> <?= $this->lang->line('cart_sar'); ?>
															</li>
															<li>
																<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $value['subtotal_time']; ?> <span> <?= $this->lang->line('cart_days'); ?></span>
															</li>
														</ul>
													</td>
													<td>
														<ul class="action-links">
															<li>
																<a href="#" data-rowid="<?= $value['rowid']; ?>" 
																	data-id="<?= $value['id']; ?>"
																	data-cartmvalue="<?= $value['options']['measurement_value']; ?>" 
																	data-carttime="<?= $value['subtotal_time']; ?>" 
																	data-itemtype="addon" 
																	class="cartival">
																	<i class="fa fa-plus"></i>
																	<?= $this->lang->line('cart_update'); ?>
																</a>
															</li>
															<li>
																<a href="<?= base_url('remove-cart/') . $value['rowid']; ?>">
																	<i class="fa fa-times"></i>
																	<?= $this->lang->line('cart_delete'); ?>
																</a>
															</li>
														</ul>
													</td>
												</tr>

												<?php
											endif;
										endforeach;
									endif;*/
									?>
								</table> -->
								<table id="yoyo" class="cart-items inner-table">
									<tbody>
										<?php
										if($this->cart->contents()):
											$cart_contents = $this->cart->contents();
											$item_counts = array_count_values(array_column($cart_contents, 'id'));
											//print_r($item_counts);
											
											// for qty = 1
											foreach ($cart_contents as $row_id => $item) {
												if( in_array($item['options']['type'], ['addon', 'custom_addon'])){
													//echo $item['id'].':';
													//echo $item_counts[$item['id']].'<br>';
													if($item_counts[$item['id']] == 1){ ?>

														<!-- tr without group -->
														<tr>
															<td class="name" ><?= $item['name']; ?></td>
															<td>
																<ul class="statics brand">
																	<li>
																		<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> <?= preg_replace("/\.?0*$/",'',number_format( (float) $item['price'], 2, '.', ',')); ?> <?= $this->lang->line('cart_sar'); ?>															</li>
																	<li>
																		<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $this->cart->format_number($item['subtotal_time']); ?> <?= $this->lang->line('cart_days'); ?>
																	</li>
																</ul>
															</td>
															<td>
																<ul class="action-links">
																	<li>
																		<a href="#" data-rowid="<?= $item['rowid']; ?>" 
																			data-new-val="<?= $item['id']; ?>"
																			data-id="<?= $item['id']; ?>"
																			data-cartmvalue="<?= $item['options']['measurement_value']; ?>" 
																			data-carttime="<?= $item['subtotal_time']; ?>" 
																			data-itemtype="addon" 
																			class="cartival">
																			<i class="fa fa-plus"></i>
																			<?= $this->lang->line('cart_update'); ?>
																		</a>
																	</li>
																	<li>
																		<!-- <a href="<?= base_url('remove-cart/') . $item['rowid']; ?>">
																			<i class="fa fa-times"></i>
																			<?= $this->lang->line('cart_delete'); ?>
																		</a> -->
																		<a href="#" class="removesingle" data-rowid="<?= $item['rowid']; ?>" id="<?= $item['rowid'] ?>">
																			<i class="fa fa-times"></i>
																			<?= $this->lang->line('cart_delete'); ?>
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
													<?php }
												}
											}

											//for qty > 1
											$item_ids = [];
											foreach ($cart_contents as $row_id => $item) {
												if( in_array($item['options']['type'], ['addon', 'custom_addon'])){
													array_push($item_ids, $item['id']);
												}
											}
											$item_ids = array_unique($item_ids);

											foreach ($item_ids as $key => $item_id) {
												if($item_counts[$item_id] > 1){
													$design = $this->db->get_where('designs', ['id' => $item_id])->row_array();
													?>
													<!-- tr with group -->
													<tr class="has-child" id="alltr_<?= $item_id; ?>">
														<td class="name" ><?= $design['name_'.$language]; ?></td>
														<td></td>
														<td>
															<?php if (!(isset($bundl_id) && !empty($bundl_id))) { ?>
																<ul class="action-links">
																	<li>
																		<a href="#" class="removetivaljd links-align" data-rowid="<?= $item_id; ?>" id="<?= $item_id; ?>">
																			<i class="fa fa-times"></i>
																			<?= $this->lang->line('cart_delete'); ?>
																		</a>
																	</li>
																</ul>
															<?php } ?>
														</td>
													</tr>
													<tr class="sub-menu">
														<td colspan="3">
															<table id="bi_<?= $item_id; ?>">
																<tbody>
																	<?php 
																	$x = 0;
																	foreach ($cart_contents as $row => $value) {
																		$x++;
																		if( ($value['id'] == $item_id) && (in_array($value['options']['type'], ['addon', 'custom_addon'])) ){
																		?>
																			<tr>
																				<td class="name" >- <?= $value['name']; ?></td>
																				<td>
																					<ul class="statics brand">
																						<li>
																							<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= preg_replace("/\.?0*$/",'',number_format( (float) $value['price'], 2, '.', ',')); ?> <?= $this->lang->line('cart_sar'); ?>	
																						</li>
																						<li>
																							<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $this->cart->format_number($value['subtotal_time']); ?> <?= $this->lang->line('cart_days'); ?>
																						</li>
																					</ul>
																				</td>
																				<td>
																					<ul class="action-links">
																						<li>
																							<a href="#" data-rowid="<?= $value['rowid']; ?>" 
																								data-new-val="<?= $item_id; ?>"
																								data-id="<?= $value['id']; ?>"
																								data-cartmvalue="<?= $value['options']['measurement_value']; ?>" 
																								data-carttime="<?= $value['subtotal_time']; ?>" 
																								data-itemtype="addon" 
																								class="cartival">
																								<i class="fa fa-plus"></i>
																								<?= $this->lang->line('cart_update'); ?>
																							</a>
																						</li>
																						<li>
																							<!-- <a href="<?= base_url('remove-cart/') . $value['rowid']; ?>">
																								<i class="fa fa-times"></i>
																								<?= $this->lang->line('cart_delete'); ?>
																							</a> -->
																						<?php if ($value['price']) { ?>
																							<a href="#" class="removetival" data-rowid="<?= $value['rowid']; ?>" id="<?= $value['rowid'] ?>">
																								<i class="fa fa-times"></i>
																								<?= $this->lang->line('cart_delete'); ?>
																							</a>
																						<?php } else { ?>
																							<a style="visibility: hidden;" href="#" class="removetival" data-rowid="<?= $value['rowid']; ?>" id="<?= $value['rowid'] ?>">
																								<i class="fa fa-times"></i>
																								<?= $this->lang->line('cart_delete'); ?>
																							</a>
																						<?php } ?>

																						</li>
																					</ul>
																				</td>
																			</tr>
																		<?php }  ?>
																	<?php }  ?>
																</tbody>
															</table>
														</td>
													</tr>
													<?php
												}
											}
										endif;
										?>
										<!-- tr with group -->
										<!-- <tr class="has-child">
											<td class="name" >- A4 Envelope</td>
											<td>
												<ul class="statics brand">
													<li>
														<img src="http://bundl_new/assets_user/images/glyph-database.png" alt=""> +450 SAR															</li>
													<li>
														<img src="http://bundl_new/assets_user/images/glyph-stopwatch.png" alt=""> 36 <span> days</span>
													</li>
												</ul>
											</td>
											<td>
												<ul class="action-links">
													<li>
														<a href="#" data-rowid="774fc94668126432ef6671ad3434fab9" data-id="59" data-cartmvalue="7" data-carttime="36" data-itemtype="addon" class="cartival">
															<i class="fa fa-plus"></i>
															add
														</a>
													</li>
													<li>
														<a href="http://bundl_new/remove-cart/774fc94668126432ef6671ad3434fab9">
															<i class="fa fa-times"></i>
															delete
														</a>
													</li>
												</ul>
											</td>
										</tr>
										<tr class="sub-menu">
											<td colspan="3">
												<table>
													<tbody>
														<tr>
															<td class="name" >- A4 Envelope 1</td>
															<td>
																<ul class="statics brand">
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-database.png" alt=""> +450 SAR															</li>
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-stopwatch.png" alt=""> 36 <span> days</span>
																	</li>
																</ul>
															</td>
															<td>
																<ul class="action-links">
																	<li>
																		<a href="#" data-rowid="774fc94668126432ef6671ad3434fab9" data-id="59" data-cartmvalue="7" data-carttime="36" data-itemtype="addon" class="cartival">
																			<i class="fa fa-plus"></i>
																			add
																		</a>
																	</li>
																	<li>
																		<a href="http://bundl_new/remove-cart/774fc94668126432ef6671ad3434fab9">
																			<i class="fa fa-times"></i>
																			delete
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<td class="name" >- A4 Envelope 1</td>
															<td>
																<ul class="statics brand">
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-database.png" alt=""> +450 SAR															</li>
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-stopwatch.png" alt=""> 36 <span> days</span>
																	</li>
																</ul>
															</td>
															<td>
																<ul class="action-links">
																	<li>
																		<a href="#" data-rowid="774fc94668126432ef6671ad3434fab9" data-id="59" data-cartmvalue="7" data-carttime="36" data-itemtype="addon" class="cartival">
																			<i class="fa fa-plus"></i>
																			add
																		</a>
																	</li>
																	<li>
																		<a href="http://bundl_new/remove-cart/774fc94668126432ef6671ad3434fab9">
																			<i class="fa fa-times"></i>
																			delete
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<td class="name" >- A4 Envelope 1</td>
															<td>
																<ul class="statics brand">
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-database.png" alt=""> +450 SAR															</li>
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-stopwatch.png" alt=""> 36 <span> days</span>
																	</li>
																</ul>
															</td>
															<td>
																<ul class="action-links">
																	<li>
																		<a href="#" data-rowid="774fc94668126432ef6671ad3434fab9" data-id="59" data-cartmvalue="7" data-carttime="36" data-itemtype="addon" class="cartival">
																			<i class="fa fa-plus"></i>
																			add
																		</a>
																	</li>
																	<li>
																		<a href="http://bundl_new/remove-cart/774fc94668126432ef6671ad3434fab9">
																			<i class="fa fa-times"></i>
																			delete
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
														<tr>
															<td class="name" >- A4 Envelope 1</td>
															<td>
																<ul class="statics brand">
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-database.png" alt=""> +450 SAR															</li>
																	<li>
																		<img src="http://bundl_new/assets_user/images/glyph-stopwatch.png" alt=""> 36 <span> days</span>
																	</li>
																</ul>
															</td>
															<td>
																<ul class="action-links">
																	<li>
																		<a href="#" data-rowid="774fc94668126432ef6671ad3434fab9" data-id="59" data-cartmvalue="7" data-carttime="36" data-itemtype="addon" class="cartival">
																			<i class="fa fa-plus"></i>
																			add
																		</a>
																	</li>
																	<li>
																		<a href="http://bundl_new/remove-cart/774fc94668126432ef6671ad3434fab9">
																			<i class="fa fa-times"></i>
																			delete
																		</a>
																	</li>
																</ul>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr> -->
										
										
										
									</tbody>
								</table>
							</td>
						</tr>

					<?php endif; ?>
					
				</tbody>	
			<?php endif; ?>
		</table>

		<?php if( ! $this->cart->contents()){ ?>
		  <div class="alert alert-danger alert-dismissible text-purple">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <?= $this->lang->line('empty_cart'); ?>
		  </div>

			<div class="button-row">
				<a href="<?= base_url(); ?>" class="process-link">< <?= $this->lang->line('go_back'); ?> ></a>
			</div>
			<br />

		<?php } ?>

		<?php if($this->cart->contents()): ?>
			<div id="here" class="proceed-cart">
				<div class="grand-total">
					<h2>
						<span><?= $this->lang->line('sidebar_total_text'); ?></span> <?= $this->cart->format_number($this->cart->total()); ?> <?= $this->lang->line('cart_sar'); ?>
					</h2>
					<h3>
						<span><?= $this->lang->line('cart_duration'); ?></span> 
						<?php 
						if($this->cart->contents()):
							$total_time = 0;
							foreach ($this->cart->contents() as $row_id => $item):
								$total_time += $item['subtotal_time'];
							endforeach;
							echo $this->cart->format_number($total_time);
						else:
							echo 0;
						endif;
						?>
						<small><?= $this->lang->line('cart_working_days'); ?></small>
					</h3>
				</div>
				<?php if($this->cart->contents()): ?>
					<div class="button-row">
						<a href="<?= base_url('checkout'); ?>" id="checkout" class="btn btn-default"><?=$this->lang->line('cart_checkout_text'); ?></a>
					</div>
				<?php endif; ?>
				<br />
				<div class="button-row">
					<a href="<?= base_url('cart-free'); ?>" id="checkout" class="process-link">< <?=$this->lang->line('empty_cart'); ?> ></a>
				</div>
				<div style="margin-top: 15px" class="button-row">
					<a href="<?= (isset($bundl_id) && !empty($bundl_id)) ? base_url('select/').$bundl_id : base_url('custom'); ?>" class="process-link">< <?= $this->lang->line('go_back'); ?> ></a>
				</div>
			</div>
		<?php endif; ?>

	</div>
</main>

<script type="text/javascript">

	$(document).on('click','.cartival', function(event){
		event.preventDefault();

		var rowid = $(this).data('rowid');
		var id = $(this).data('id');
		var qty = $(this).closest('tr').find('.cartqty').val();
		var ctime = $(this).data('carttime');
		var mtype = $(this).data('cartmvalue');
		var itemtype = $(this).data('itemtype');
		var the_id = $(this).data('new-val');

		// var str_jd = $('#bi_'+the_id+' tbody tr:last').children('td:first').text();
		// console.log(str_jd.slice(-2).trim());

		// $('#yoyo tr:last').clone(true).appendTo('#yoyo');
		// return false;

		var urlll = '<?= base_url(); ?>';
		$.ajax({
			type: 'post',
			url: '<?= base_url('update-cart'); ?>',
			data: {'rowid': rowid, 'qty': qty, 'id': id, 'mtype': mtype, 'time': ctime, 'itemtype': itemtype},
			success: function(response){
				var data = $.parseJSON(response);
				console.log(data);
				// location.reload();
				// <a href="'+urlll+'remove-cart/'+data.new_row_id+'"><i class="fa fa-times"></i>delete</a>
				if (data.msg == 'true') {
					if ($('#bi_'+the_id+' tbody tr:first').index() == -1) {
						console.log('llll');
						var table = document.getElementById("yoyo");
						var maxlen = table.tBodies[0].rows.length;
						var minlen = $('#yoyo tbody tr.has-child').length;
						var reqlen = maxlen - minlen;
						var nRow = '<tr class="has-child"><td class="name">'+data.item.name+'</td><td></td><td></td></tr><tr class="sub-menu" style="display: none"><td colspan="3"><table id="bi_'+the_id+'"><tbody><tr><td class="name">- '+data.item.name+'</td><td><ul class="statics brand"><li><img src="'+urlll+'assets_user/images/glyph-database.png" alt=""> +'+data.item.price_sar+' <?= $this->lang->line('cart_sar'); ?></li><li><img src="'+urlll+'assets_user/images/glyph-stopwatch.png"alt=""> '+data.item.subtotal_time+'  <?= $this->lang->line('cart_days'); ?></li></ul></td><td><ul class="action-links"><li><a href="javascript:void(0)" data-rowid="'+data.new_row_id+'" data-new-val="'+data.item.id+'" data-id="'+data.item.id+'" data-cartmvalue="'+data.item.options.measurement_value+'" data-carttime="'+data.item.subtotal_time+'" data-itemtype="addon" class="cartival"><i class="fa fa-plus"></i>add</a></li><li><a href="#" class="removetival" data-rowid="'+data.new_row_id+'"><i class="fa fa-times"></i><?= $this->lang->line('cart_delete'); ?></a></li></ul></td></tr></tbody></table></td></tr>'
						// $('#yoyo tbody tr:last').append(nRow);
						$('#yoyo > tbody > tr').eq(reqlen).after(nRow);
					} else {
						var newRow = '<tr><td class="name">- '+data.item.name+'</td><td><ul class="statics brand"><li><img src="'+urlll+'assets_user/images/glyph-database.png" alt=""> +'+data.item.price_sar+' <?= $this->lang->line('cart_sar'); ?></li><li><img src="'+urlll+'assets_user/images/glyph-stopwatch.png"alt=""> '+data.item.subtotal_time+'  <?= $this->lang->line('cart_days'); ?></li></ul></td><td><ul class="action-links"><li><a href="javascript:void(0)" data-rowid="'+data.new_row_id+'" data-new-val="'+data.item.id+'" data-id="'+data.item.id+'" data-cartmvalue="'+data.item.options.measurement_value+'" data-carttime="'+data.item.subtotal_time+'" data-itemtype="addon" class="cartival"><i class="fa fa-plus"></i>add</a></li><li><a href="#" class="removetival" data-rowid="'+data.new_row_id+'"><i class="fa fa-times"></i><?= $this->lang->line('cart_delete'); ?></a></li></ul></td></tr>';
						$('#bi_'+the_id+' tbody tr:last').after(newRow);
					}
				}else{
					console.log('gal wad gai aae');
				}
			}
		});
	});

	$(document).on('click','.removesingle', function(event){
		event.preventDefault();

		var rowid = $(this).data('rowid');
		var urll = '<?= base_url('remove-cart'); ?>'; 

		$.ajax({
			type: 'get',
			url: urll+'/'+rowid,
			success: function(response){
				if (response) {
					location.reload();
				}
			}
		});
	});

	$(document).on('click','.removetival', function(event){
		event.preventDefault();

		var tableId = $(event.target).closest('table').attr('id');
		var trIndex = $(event.target).closest('tr').index();
		var rowid = $(this).data('rowid');

		var urll = '<?= base_url('remove-cart'); ?>'; 

		var firsttr = $('#'+tableId).find('tr').eq(trIndex).find('td:eq(0)').text().replace(/[0-9]/g, '');

		if ($('#'+tableId+' tr').length == 1) {

		} else {
			$('#'+tableId+' > tbody  > tr').each(function(index, tr) { 
			   if ($(tr).find('td:eq(0)').text().replace(/[0-9]/g, '') == firsttr) {
			   	trIndex = index;
			   	rowid = $(tr).find('td:eq(2)').find('a').data('rowid');
			   }
			});
		}

		$.ajax({
			type: 'get',
			url: urll+'/'+rowid,
			success: function(response){
				$( "#here" ).load(window.location.href + " #here" );
				if (response) {
					if ($('#'+tableId+' tr').length == 1) {
						var yoyo = $('#'+tableId).parent().parent().index() - 1;
						document.getElementById('yoyo').deleteRow(yoyo);
						document.getElementById('yoyo').deleteRow(yoyo);
					} else {
						document.getElementById(tableId).deleteRow(trIndex);
					}
				}
			}
		});
	});

	$(document).on('click','.removetivaljd', function(event){
		event.preventDefault();

		var urllremove = '<?= base_url('remove-cart-jd'); ?>';
		var rowidremove = $(this).data('rowid');
		var bibi = 'alltr_'+rowidremove;

		$('#'+bibi).next('tr').remove();
		$('#'+bibi).remove();

		$.ajax({
			type: 'get',
			url: urllremove+'/'+rowidremove,
			success: function(response){
				$( "#here" ).load(window.location.href + " #here" );
				if (response) {
					console.log(response);
				}
			}
		});
	});

</script>