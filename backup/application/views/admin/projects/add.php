<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Projects Management <small>Control all projects</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Projects <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post"  
          id="prjfrm" 
          action="" 
          enctype="multipart/form-data" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_english">English Name <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="name_english" 
                id="name_english"
                value="<?php if(isset($edit)){ echo $edit['name_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="name_english-error text-danger"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_arabic">Arabic Name <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="name_arabic" 
                id="name_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['name_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="name_arabic-error text-danger"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_english">English Description <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="description_english" name="description_english"><?php if(isset($edit)){ echo $edit['description_english'];} ?></textarea>
              <ul class="description_english-error text-danger"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_arabic">Arabic Description <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="description_arabic" name="description_arabic"><?php if(isset($edit)){ echo $edit['description_arabic'];} ?></textarea>
              <ul class="description_arabic-error text-danger"></ul>
            </div>
          </div>

          <div class="form-group">                   
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_url">Images <small>(jpeg,png,jpg)</small><span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="drzn" class="dropzone"></div>
                <div id="image_error" class=" text-danger"></div>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/projects'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" id="send" class="btn btn-success" value="<?= (isset($edit)) ? 'Update' : 'Create'; ?>" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  tinymce.init({
    selector: '#description_english',
    height: 350,
    theme: 'modern',
    menubar: false,
    branding: false
  });

  tinymce.init({
    selector: '#description_arabic',
    height: 350,
    theme: 'modern',
    menubar: false,
    branding: false,
    directionality: 'rtl',
    language: 'ar'
  });
});
</script>

<script>

//DropZone Script
var divID = "#drzn";
var existingFiles = '<?= !empty($images) ? json_encode($images) : ""; ?>';
var existingFilesPath = "<?= base_url('uploads/projects/'); ?>";
var iconPath = "<?= base_url('assets_user/images/file-icons/'); ?>";
var fileDeleteURL = "<?= base_url('admin/projects/delete-image'); ?>";

Dropzone.autoDiscover = false;
var pdz = new Dropzone(divID, {
        url: "<?= base_url('admin/projects/files-upload'); ?>",
        paramName: "files",
        maxFilesize: 5,
        acceptedFiles : '.png,.jpg,.jpeg',
        addRemoveLinks : true,
        dictRemoveFile : 'X',
        parallelUploads: 5,
        uploadMultiple: true,
        autoProcessQueue: false,
        previewsContainer: divID,
        init: function() {
            this.on('addedfile', function(file){
                this.options.addRemoveLinks = true;
                this.options.dictRemoveFile = 'X';
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
                var old_file_ids = "<?= isset($edit['images']) ? $edit['images'] : ''; ?>";
                formData.append('existingFiles', old_file_ids);
            });
            this.on("success", function(file, filename) { 
                this.options.addRemoveLinks = false;
                this.options.dictRemoveFile = '';
            });
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("completemultiple", function (file) {
              if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                  window.location = "<?= base_url('admin/projects'); ?>";
              }
            });
              //if(existingFiles){
                this.on("removedfile", function(file) {
                    if (this.files.length == 0) {
                      var project_id = "<?= isset($edit['id']) ? $edit['id'] : ''; ?>";
                      $.post(fileDeleteURL, {
                        'fileName': file.name,
                        'project_id':project_id
                      });
                    } 
                });   
            //} 
        }// end init function
    });

        //load and display existing files in dropzone
        if(existingFiles){
            var existingFiles = JSON.parse(existingFiles); 
            //console.log(existingFiles.length);
            //console.log(dzone.options.maxFiles);
            
            for(let i = 0; i < existingFiles.length; i++) {
                let existedFile = existingFiles[i];
                // Create the mock file:
                var mockFile = {name: existedFile.name, size: existedFile.size, url: existedFile.url};
                var extension = existedFile.name.substr( (existedFile.name.lastIndexOf('.') +1) );
                pdz.options.addedfile.call(pdz, mockFile);
                //console.log(extension);
                if(extension == 'pdf'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'pdf-icon.png');
                }else if(extension == 'docx'){ 
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'docx-icon.png');
                }else if(extension == 'doc'){ 
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'docx-icon.png');
                }else if(extension == 'xlsx'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'xlsx-icon.png');
                }else if(extension == 'xls'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'xlsx-icon.png');
                }else if(extension == 'ppt'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'ppt-icon.png');
                }else if(extension == 'pptx'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'ppt-icon.png');
                }else if(extension == 'txt'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'txt-icon.png');
                }else if(extension == 'psd'){
                    pdz.options.thumbnail.call(pdz, mockFile, iconPath+'psd-icon.png');
                }else{
                    pdz.emit("thumbnail", mockFile, existingFilesPath+existedFile.url);
                }
                pdz.emit("complete", mockFile);
                //var existingFileCount = i; // The number of files already uploaded
                //pdz.options.maxFiles = pdz.options.maxFiles - existingFiles.length;
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete');
            }
        }


//submit button
$("#send").on('click', function(e) { 
  e.preventDefault();

  var validation = false;
  selectedInputs = ['name_english', 'name_arabic'];
  validation = validateFields(selectedInputs);
  
  /*if(pdz.files.length == 0){
    if (pdz.getQueuedFiles().length == 0) { 
      var errorMsg = "This image is required";
      $('#image_error').html(errorMsg);           
      validation = false;
      return false;
    }
  }*/

  tinymce.triggerSave();
  var prjData = $('#prjfrm').serializeArray();
  //console.log(prjData);
  var full_url = "<?= isset($edit) ? base_url('admin/projects/update') : base_url('admin/projects/add') ;?>";
  if (validation == true) {
    $.ajax({
      type: "post",
      url: full_url,
      data:prjData,
      success: function(data) {
        //console.log(data);
        objData = $.parseJSON(data);
        if(objData.error == false){
          if(objData.project_id){
            pdz.on('sending', function(file, xhr, formData){
                formData.append('project_id', objData.project_id);
            });

            if (pdz.getQueuedFiles().length > 0) {                        
                pdz.processQueue();
            } else {                       
                window.location = "<?= base_url('admin/projects'); ?>";
            }
          }
        }else{
          console.log(objData);
        }
      }
    });
  }
});

</script>