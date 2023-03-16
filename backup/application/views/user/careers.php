<style type="text/css">
	.uploader-icon {
    	cursor: pointer;
    	position: inherit;
	}
</style>
<main class="main-contents question-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<div class="section-title border-0">
			<h1>
				<!-- CAREERS -->
				<?= $this->lang->line('careers'); ?>
				<span class="add-icon"></span>
			</h1>
		</div>
		<!-- <for-web> -->
		<?php if($careers): ?>
		<div class="dashboard-tabs">
			<ul class="slider_for_mobile nav nav-tabs hide-on-mobile" id="myTab" role="tablist">
				<?php 
				if($careers):
					foreach ($careers as $key => $vacancy): $i = $key + 1;
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
						    		<?= strtoupper($vacancy['vacancy_'.$language]); ?>
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
					<?= $this->lang->line('careers_mobile'); ?>
				</a>
				<div class="hide-show">
					<ul class="slider_for_mobile nav nav-tabs" id="myTab" role="tablist">
						<?php 
						if($careers):
							foreach ($careers as $key => $vacancy): $i = $key + 1;
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
								    		<?= strtoupper($vacancy['vacancy_'.$language]); ?>
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
				if($careers):
					foreach ($careers as $key => $vacancy): $i = $key + 1;
						?>
						<div class="tab-pane fade <?= ($i == 1)?'show active':''; ?>" 
							id="<?= $i; ?>" 
							role="tabpanel" 
							aria-labelledby="<?= $i; ?>-tab">

							<h3 class="bundl-names show-on-mobile">		    	
								<span class="item">
									<?= $vacancy['vacancy_'.$language]; ?>
								</span>
							</h3>

							<div class="career-desc">
								<h4><?= $this->lang->line('vacancy_description'); ?></h4>
								<p><?= $vacancy['description_'.$language]; ?></p>
								<h4><?= $this->lang->line('vacancy_qualification'); ?></h4>
								<p><?= $vacancy['qualification_'.$language]; ?></p>
							</div>
						</div>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
		<?php endif; ?>

		<form class="recommend-form">
			<h3><?= $this->lang->line('join_us_msg'); ?></h3>
			<div class="section-title">
				<h1>
					<?= $this->lang->line('join_us'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
			<div class="row col-gap-100">
				<div class="col-sm-12">
					<div class="form-group with-icon">
						<input type="text" id="appname" name="name" class="form-control" placeholder="<?= $this->lang->line('join_us_name'); ?>">
						<span class="icon name"></span>
						<ul class="showme"></ul>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group with-icon">
						<input type="text" id="appphone" name="phone" class="form-control phoneMask"
						 	maxlength="11"
							oninput="this.value=this.value.replace(/[^0-9]/g,'');" >
						<span class="icon phone"></span>
						<ul class="showme"></ul>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group with-icon">
						<input type="text" id="appemail" name="email" class="form-control" placeholder="<?= $this->lang->line('footer_placeholder_email'); ?>">
						<span class="icon email"></span>
						<ul class="showme"></ul>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group with-icon">
						<!-- <input type="text" id="appmessage" name="message" class="form-control" placeholder="<?= $this->lang->line('join_us_message'); ?>*"> -->
						<textarea id="appmessage" name="message" class="form-control" placeholder="<?= $this->lang->line('contactus_message'); ?>"></textarea>
						<span class="icon message"></span>
						<ul class="showme"></ul>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<select name= "vacancy_id" id="appvacancy" class="selectpicker bundl-dropdown">
							<option value=""><?= $this->lang->line('join_us_vacancy'); ?></option>
							<?php
							if($careers){
								foreach ($careers as $key => $vacancy) {
									echo '<option value="'.$vacancy['id'].'">'.$vacancy['vacancy_'.$language].'</option>';
								}
							}
							?>
						</select>
						<ul id="showmev"></ul>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group with-icon">
						<div class="uploader-wrapper">
							<!-- <div class="dropfiles" >
								<div class="file-uploader">
									<span class="placeholder" style="border-bottom: 2px solid #000;">attachment... ico, png, jpg, pdf, ai, psd, eps, indd, doc, pptx, xls</span>
									<div id="uploader-icon" class="uploader-icon">
										<img src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">
									</div>
								</div>
							</div> -->
							<div id="dz" class="files-holder dropzone"></div>
							<ul class="text-purple mt-2" id="max_file_error"></ul>
						</div>
					</div>
				</div>


				<div class="col-sm-12">
					<div class="button-row" id="join-btn">
						<button id="apply" class="btn btn-default"><?= $this->lang->line('join_us_apply'); ?></button>
					</div>

					<div class="proceed-text" id="join-msg" style="display: none;">
						<h4><?= $this->lang->line('request_received_we_will_back_shortly'); ?></h4>
					</div>
				</div>
			</div>
		</form>
	</div>
</main>

<script type="text/javascript">
	$(document).ready(function(){
	    $("#appphone").intlTelInput({
	        allowDropdown: true,
	        autoPlaceholder: "polite",
	        placeholderNumberType: "MOBILE",
	        formatOnDisplay: true,
	        separateDialCode: true,
	        nationalMode: false,
	        autoHideDialCode: true,
	        preferredCountries: [ "sa", "ae" ]
	    });
	    //$("#contact-phone").intlTelInput("setNumber", "+96651234569");
	});
	// $('.dz-message').append('<br><img class="uploader-icon" style="width: 30px; margin-top:5px;" src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">');
	var divID = "#dz";
	Dropzone.autoDiscover = false;
	// Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drag files here";
	var dz = new Dropzone(divID, {
        url: "<?= base_url('vacancy-dz'); ?>",
        paramName: "files",
        maxFilesize: 5,
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
            this.on('addedfile', function(file){
                this.options.addRemoveLinks = true;
                this.options.dictRemoveFile = '<i style="border: 2.3px solid; padding:0px 1px;cursor:pointer;" class="fa fa-times"></i>';
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
            this.on("success", function(file, filename) {
                this.options.addRemoveLinks = false;
                this.options.dictRemoveFile = '';
            });
            this.on("processing", function() {
			    this.options.autoProcessQueue = true;
			});
            this.on("maxfilesexceeded", function (file) {
               // $('#max_file_error').html("<?= $this->lang->line('big_files_error') ?>");
                this.removeFile(file);
            });
            this.on("error", function(file, message) { 
            	if(message.search("File is too big") != -1){
                	// $('#max_file_error').html("<?= $this->lang->line('big_files_error') ?>");
                	this.removeFile(file); 
            	}else{
            		// $('#max_file_error').html("");
            	}
		    });
        }// end init function
    });
	$('.dz-message').append('<br><img class="uploader-icon" style="width: 30px; margin-top:5px;" src="<?= base_url(); ?>assets_user/images/file-icon.png" alt="">');

	$('#apply').on('click', function(event){
		event.preventDefault();

		var errorMsg = "<?= $this->lang->line('this_value_is_required'); ?>";
        var errorClass = ".showme";
        var e;
        var btn = $(this);

        e = $('#appname');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        e = $('#appphone');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        e = $('#appemail');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        if(!isEmail(e.val())){
            e.focus().parent().find(errorClass).html("<?= $this->lang->line('email_is_not_valid'); ?>").addClass('text-purple').show();
            return false;
        }

        e = $('#appmessage');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus().parent().find(errorClass).html(errorMsg).addClass('text-purple').show();
            return false;
        }

        e = $('#appvacancy');
        if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
            e.focus();
            $('#showmev').html(errorMsg).addClass('text-purple').show();
            return false;
        }

		var form = $(this).closest('form');
		var data = form.serializeArray();

		if(dz.files.length > 0){
	    	// dz.processQueue();
	    	// $('#max_file_error').html("<?= $this->lang->line('files_still_uploading') ?>");
	    	console.log("In");

	    	// dz.on('queuecomplete', function(file){
	    		// $('#max_file_error').html("");
	    		btn.attr("disabled" , "disabled");
				$.ajax({
					type: 'post',
					url: '<?= base_url('vacancy-apply'); ?>',
					data: data,
					success: function(msg){
						//console.log(msg);
						if(msg != 'false'){
							$('#join-btn').hide();
							dz.on('sending', function(file, xhr, formData){
				                formData.append('application_id', msg);
		            		});
							dz.processQueue();
							$('#max_file_error').html("<?= $this->lang->line('files_still_uploading') ?>");
							dz.on('queuecomplete', function(file){
								btn.removeAttr("disabled");
								$(form).trigger('reset');
								dz.removeAllFiles();  
								$('#max_file_error').html("");
								$('#join-msg').show();
							});
						}else{
							location.reload();
						}
					}
				});
			// });
		}
		else{
			btn.attr("disabled" , "disabled");
			$.ajax({
				type: 'post',
				url: '<?= base_url('vacancy-apply'); ?>',
				data: data,
				success: function(msg){
					//console.log(msg);
					if(msg != 'false'){
						$('#join-btn').hide();
						dz.on('sending', function(file, xhr, formData){
			                formData.append('application_id', msg);
	            		});
						// dz.processQueue();
						btn.removeAttr("disabled");
						$(form).trigger('reset'); 
						$('#join-msg').show();
					}else{
						location.reload();
					}
				}
			});
		}
	});
</script>
