<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Email Templates Management <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Email Template <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/email/update') : base_url('admin/email/add'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_subject_english">English Subject <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="email_subject_english" 
                id="email_subject_english"
                value="<?php if(isset($edit)){ echo $edit['email_subject_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_subject_arabic">Arabic Subject <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="email_subject_arabic" 
                id="email_subject_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['email_subject_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <?php if(isset($edit)) { ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" 
                  disabled="disabled" 
                  name="slug" 
                  id="slug" 
                  value="<?php if(isset($edit)){ echo $edit['slug'];} ?>"
                  class="form-control col-md-7 col-xs-12 parsley-success" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_body_english">English Email Body <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_english" name="email_body_english"><?php if(isset($edit)){ echo $edit['email_body_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_body_arabic">Arabic Email Body <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_arabic" name="email_body_arabic"><?php if(isset($edit)){ echo $edit['email_body_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/email'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="<?= (isset($edit)) ? 'Update' : 'Create'; ?>" />
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
      selector: '#email_english',
      height: 350,
      theme: 'modern',
      menubar: false,
      branding: false
  });

    tinymce.init({
      selector: '#email_arabic',
      height: 350,
      theme: 'modern',
      menubar: false,
      branding: false,
      directionality: 'rtl',
      language: 'ar'
  });
});
</script>