<main class="main-contents adjustments-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<?php //print_r($adjustments); ?>
		<div class="section-title">
			<h1>
				<?= $this->lang->line('adjustment_text'); ?>
				<span class="add-icon"></span>
			</h1>
		</div>
		<div class="product-wrapper">
			<div class="left-col">
				<div class="inner-title">
					<span class="icon">
						<img src="<?= base_url(); ?>assets_user/images/pencil-icon.png" alt="">
					</span>
					<?php if( isset($type) && $type == 'branding'): ?>
						<h2><?= $this->lang->line('branding_and_identity'); ?></h2>
					<?php endif; ?>

					<?php if( isset($type) && $type == 'design'): ?>
						<h2><?= strtoupper($item['item_name']); ?></h2>
					<?php endif; ?>
				</div>
				
				<?php if($main): ?>
					<div class="section-title sm border-0">
						<h1>
							<?= $this->lang->line('adjustment_like'); ?>
							<span class="add-icon"></span>
						</h1>
					</div>
				<?php endif; ?>

				<div class="tables-wrapper">
					<?php 
					if($adjustments):
						foreach ($adjustments as $key => $adjustment):
							if($adjustment['adjustment_category'] == 'main'):
								//get old data if adjustment item is already exist
								$icon = 'fa fa-plus';
								$textbox_value = '';
								$file_ids = '';
								$file_attachments = [];
								$cart_row_id = '';
								$existing_attachments = '';
								if($this->cart->contents()){
									foreach ($this->cart->contents() as $row_id => $cart_item) {
										$type = $cart_item['options']['type'];
										if($cart_item['id'] == $adjustment['design_adjustments_id'] && in_array($type, ['adjustment'])){
											$cart_row_id = $row_id;
											$existing_attachments = $cart_item['file_ids'];
											$icon = 'fa fa-arrow-up';
											if(isset($cart_item['textbox'])){
												$textbox_value = $cart_item['textbox'];
											}
											if(isset($cart_item['file_ids']) && !empty($cart_item['file_ids'])){
												$file_ids = explode(',',$cart_item['file_ids']);
												$files = $this->db->where_in('id', $file_ids)->get('files')->result_array();
												
								                foreach ($files as $key_file => $file) {
								                    $file_attachments[] = [
								                        'name' => $file['name'],
								                        'size' => $file['size'],
								                        'url' => $file['name'],
								                        'type' => $file['type'],
								                        'id' => $file['id']
								                    ];
								                }
											}
										}
									}
								}
							?>
								<form>
									<input type="hidden" name="design_adjustments_id" value="<?= $adjustment['design_adjustments_id']; ?>">
									<input type="hidden" name="design_id" value="<?= $item['item_id']; ?>">
									<input type="hidden" name="item_id" value="<?= $item['id']; ?>">
									<input type="hidden" name="order_id" value="<?= $item['order_id']; ?>">
									<table class="payment-table cart-adjustments" cellpadding="0" cellspacing="0" style="margin: 0;" >
										<tbody>
											<tr>
												<td><?= $adjustment['adjustment_name_'.$language]; ?></td>
												<td>
													<ul class="h-list align-items-center justify-end">
														<li>
															<ul class="statics brand">
																<li>
																	<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= $adjustment['price']; ?> <?= $this->lang->line('sar'); ?>
																</li>
																<li>
																	<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $adjustment['time_limit']; ?> <span> <?= $this->lang->line('day'); ?></span>
																</li>
															</ul>
														</li>
														<li>
															<?php

															?>
															<button class="add-cart adj-to-cart">
																<i class="<?= $icon; ?>"></i>
															</button>
														</li>
													</ul>
												</td>
												<td class="full">
													<?php if($adjustment['textbox'] == 1): ?>
														<div class="form-group">
															<!-- <input type="text" name="textbox" value="<?= $textbox_value; ?>" class="form-control validThis" placeholder="<?= $this->lang->line('Tell_us_what_you_didnt_like'); ?>"> -->
															<textarea name="textbox" class="form-control validThis" placeholder="<?= $this->lang->line('Tell_us_what_you_didnt_like'); ?>"><?= $textbox_value; ?></textarea>
															<ul class="valid-error text-purple"></ul>
														</div>
													<?php endif; ?>

													<?php if($adjustment['attachment'] == 1): ?>
														<!-- <div class="file-uploader">
															<span class="placeholder">you can attach sketches or other files</span>
															<span class="file-icon">
																<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
																<input type="file">
															</span>
														</div> -->
														<ul class="text-purple my-2" style="font-size: 14px;">Maximum size is 5MB</ul>
														<div class="uploader-wrapper">
															<!-- <div class="dropfiles" >
																<div class="file-uploader">
																	<span class="placeholder"><?= $this->lang->line('attachment'); ?>... ico, png, jpg, pdf, ai, psd, eps, indd, doc, pptx, xls</span>
																	<div id="<?= 'ca' . ($key + 1); ?>" class="uploader-icon">
																		<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
																	</div>
																</div>
															</div> -->
															<div id="<?= 'dz' . ($key + 1); ?>" class="files-holder dropzone"></div>
															<ul class="text-purple mt-2" id="max_file_error_<?= ($key+1) ?>"></ul>
															<div class="form-group padding-top-40">
																<label><?= $this->lang->line('questionnaire_large_file_size'); ?></label>
																<textarea name="file_link" class="form-control"></textarea>
																<ul class="valid-error text-purple"></ul>
															</div>
															<script type="text/javascript">
																Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drag files here";
																var divID = "<?= '#dz' . ($key + 1); ?>";
																var trigger = "<?= '#ca' . ($key + 1); ?>";
																var existingFiles = '<?= json_encode($file_attachments); ?>';
																var existingFilesPath = "<?= base_url('uploads/orders/').$item['order_id'].'/'.$item['id'].'/adjustments/'; ?>";
																var iconPath = "<?= base_url('assets_user/images/file-icons/'); ?>";
																var fileDeleteURL = "<?= base_url('dropzone-files-delete'); ?>";

																Dropzone.autoDiscover = false;
																var <?= 'dz' . ($key + 1); ?> = new Dropzone(divID, {
														            url: "<?= base_url('adjustment-files'); ?>",
														            paramName: "files",
														            maxFilesize: 5,
														            acceptedFiles : '.ico,.png,.jpg,.pdf,.ai,.psd,.eps,.indd,.doc,.docx,.ppt,.pptx,.xlsx,.xls',
														            addRemoveLinks : true,
														            dictRemoveFile : '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>',
														            parallelUploads: 1,
														            divID: divID,
														            uploadMultiple: true,
														            autoProcessQueue: false,
														           	previewsContainer: divID,
														            clickable: true,
														            maxFiles: 15,
														            init: function() {
														                this.on('addedfile', function(file){
														                    this.options.addRemoveLinks = true;
														                    this.options.dictRemoveFile = '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>';
														                    $("#max_file_error_<?= ($key + 1) ?>").html("");
														                    if (file.type.match(/.pdf/)) {
																			    this.emit("thumbnail", file, iconPath+"pdf-icon.png");
																			}
																			if (file.type.match(/.ai/)) {
																			    this.emit("thumbnail", file, iconPath+"ai-icon.png");
																			}
																			if (file.type.match(/.docx/)) {
																			    this.emit("thumbnail", file, iconPath+"docx-icon.png");
																			}
																			if (file.type.match(/.doc/)) {
																			    this.emit("thumbnail", file, iconPath+"docx-icon.png");
																			}
																			if (file.type.match(/.eps/)) {
																			    this.emit("thumbnail", file, iconPath+"eps-icon.png");
																			}
																			if (file.type.match(/.id/)) {
																			    this.emit("thumbnail", file, iconPath+"id-icon.png");
																			}
																			if (file.type.match(/.ppt/)) {
																			    this.emit("thumbnail", file, iconPath+"ppt-icon.png");
																			}
																			if (file.type.match(/.pptx/)) {
																			    this.emit("thumbnail", file, iconPath+"ppt-icon.png");
																			}
																			if (file.type.match(/.psd/)) {
																			    this.emit("thumbnail", file, iconPath+"psd-icon.png");
																			}
																			if (file.type.match(/.xlsx/)) {
																			    this.emit("thumbnail", file, iconPath+"xlsx-icon.png");
																			}
																			if (file.type.match(/.xls/)) {
																			    this.emit("thumbnail", file, iconPath+"xlsx-icon.png");
																			}
														                });
														                this.on('sending', function(file, xhr, formData){
														                    var item_id = "<?= isset($item['id']) ? $item['id'] : ''; ?>";
														                    var order_id = "<?= isset($item['order_id']) ? $item['order_id'] : ''; ?>";
														                    var cart_row_id = "<?= !empty($cart_row_id) ? $cart_row_id : ''; ?>";
														                    var old_file_ids = "<?= !empty($existing_attachments) ? $existing_attachments : ''; ?>";

														                    formData.append('item_id', item_id);
														                    formData.append('order_id', order_id);
														                    formData.append('cart_row_id', cart_row_id);
														                    formData.append('existingFiles', old_file_ids);
														                    formData.append('my_id', this.divID);
														                });
														                this.on("success", function(file, filename) { 
														                    this.options.addRemoveLinks = false;
														                    this.options.dictRemoveFile = '';

														                    //this.processQueue();
														                });
														                this.on("processing", function() {
																		    this.options.autoProcessQueue = true;
																		});
														                this.on("maxfilesexceeded", function (file) {
														                	$("#max_file_error_<?= ($key+1) ?>").html("<?= $this->lang->line('big_files_error') ?>");
													                        this.removeFile(file);
													                    });
													                    this.on("error", function(file, message) { 
															            	if(message.search("File is too big") != -1){
															                	$("#max_file_error_<?= ($key+1) ?>").html("<?= $this->lang->line('big_files_error') ?>");
															                	this.removeFile(file); 
															            	}else{
															            		// $('#max_file_error').html("");
															            	}
																    	});
													                    //if(existingFiles){
														                    this.on("removedfile", function(file) {
														                        if (this.files.length == 0) {
														                        	var item_id = "<?= isset($item['id']) ? $item['id'] : ''; ?>";
														                    		var order_id = "<?= isset($item['order_id']) ? $item['order_id'] : ''; ?>";
														                    		var adjustment_id = "<?= $adjustment['design_adjustments_id']; ?>";
														                    		var existing_attachments = "<?= $existing_attachments; ?>";
														                    		var cart_row_id = "<?= $cart_row_id; ?>";
														                            $.post(fileDeleteURL, {
														                            	'fileName': file.name,
														                            	'item_id':item_id,
														                            	'order_id':order_id,
														                            	'adjustment_id':adjustment_id,
														                            	'existing_attachments':existing_attachments,
														                            	'cart_row_id':cart_row_id
														                            });
														                        } 
														                    });   
														                //} 
														            }// end init function
														        });

														        //load and display existing files in dropzone
											                    if(existingFiles){
											                    	var dzone = eval("<?= 'dz' . ($key + 1); ?>");
												                    var existingFiles = JSON.parse(existingFiles); 
												                    //console.log(existingFiles.length);
												                    //console.log(dzone.options.maxFiles);
												                    
												                    for(let i = 0; i < existingFiles.length; i++) {
												                        let existedFile = existingFiles[i];
												                        // Create the mock file:
												                        var mockFile = {name: existedFile.name, size: existedFile.size, url: existedFile.url};
												                        var extension = existedFile.name.substr( (existedFile.name.lastIndexOf('.') +1) );
												                        dzone.options.addedfile.call(dzone, mockFile);
												                        //console.log(extension);
												                        if(extension == 'pdf'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'pdf-icon.png');
												                        }else if(extension == 'docx'){ 
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'docx-icon.png');
												                        }else if(extension == 'doc'){ 
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'docx-icon.png');
												                        }else if(extension == 'xlsx'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'xlsx-icon.png');
												                        }else if(extension == 'xls'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'xlsx-icon.png');
												                        }else if(extension == 'ppt'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'ppt-icon.png');
												                        }else if(extension == 'pptx'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'ppt-icon.png');
												                        }else if(extension == 'txt'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'txt-icon.png');
												                        }else if(extension == 'psd'){
												                            dzone.options.thumbnail.call(dzone, mockFile, iconPath+'psd-icon.png');
												                        }else{
												                            dzone.emit("thumbnail", mockFile, existingFilesPath+existedFile.url);
												                        }
												                        dzone.emit("complete", mockFile);
												                        //var existingFileCount = i; // The number of files already uploaded
												                        //dzone.options.maxFiles = dzone.options.maxFiles - existingFiles.length;
												                        mockFile.previewElement.classList.add('dz-success');
												                        mockFile.previewElement.classList.add('dz-complete');
												                    }
												                }
															</script>
														</div>

													<?php endif; ?>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
										
								<?php 
							endif;
						endforeach;
					endif;
					?>
					<!-- <form>
						<table class="payment-table cart-adjustments" cellpadding="0" cellspacing="0" style="margin: 0;" >
							<tbody>
								<tr>
									<td>Other comments to keep in mind?</td>
									<td class="full">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="write what you didnt like, and what you want to see more of">
										</div>
										<div class="file-uploader">
											<span class="placeholder">you can attach sketches or other files</span>
											<span class="file-icon">
												<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
												<input type="file">
											</span>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</form> -->
				</div>
				
				<?php 
				if($extras ||
					(isset($item['measurement_type']) &&
					isset($item['measurement_value']) &&
					$item['measurement_type'] != 'quantity')
				):
					?>
					<div class="section-title sm border-0">
						<h1>
							<?= $this->lang->line('adjustment_extra'); ?>
							<span class="add-icon"></span>
						</h1>
					</div>
				<?php endif; ?>

				<div class="tables-wrapper">
					<!-- Measurement Type Start -->
					<?php 
					if(isset($item['measurement_type']) &&
						isset($item['measurement_value']) &&
						$item['measurement_type'] != 'quantity'):
						
						?>
							<form>
								<input type="hidden" name="design_adjustments_id" value="<?= $adjustment['design_adjustments_id']; ?>">
								<input type="hidden" name="design_id" value="<?= $item['item_id']; ?>">
								<input type="hidden" name="item_id" value="<?= $item['id']; ?>">
								<input type="hidden" name="order_id" value="<?= $item['order_id']; ?>">

								<input type="hidden" name="price" value="<?= $design['price']; ?>">
								<input type="hidden" name="init_price" value="<?= $design['price']; ?>">
								<input type="hidden" name="time" value="<?= $design['time']; ?>">
								<input type="hidden" name="init_time" value="<?= $design['time']; ?>">
								<input type="hidden" name="priceIncrement" value="<?= $design['price_increment']; ?>">
								<input type="hidden" name="timeIncrement" value="<?= $design['time_increment']; ?>">
								<input type="hidden" name="measurement_type" value="<?= $design['type']; ?>">

								<table class="payment-table cart-adjustments" cellpadding="0" cellspacing="0" style="margin: 0;" >
									<tbody>
										<tr>
											<td class="full">
												<div class="d-flex">
													<ul class="option-list width-50 align-items-center">
														<?php if($item['measurement_type'] == 'side'): ?>
															<li><?= ucfirst($this->lang->line('addon_side')); ?></li>
															<li>
																<select name="mtype" class="selectpicker metrisi-type cartmtype page-change">
																	<option value="one-side" <?= ($item['measurement_value'] == 'one-side') ? 'selected' : ''; ?>><?= $this->lang->line('oneside'); ?></option>
																	<option value="two-side" <?= ($item['measurement_value'] == 'two-side') ? 'selected' : ''; ?>><?= $this->lang->line('twoside'); ?></option>
																</select>
															</li>
														<?php endif; ?>

														<?php if($item['measurement_type'] == 'fold'): ?>
															<li><?= ucfirst($this->lang->line('addon_fold')); ?></li>
															<li>
																<select name="mtype" class="selectpicker metrisi-type cartmtype fold-change">
																	<option value="mono-fold" <?= ($item['measurement_value'] == 'mono-fold') ? 'selected' : ''; ?>><?= $this->lang->line('monofold'); ?></option>
																	<option value="bi-fold" <?= ($item['measurement_value'] == 'bi-fold') ? 'selected' : ''; ?>><?= $this->lang->line('bifold'); ?></option>
																	<option value="tri-fold" <?= ($item['measurement_value'] == 'tri-fold') ? 'selected' : ''; ?>><?= $this->lang->line('trifold'); ?></option>
																</select>
															</li>
														<?php endif; ?>

														<?php if($item['measurement_type'] == 'page'): ?>

															<li><?= ucfirst($this->lang->line('addon_pages')); ?></li>
															<li>
																<div class="input-group plus-minus-input">
								                                    <a href="javascript:void(0)" class="btn page_dec_btn" data-field="quantity">
								                                    	-
								                                    </a>
								                                    <input class="form-control input-group-field page_range cartmtype" type="text" value="1 - 10" name="mtype" data-preval="1" readonly>
								                                    <a href="javascript:void(0)" class="btn page_inc_btn" data-field="quantity">
								                                    	+
								                                    </a>
								                                </div>
															</li>
														<?php endif; ?>
													</ul>

													<ul class="h-list align-items-center justify-end width-50">
														<li>
															<ul class="statics brand">
																<li>
																	<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt="">
																	<i class="i-tag">+&nbsp;</i><div class="showPrice">&nbsp;<?= $design['price']; ?></div> <span> <?= $this->lang->line('sar'); ?></span>
																</li>
																<li>
																	<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> 
																	<div class="showTime"><?= $design['time']; ?></div> <span> <?= $this->lang->line('day'); ?></span>
																</li>
															</ul>
														</li>
														<li>
															<button class="add-cart adj-to-cart">
																<i class="fa fa-plus"></i>
															</button>
														</li>
													</ul>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						<?php 
					endif;
					?>

					<!-- Adjustment Category Extras start -->
					<?php 
					if($adjustments): 
						foreach ($adjustments as $key => $adjustment):
							if($adjustment['adjustment_category'] == 'extras'):
							?>
								<form>
									<input type="hidden" name="design_adjustments_id" value="<?= $adjustment['design_adjustments_id']; ?>">
									<input type="hidden" name="design_id" value="<?= $item['item_id']; ?>">
									<input type="hidden" name="item_id" value="<?= $item['id']; ?>">
									<input type="hidden" name="order_id" value="<?= $item['order_id']; ?>">
									<table class="payment-table cart-adjustments" cellpadding="0" cellspacing="0" style="margin: 0;" >
										<tbody>
											<tr>
												<td><?= $adjustment['adjustment_name_'.$language]; ?></td>
												<td>
													<ul class="h-list align-items-center justify-end">
														<li>
															<ul class="statics brand">
																<li>
																	<img src="<?= base_url(); ?>assets_user/images/glyph-database.png" alt=""> +<?= $adjustment['price']; ?> <?= $this->lang->line('sar'); ?>
																</li>
																<li>
																	<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> <?= $adjustment['time_limit']; ?> <span> <?= $this->lang->line('day'); ?></span>
																</li>
															</ul>
														</li>
														<li>
															<button class="add-cart adj-to-cart">
																<i class="fa fa-plus"></i>
															</button>
														</li>
													</ul>
												</td>
												<td class="full">
													<?php if($adjustment['textbox'] == 1): ?>
														<div class="form-group">
															<!-- <input type="text" name="textbox" class="form-control validThis" placeholder="<?= $this->lang->line('Tell_us_what_you_didnt_like'); ?>"> -->
															<textarea name="textbox" class="form-control validThis" placeholder="<?= $this->lang->line('Tell_us_what_you_didnt_like'); ?>"></textarea>
														</div>
													<?php endif; ?>

													<?php if($adjustment['attachment'] == 1): ?>
														<!-- <div class="file-uploader">
															<span class="placeholder">you can attach sketches or other files</span>
															<span class="file-icon">
																<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
																<input type="file">
															</span>
														</div> -->



														<ul class="text-purple my-2" style="font-size: 14px;">Maximum size is 5MB</ul>
														<div class="uploader-wrapper">
																<!-- <div class="dropfiles" >
																	<div class="file-uploader">
																		<span class="placeholder"><?= $this->lang->line('attachment'); ?>... ico, png, jpg, pdf, ai, psd, eps, indd, doc, pptx, xls</span>
																		<div id="<?= 'ca' . ($key + 1); ?>" class="uploader-icon">
																			<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
																		</div>
																	</div>
																</div> -->
																<div id="<?= 'dze' . ($key + 1); ?>" class="files-holder dropzone"></div>
																<ul class="text-purple mt-2" id="max_file_error_e_<?= ($key+1) ?>"></ul>
																<div class="form-group padding-top-40">
																	<label><?= $this->lang->line('questionnaire_large_file_size'); ?></label>
																	<textarea name="file_link" class="form-control"></textarea>
																	<ul class="valid-error text-purple"></ul>
																</div>
																<script type="text/javascript">
																	var divID = "<?= '#dze' . ($key + 1); ?>";
																	var trigger = "<?= '#ca' . ($key + 1); ?>";
																	Dropzone.autoDiscover = false;
																	var <?= 'dze' . ($key + 1); ?> = new Dropzone(divID, {
															            url: "<?= base_url('adjustment-files'); ?>",
															            paramName: "files",
															            maxFilesize: 5,
															            divID:divID,
															            acceptedFiles : '.ico,.png,.jpg,.pdf,.ai,.psd,.eps,.indd,.doc,.docx,.ppt,.pptx,.xlsx,.xls',
															            addRemoveLinks : true,
															            dictRemoveFile : '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>',
															            parallelUploads: 1,
															            uploadMultiple: true,
															            autoProcessQueue: false,
															           	previewsContainer: divID,
															            clickable: true,
															            maxFiles: 15,
															            init: function() {
															            	let thisDropzone = this;
															                this.on('addedfile', function(file){
															                    this.options.addRemoveLinks = true;
															                    this.options.dictRemoveFile = '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>';
															                    $("#max_file_error_e_<?= ($key+1) ?>").html("");
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
															                    var item_id = "<?= isset($item['id']) ? $item['id'] : ''; ?>";
															                    var order_id = "<?= isset($item['order_id']) ? $item['order_id'] : ''; ?>";
															                    formData.append('item_id', item_id);
															                    formData.append('order_id', order_id);
															                    formData.append('my_id', thisDropzone.divID);
															                });
															                this.on("success", function(file, filename) { 
															                    this.options.addRemoveLinks = false;
															                    this.options.dictRemoveFile = '';
															                    //this.processQueue();
															                });
															                this.on("processing", function() {
																			    this.options.autoProcessQueue = true;
																			});
															                this.on("maxfilesexceeded", function (file) {
														                       this.removeFile(file);
														                    });
														                    this.on("error", function(file, message) { 
																            	if(message.search("File is too big") != -1){
																                	$("#max_file_error_e_<?= ($key+1) ?>").html("<?= $this->lang->line('big_files_error') ?>");
																                	this.removeFile(file); 
																            	}else{
																            		// $('#max_file_error').html("");
																            	}
																		    });
															            }// end init function
															        });
																</script>
															</div>
													<?php endif; ?>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
								<?php 
							endif;
						endforeach;
					endif;
					?>
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

<script type="text/javascript">
	$('.dz-message').append('<br><img style="width: 30px; margin-top:5px;" src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">');
	$(document).ready(function(){
		var processing_count = 0;
		var processed_count = 0;
		$('.adj-to-cart').on('click', function(event){
			event.preventDefault();
			
			var btn = $(this);
			var form = $(this).closest('form');
			file_uploading_reference =  $(this).closest("tr").find("[id*=max_file_error]");
			// file_uploading_reference.html("<?= $this->lang->line('files_still_uploading') ?>");
			var dropzoneID = form.find('.files-holder').attr('id');
			// divID = '#'+dropzoneID;
			//console.log(dropzoneID);

		    var selectedElements = form.find(".validThis");
		    var validation = false;
		    var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
		    var errorClass = ".valid-error";
		    var e;
		    //console.log('valid: ',selectedElements);

		    if(selectedElements.length > 0){
		        if (form[0].checkValidity()) {
		            selectedElements.each(function(){
		                e = $(this);
		                var isDisabled = e.prop('disabled');
		                //console.log(isDisabled);
		                if(isDisabled == true) {
		                	validation = true;
		                	return;
		                }
		                if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
		                    e.focus().parent().find(errorClass).html(errorMsg).addClass('text-danger').show();
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
		    	data.append('my_id', '#'+dropzoneID);
		    	//var data = form.serializeArray();
		    	//console.log(data);
		    	var dz = eval('('+ dropzoneID +')');

				processing_count++;
		    	if(dz.files.length > 0){
		   //  		// btn.text('<?= $this->lang->line("sending"); ?>').attr('disabled',true);
		   //  		// dz.processQueue();
					// if(dropzoneID){
				 //    	eval(dropzoneID + '.processQueue()');
					// }
						btn.addClass("disabled");
						$('#go_to_cart').addClass("disabled");
				    	$.ajax({
							type: 'post',
							url: '<?= base_url('adjustment-cart'); ?>',
							data: data,
							contentType: false,
		    				processData: false,
							success: function(msg){
								$('#rightSide').html(msg);
								//console.log(msg);
								if(dropzoneID){

									dz.divID = '#'+dropzoneID;
									console.log(dz.divID);
									setTimeout(() => { console.log("World!"); }, 2000);
							    	eval(dropzoneID + '.processQueue()');
							    	$('#go_to_cart').addClass("disabled");
		    						file_uploading_reference.html("<?= $this->lang->line('files_still_uploading') ?>");
						    		dz.on('queuecomplete', function(file){
				    					processed_count++;
						    			file_uploading_reference.html("");
				    					btn.html('<i class="fa fa-arrow-up"></i>');
				    					btn.removeClass("disabled");
				    					if(processed_count == processing_count){
				    						$('#go_to_cart').removeClass("disabled");
				    					}
								    });
								}else{
									processed_count++;
									btn.html('<i class="fa fa-arrow-up"></i>');
									btn.removeClass("disabled");
									if(processed_count == processing_count){
										$('#go_to_cart').removeClass("disabled");
									}
								}
								
								// trigger drop zone
							}
						});
		    	}else{
		    		$.ajax({
						type: 'post',
						url: '<?= base_url('adjustment-cart'); ?>',
						data: data,
						contentType: false,
	    				processData: false,
						success: function(msg){
			    			processed_count++;
							$('#rightSide').html(msg);
			    			btn.html('<i class="fa fa-arrow-up"></i>');
						}
					});
		    	}
		    }
		});
	});

$('.page-change-adj').on('change', function(event){
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