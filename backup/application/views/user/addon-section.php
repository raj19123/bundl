<?php //if($this->cart->contents()) { $this->cart->destroy(); } ?>

<?php
$select_cat = 1;
if(isset($_GET['search'])){
	$design_id = $_GET['search'];
	// get category info
	$design_detail = $this->db->get_where('designs',['id' => $design_id]);
	if($design_detail->num_rows() > 0){
		$design_detail = $design_detail->row_array();
		$select_cat = $design_detail['category_id'];
	}
}else{
	$design_id = '';
}

if(isset($_GET['web'])){
	// get category info
	$cat = $this->db->get_where('design_categories',['slug' => 'web-development']);
	if($cat->num_rows() > 0){
		$cat = $cat->row_array();
		$select_cat = $cat['id'];
	}
}
?>

<div id="addons1" class="section-title sm">
	<h1>
		<?= $this->lang->line('sidebar_addone'); ?>
		
		<span class="add-icon"></span>
	</h1>
</div>

<div id="addons2" class="add-bundls info-tabs">
	<div class="custom-dropdown">
		
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<?php 
			if(isset($addons_cats)):
				foreach ($addons_cats as $key => $cat):
					$i = $cat['id'];
					$addon_icon = $this->db->get_where('files',['id' => $cat['design_icon_id']])->row_array();	
				?>
				  	<li class="nav-item">
				    	<a class="nav-link <?= ($i == $select_cat) ? 'active show' : ''; ?>"
				    		id="<?= $cat['slug'] . '1'; ?>" 
				    		data-toggle="tab" 
				    		href="#<?= $cat['slug']; ?>" 
				    		role="tab" 
				    		aria-controls="<?= $cat['slug']; ?>" 
				    		aria-selected="<?= ($i == $select_cat) ? 'true' : 'false'; ?>">
				    		<figure>
				    			<span>
					    			<img src="<?= base_url('uploads/icons/') . $addon_icon['name']; ?>" alt="*">
					    		</span>
				    		</figure>
					    	<span class="text" ><?= $cat['name_'.$language]; ?></span>
					    </a>
				  	</li>
				<?php 
				endforeach; 
			endif; 
			?>
		</ul>
	</div>

	<div class="tab-content" id="myTabContent">

		<?php if(isset($addons_cats)): foreach ($addons_cats as $key => $cat): $i = $cat['id']; ?>
			
	 	<div class="tab-pane fade <?= ($i == $select_cat) ? 'show active' : ''; ?>" id="<?= $cat['slug']; ?>" role="tabpanel" aria-labelledby="<?= $cat['slug'] . '1'; ?>">
	 		<h5><?= $this->lang->line('addon_addquantity'); ?></h5>
	 		<table class="payment-table responsive-view" cellpadding="0" cellspacing="0">
				<tbody>
					<?php 
					$addons = $this->db->get_where('designs', ['category_id' => $cat['id'], 'status' => 1])->result_array();
					if(count($addons) > 0):
						foreach ($addons as $k => $addon):
						?>
					<tr <?= ($i==$select_cat && $addon['id']==$design_id) ? 'class="green-row"' : ''; ?> >
						<td><?= $addon['name_'.$language]; ?></td>
						<td>
							<ul class="statics brand <?= ($addon['id']==76) ? 'logo-lang-class' : ''; ?>">
								<li>
									<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> 
									<i class="i-tag">+&nbsp;</i><div class="showPrice">&nbsp;<?= $addon['price']; ?></div> <span> <?= $this->lang->line('sar'); ?></span>
								</li>
								<li>
									<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> 
									<div class="showTime"><?= $addon['time']; ?></div> <span> <?= $this->lang->line('day'); ?></span>
								</li>
							</ul>
							
						</td>

						<td>
							<form class="<?= ($addon['id'] == 76) ? 'form-flex' : ''; ?>">
								<input type="hidden" name="addonid" value="<?= $addon['id']; ?>" />
								<input type="hidden" name="order_id" value="<?= isset($item['order_id']) ? $item['order_id'] : ''; ?>" />
								<input type="hidden" name="price" value="<?= $addon['price']; ?>">
								<input type="hidden" name="init_price" value="<?= $addon['price']; ?>">
								<input type="hidden" name="time" value="<?= $addon['time']; ?>">
								<input type="hidden" name="init_time" value="<?= $addon['time']; ?>">
								<input type="hidden" name="priceIncrement" value="<?= $addon['price_increment']; ?>">
								<input type="hidden" name="timeIncrement" value="<?= $addon['time_increment']; ?>">

							<?php if ($addon['id'] == 76) { ?>
								<ul class="h-list">
									<li>
										<div class="radio">
											<label>
												<input type="radio" 
													name="logo" 
													value="arabic"
													class="logo_language logo_lang_single">
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
													checked="checked"
													class="logo_language logo_lang_single">
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
													class="logo_language logo_lang_both"> 
												<span><?= $this->lang->line('both'); ?></span>
											</label>
										</div>
									</li>
								</ul>
							<?php } ?>
							<ul class="h-list justify-end">

							<?php if($addon['type'] == 'side'): ?>
								<li class=""><?= $this->lang->line('addon_side'); ?></li>
								<li>
									<select name="mtype" class="selectpicker metrisi-type page-change">
										<option value="one-side"><?= $this->lang->line('oneside'); ?></option>
										<option value="two-side"><?= $this->lang->line('twoside'); ?></option>
										<!-- <option value="three-side"><?= $this->lang->line('threeside'); ?></option> -->
									</select>
								</li>
							<?php endif; ?>

							<?php if($addon['type'] == 'fold'): ?>
								<li><?= $this->lang->line('addon_fold'); ?></li>
								<li>
									<select name="mtype" class="selectpicker metrisi-type fold-change">
										<option value="mono-fold"><?= $this->lang->line('monofold'); ?></option>
										<option value="bi-fold"><?= $this->lang->line('bifold'); ?></option>
										<option value="tri-fold"><?= $this->lang->line('trifold'); ?></option>
									</select>
								</li>
							<?php endif; ?>

							<?php if($addon['type'] == 'page'): ?>
								<li class="text-label"><?= $this->lang->line('addon_pages'); ?></li>
								<li>
									<div class="input-group plus-minus-input">
	                                    <a href="javascript:void(0)" class="btn page_dec_btn" data-field="quantity">
	                                    	-
	                                    </a>
	                                    <input class="form-control input-group-field page_range" 
	                                    	type="text" 
	                                    	name="mtype" 
	                                    	value="1 - 10" 
	                                    	data-preval="1" readonly>

	                                    <a href="javascript:void(0)" class="btn page_inc_btn" data-field="quantity">
	                                    	+
	                                    </a>
	                                
	                                </div>
								</li>
							<?php endif; ?>

								<li>
									<button data-addon="<?= $addon['id']; ?>" 
										class="add-cart addons-to-cart">
										<i class="fa fa-plus"></i>
									</button>
								</li>
							</ul>
							</form>
						</td>
					
					</tr>
					<?php endforeach; 
					endif; ?>
				</tbody>
			</table>
	  	</div>
		<?php endforeach; endif; ?>
	</div>	
</div>

<script type="text/javascript">
	$('.addons-to-cart').on('click', function(event){
		event.preventDefault();

		var form = $(this).closest('form').serializeArray();
		//console.log(form);

		if($('#slc-bundl').length > 0){
			//console.log($('#slc-bundl').length);
			var selector = $('#slc-bundl');
			var odid = selector.val();
			if( ! odid){
				selector.focus();
				selector.parents('.form-group')
					.find('.valid-error')
					.html('<?= $this->lang->line('this_value_is_required'); ?>')
					.addClass('text-danger')
					.show()
					.fadeOut(10000);
				return false;
			}
			selector.attr('disabled',true);
			$('.selectpicker').selectpicker('refresh');
			// Find and replace `order_id` if there
			for (index = 0; index < form.length; ++index) {
			    if (form[index].name == "order_id") {
			        form[index].value = odid;
			        break;
			    }
			}

			/*form.push({
		        name: "order_id",
		        value: odid
		    });*/
		}

		if($('#custom-bundl').length > 0){
			var e = $('#custom-bundl');
			if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
                e.focus()
                	.parent()
                	.find('.valid-error')
                	.html('<?= $this->lang->line('this_value_is_required'); ?>')
                	.addClass('text-danger')
                	.show()
                	.fadeOut(10000);
            	return false;
            }
            //console.log(e.val());
            form.push({
		        name: "project_name",
		        value: e.val()
		    });
		}
		

		// Add it if it wasn't there
		/*if (index >= values.length) {
		    values.push({
		        name: "order_id",
		        value: value
		    });
		}*/
		console.log(form);
		$.ajax({
			type: 'post',
			url: '<?= base_url('addon-cart'); ?>',
			data: form,
			success: function(msg){
				console.log(msg);		
				$('#rightSide').html(msg);
			}
		});
	});

	$('.page_inc_btn').on('click', function(event){
		event.preventDefault();
		var btn = $(this);
		var form = btn.closest('form');
		var pretab = btn.closest('.plus-minus-input').find('input.page_range').data('preval');
		pretab = parseInt(pretab) + 1;

		
		var ePrice = form.find('input[name=price]');
		var eInitPrice = form.find('input[name=init_price]');
		var price = eInitPrice.val();
		
		var eTime = form.find('input[name=time]');
		var eInitTime = form.find('input[name=init_time]');
		var time = eInitTime.val();

		var ePriceIncrement = form.find('input[name=priceIncrement]');
		var priceIncrement = ePriceIncrement.val();
		
		var eTimeIncrement = form.find('input[name=timeIncrement]');
		var timeIncrement = eTimeIncrement.val();

		//Price and Time Calculation
		//Formula: Price + (Quantity * Increment Amount)
		var priceIncrementAmount = (parseFloat(price) * parseInt(priceIncrement)) / 100;
		var subtotalPrice = ((pretab - 1) * priceIncrementAmount) + parseFloat(price);
		
		var timeIncrementAmount = (parseFloat(time) * parseInt(timeIncrement)) / 100;
		var subtotalTime = ((pretab - 1) * timeIncrementAmount) + parseFloat(time);

		subtotalPrice = isFloat(subtotalPrice) ? subtotalPrice.toFixed(2) : subtotalPrice;
		subtotalTime = isFloat(subtotalTime) ? subtotalTime.toFixed(1) : subtotalTime;

		btn.closest('tr').find('.showPrice').html(subtotalPrice);
		ePrice.val(subtotalPrice);
		btn.closest('tr').find('.showTime').html(subtotalTime);
		eTime.val(subtotalTime);

		
		/*console.log('priceIncrementAmount',priceIncrementAmount);
		console.log('pretab',pretab);
		console.log('price',price);
		console.log('priceIncrement',priceIncrement);
		console.log('subtotalPrice',subtotalPrice);
		console.log('subtotalTime', subtotalTime);*/		
	});

	$('.page_dec_btn').on('click', function(event){
		event.preventDefault();
		
		var btn = $(this);
		var form = btn.closest('form');
		var pretab = btn.closest('.plus-minus-input').find('input.page_range').data('preval');

		pretab = parseInt(pretab) -1;
		if(pretab < 1){return false;}
		
		var ePrice = form.find('input[name=price]');
		var eInitPrice = form.find('input[name=init_price]');
		var price = eInitPrice.val();
		
		var eTime = form.find('input[name=time]');
		var eInitTime = form.find('input[name=init_time]');
		var time = eInitTime.val();

		var ePriceIncrement = form.find('input[name=priceIncrement]');
		var priceIncrement = ePriceIncrement.val();
		
		var eTimeIncrement = form.find('input[name=timeIncrement]');
		var timeIncrement = eTimeIncrement.val();

		//Price and Time Calculation
		//Formula: Price + (Quantity * Increment Amount)
		var priceIncrementAmount = (parseFloat(price) * parseInt(priceIncrement)) / 100;
		var subtotalPrice = (parseFloat(ePrice.val()) - priceIncrementAmount);
		//var subtotalPrice = (preval * priceIncrementAmount) + parseFloat(price);
		
		var timeIncrementAmount = (parseFloat(time) * parseInt(timeIncrement)) / 100;
		var subtotalTime = (parseFloat(eTime.val()) - timeIncrementAmount);
		//var subtotalTime = (preval * timeIncrementAmount) + parseFloat(time);

		subtotalPrice = isFloat(subtotalPrice) ? subtotalPrice.toFixed(2) : subtotalPrice;
		subtotalTime = isFloat(subtotalTime) ? subtotalTime.toFixed(1) : subtotalTime;


		btn.closest('tr').find('.showPrice').html(subtotalPrice);
		ePrice.val(subtotalPrice);
		btn.closest('tr').find('.showTime').html(subtotalTime);
		eTime.val(subtotalTime);

		
		/*console.log('priceIncrementAmount',priceIncrementAmount);
		console.log('pretab',pretab);
		console.log('price',price);
		console.log('priceIncrement',priceIncrement);
		console.log('subtotalPrice',subtotalPrice);
		console.log('subtotalTime', subtotalTime);*/
	});

	$('.fold-change').on('change', function(event){
		event.preventDefault();

		var form = $(this).closest('form');
		var ePrice = form.find('input[name=price]');
		var eInitPrice = form.find('input[name=init_price]');
		var price = eInitPrice.val();
		
		var eTime = form.find('input[name=time]');
		var eInitTime = form.find('input[name=init_time]');
		var time = eInitTime.val();

		var ePriceIncrement = form.find('input[name=priceIncrement]');
		var priceIncrement = ePriceIncrement.val();
		
		var eTimeIncrement = form.find('input[name=timeIncrement]');
		var timeIncrement = eTimeIncrement.val();

		//Price and Time Calculation
		//Formula: Price + (Quantity * Increment Amount)
		var priceIncrementAmount = (parseFloat(price) * parseInt(priceIncrement)) / 100;
		var timeIncrementAmount = (parseFloat(time) * parseInt(timeIncrement)) / 100;
		
		if($(this).val() == 'mono-fold'){
			var subtotalPrice = parseFloat(eInitPrice.val());
			var subtotalTime = parseFloat(eInitTime.val());
		}

		if($(this).val() == 'bi-fold'){
			//console.log('bi-fold');
			var subtotalPrice = (parseFloat(eInitPrice.val()) + priceIncrementAmount);
			var subtotalTime = (parseFloat(eInitTime.val()) + timeIncrementAmount);

		}

		if($(this).val() == 'tri-fold'){
			var subtotalPrice = (parseFloat(eInitPrice.val()) + priceIncrementAmount + priceIncrementAmount);
			var subtotalTime = (parseFloat(eInitTime.val()) + timeIncrementAmount + timeIncrementAmount);
		}

		subtotalPrice = isFloat(subtotalPrice) ? subtotalPrice.toFixed(2) : subtotalPrice;
		subtotalTime = isFloat(subtotalTime) ? subtotalTime.toFixed(1) : subtotalTime;

		$(this).closest('tr').find('.showPrice').html(subtotalPrice);
		$(this).closest('tr').find('.showTime').html(subtotalTime);
		ePrice.val(subtotalPrice);
		eTime.val(subtotalTime);

		//console.log('priceIncrementAmount',priceIncrementAmount);
		//console.log('pretab',pretab);
		//console.log('price',price);
		//console.log('priceIncrement',priceIncrement);
		console.log('subtotalPrice',subtotalPrice);
		console.log('subtotalTime', subtotalTime);
	});

	$('.page-change').on('change', function(event){
		event.preventDefault();

		var form = $(this).closest('form');
		var ePrice = form.find('input[name=price]');
		var eInitPrice = form.find('input[name=init_price]');
		var price = eInitPrice.val();
		
		var eTime = form.find('input[name=time]');
		var eInitTime = form.find('input[name=init_time]');
		var time = eInitTime.val();

		var ePriceIncrement = form.find('input[name=priceIncrement]');
		var priceIncrement = ePriceIncrement.val();
		
		var eTimeIncrement = form.find('input[name=timeIncrement]');
		var timeIncrement = eTimeIncrement.val();

		//Price and Time Calculation
		//Formula: Price + (Quantity * Increment Amount)
		var priceIncrementAmount = (parseFloat(price) * parseInt(priceIncrement)) / 100;
		var timeIncrementAmount = (parseFloat(time) * parseInt(timeIncrement)) / 100;
		
		if($(this).val() == 'one-side'){
			var subtotalPrice = parseFloat(eInitPrice.val());
			var subtotalTime = parseFloat(eInitTime.val());
		}

		if($(this).val() == 'two-side'){
			//console.log('bi-fold');
			var subtotalPrice = (parseFloat(eInitPrice.val()) + priceIncrementAmount);
			var subtotalTime = (parseFloat(eInitTime.val()) + timeIncrementAmount);

		}

		if($(this).val() == 'three-side'){
			var subtotalPrice = (parseFloat(eInitPrice.val()) + priceIncrementAmount + priceIncrementAmount);
			var subtotalTime = (parseFloat(eInitTime.val()) + timeIncrementAmount + timeIncrementAmount);
		}

		subtotalPrice = isFloat(subtotalPrice) ? subtotalPrice.toFixed(2) : subtotalPrice;
		subtotalTime = isFloat(subtotalTime) ? subtotalTime.toFixed(1) : subtotalTime;

		$(this).closest('tr').find('.showPrice').html(subtotalPrice);
		$(this).closest('tr').find('.showTime').html(subtotalTime);
		ePrice.val(subtotalPrice);
		eTime.val(subtotalTime);

		//console.log('priceIncrementAmount',priceIncrementAmount);
		//console.log('pretab',pretab);
		//console.log('price',price);
		//console.log('priceIncrement',priceIncrement);
		console.log('subtotalPrice',subtotalPrice);
		console.log('subtotalTime', subtotalTime);
	});

</script>