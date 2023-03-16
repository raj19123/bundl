<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Terms & Conditions <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Terms & Conditions <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/terms/update') : base_url('admin/terms/add'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="summary_english">English Summary <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="summary_english" 
                id="summary_english"
                value="<?php if(isset($edit)){ echo $edit['summary_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="summary_arabic">Arabic Summary <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="summary_arabic" 
                id="summary_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['summary_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail_english">English terms of use <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_english" name="detail_english"><?php if(isset($edit)){ echo $edit['detail_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail_arabic">Arabic terms of use <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_arabic" name="detail_arabic"><?php if(isset($edit)){ echo $edit['detail_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/terms'); ?>" class="btn btn-primary">Cancel</a>
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