<main class="main-contents payment-page questionnaire">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="steps-banenr">
			<div class="main-steps">
				<div class="row stack-on-600">
					<div class="col-sm-4">
						<div class="box step1">
							<div class="inner">
								<div class="image">
									<img src="<?= base_url(); ?>assets_user/images/cube.png" alt="">
								</div>
								<div class="desc">
									<h5>
										<!-- <a href="#"> -->Buy Bundl<!-- </a> -->
									</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="box step2 active">
							<div class="inner">
								<div class="image">
									<img src="<?= base_url(); ?>assets_user/images/circle-1.jpg" alt="">
								</div>
								<div class="desc">
									<h5>
										<!-- <a href="#"> -->Fill Questionnaire<!-- </a> -->
									</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="box step3">
							<div class="inner">
								<div class="image">
									<img src="<?= base_url(); ?>assets_user/images/plane.png" alt="">
								</div>
								<div class="desc">
									<h5>
										<!-- <a href="#"> -->Get Designs<!-- </a> -->
									</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-title">
			<h1>
				questionnaire
				<span class="add-icon"></span>
			</h1>
			<p>Let's start by helping us understand your preferences</p>
		</div>
		<div class="inner-container">
			<div class="left-col">
				<!-- <div class="section-title sm border-0 link-right" id="branding">
					<h1>
						DESIGN QUESTIONNAIRE
						<span class="add-icon"></span>
					</h1>
				</div> -->
				<?php //print_r($questionnaire); ?>
				<form method="post" action="<?= base_url('save-questions'); ?>" id="qform" class="question-form">
					<input type="hidden" name="item_id" value="<?= isset($item_id) ? $item_id : null; ?>">
					<div class="inner-section border-0">
						<div class="section-title sm border-0 link-right" id="card-1">
							<h1>
								<?= isset($design['item_name']) ? strtoupper($design['item_name']) : ''; ?>
								<span class="add-icon"></span>
							</h1>
						</div>

						<?php if( (isset($questionnaire)) && ($questionnaire['language'] == 1)): ?>
							<h3>LANGUAGES</h3>
							<div class="form-group">
								<ul class="h-list">
									<li class="radio">
										<label>
											<input type="radio" name="language" value="english" checked="checked">
											<span>English </span>
										</label>
									</li>
									<li class="radio">
										<label>
											<input type="radio" name="language" value="arabic">
											<span>Arabic </span>
										</label>
									</li>
								</ul>
							</div>
						<?php endif; ?>

						<?php if( (isset($questionnaire)) && ($questionnaire['measurement'] == 1)): ?>
							<h3>MEASURMENT</h3>
							<div class="form-group">
								<ul class="h-list">
									<li class="radio">
										<label>
											<input type="radio" checked="checked" value="3.5X2 inch" id="default" name="measurement">
											<span>Standard 3.5X2 inch (defult)</span>
										</label>
									</li>
									<li>
										<ul class="h-list inner-list">
											<li class="radio">
												<label>
													<input type="radio" id="custom" name="measurement">
													<span>Customise </span>
												</label>
											</li>
											<li>
												<div class="measure-value">
													<span>(Width</span>
													<input type="text"
														name="width" 
														disabled="disabled" 
														oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
														class="form-control">
												</div>
											</li>
											<li class="radio">
												<div class="measure-value">
													<span>Height</span>
													<input type="text" 
														name="height"
														disabled="disabled" 
														oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
														class="form-control">
												</div>
											</li>
											<li>
												<select name="unit" disabled="disabled" class="selectpicker" title="inch">
													<option value="inch" selected="selected">inch</option>
													<option value="pixel">pixel</option>
												</select>
											</li>
										</ul>
									</li>
								</ul>
								<div id="err-hw" class="text-purple"></div>
								<script type="text/javascript">
									$('#custom').on('change', function(event){
										$('input[name=width],input[name=height],select[name=unit]').prop("disabled", !$(this).is(':checked'));
										$('.selectpicker').selectpicker('refresh');
									});
									$('#default').on('change', function(event){
										$('input[name=width],input[name=height],select[name=unit]').prop("disabled", $(this).is(':checked'));
										$('.selectpicker').selectpicker('refresh');
									});
								</script>
							</div>
						<?php endif; ?>

						<?php if( (isset($questionnaire)) && ($questionnaire['content'] == 1)): ?>
							<ul class="h-list content">
								<li>
									<h3>CONTENT</h3>
								</li>
								<li class="checkbox">
									<label>
										<input type="checkbox" name="content">
										<span>same as</span>
									</label>
								</li>
								<li>
									<select id="slc-content" class="selectpicker">
										<option>Choose</option>
									</select>
								</li>
							</ul>
						<?php endif; ?>

						<?php if( (isset($questionnaire)) && ($questionnaire['textbox'] == 1)): ?>
							<div class="form-group margin-bottom-10">
								<input type="text" name="textbox" class="form-control" placeholder="text, images, brandguidlines, previous designs">
							</div>
						<?php endif; ?>

						<?php if( (isset($questionnaire)) && ($questionnaire['attachment'] == 1)): ?>
							<!-- <div class="uploader-wrapper">
								<div class="file-uploader">
									<span class="placeholder">pdf, jpg, doc., text .. ect</span>
									<span class="file-icon">
										<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
										<input type="file" name="files[]" multiple="multiple">
										<script type="text/javascript">$('#qform').attr('enctype', 'multipart/form-data');</script>
									</span>
								</div>
								<ul class="files-holder"></ul>
							</div> -->

							<div class="uploader-wrapper">
								<div class="dropfiles" >
									<div class="file-uploader">
										<span class="placeholder">attachment... ico, png, jpg, pdf, ai, psd, eps, indd, doc, pptx, xls</span>
										<div class="uploader-icon">
											<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
										</div>
									</div>
								</div>
								<div id="dz" class="files-holder dropzone"></div>
								<script type="text/javascript">
									var divID = "#dz";
									Dropzone.autoDiscover = false;
									var dz = new Dropzone(divID, {
							            url: "<?= base_url('dropzone-files'); ?>",
							            paramName: "files",
							            maxFilesize: 5,
							            acceptedFiles : '.ico,.png,.jpg,.pdf,.ai,.psd,.eps,.indd,.doc,.docx,.ppt,.pptx,.xlsx,.xls',
							            addRemoveLinks : true,
							            dictRemoveFile : 'X',
							            parallelUploads: 10,
							            uploadMultiple: true,
							            autoProcessQueue: false,
							           	previewsContainer: divID,
							            clickable: ".uploader-icon",
							            init: function() {
							                this.on('addedfile', function(file){
							                    this.options.addRemoveLinks = true;
							                    this.options.dictRemoveFile = 'X';
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
							                    var item_id = "<?= isset($item_id) ? $item_id : ''; ?>";
							                    formData.append('item_id', item_id);
							                    
							                    var order_id = "<?= isset($design['order_id']) ? $design['order_id'] : ''; ?>";
							                    formData.append('order_id', order_id);
							                    formData.append('q_type', 'design');
							                });
							                this.on("success", function(file, filename) { 
							                    this.options.addRemoveLinks = false;
							                    this.options.dictRemoveFile = '';
							                    //this.processQueue();
							                });
							                this.on("maxfilesexceeded", function (file) {
						                        this.removeAllFiles();
						                        this.addFile(file);
						                    });
							            }// end init function
							        });
								</script>
							</div>

						<?php endif; ?>

						<div class="button-row padding-top-40">
							<button id="sbmt" class="btn btn-default">SUBMIT</button>
							<label class="success-label" style="display: none;">QUESTIONNAIRE SUBMITTED SUCCESFULLY</label>
							<a href="<?= base_url('dashboard'); ?>" class="save-link">< Save for later ></a>
							<a href="<?= base_url('dashboard'); ?>" class="process-link">&lt; GO TO DASHBOARD &gt;</a>
						</div>
					</div>
				</form>
			</div>
			<div class="right-col">
				<div class="navigation-wrapper">
					<ul class="navigation-links">
						<span class="vertical-border"></span>
						<!-- <li>
							<ul class="inner">
								<li class="main-link">
									<a href="#branding">BRANDING</a>
								</li>
								<li>
									<a href="#your-business">YOUR BUSINESS</a>
								</li>
								<li>
									<a href="#target-market">YOUR TARGET MARKET</a>
								</li>
								<li>
									<a href="#your-brand">YOUR BRAND</a>
								</li>
							</ul>
						</li> -->
						<li>
							<ul class="inner">
								<li class="main-link">
									<a href="#stationary">DESIGN</a>
								</li>
								<li>
									<a href="#card-1"><?= isset($design['item_name']) ? strtoupper($design['item_name']) : ''; ?></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">
	$('#sbmt').on('click', function(event){
		event.preventDefault();

		// var e = $('input[name=height]:not(:disabled)');
		// if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
		// 	$('#err-hw').html('<span class="text-danger">Height and Width are both required.</span>');
		// 	e.focus();
		// }

		// var e = $('input[name=width]:not(:disabled)');
		// if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
		// 	$('#err-hw').html('<span class="text-danger">Height and Width are both required.</span>');
		// 	e.focus();
		// }

		if($('#default').not(':checked')){
			var str = $('input[name=width]').val() + 'X' + $('input[name=height]').val() + ' ' + $('select[name=unit]').val();
			$('#custom').val(str);
		}

		//$('#qform').submit();
		var btn = $(this);
		var form = $(this).closest('form');
		var data = new FormData(form[0]);
  //   	$.each(form.find('input[type=file]').files, function(i, file) {
		//     data.append('file[]', file);
		// });
		//console.log(data);
    	$.ajax({
			type: 'post',
			url: form.attr('action'),
			data: data,
			contentType: false,
			processData: false,
			success: function(msg){
				console.log(msg);
				btn.parent().find('.success-label').show();
				btn.parent().find('.save-link').hide();
				//btn.parent().find('.process-link').hide();
				var dropzoneID = 'dz';
				eval(dropzoneID + '.processQueue()');
				btn.hide();
			}
		});
	});

	$('input[name=content]').on('change', function(event){
		//event.preventDefault();
		if(this.checked) {
			var item_id = $('input[name=item_id]').val();
			//console.log(item_id);
			$.ajax({
		      type: 'post',
		      url: '<?= base_url('get-order-items'); ?>',
		      data: {'item_id':item_id},
		      success: function(msg){
		        console.log(msg);
		        $('#slc-content').html(msg).selectpicker('refresh');
		        }
			});
		}
	});

	$('#slc-content').on('change', function(event){
		$('input[name=content]').val($(this).val());
	});
</script>