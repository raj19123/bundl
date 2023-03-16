<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Testimonials <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Testimonials <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/testimonials/update') : base_url('admin/testimonials/add'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_english">English Description <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_english" name="description_english"><?php if(isset($edit)){ echo $edit['description_english']; } ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_arabic">Arabic Description <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_arabic" name="description_arabic"><?php if(isset($edit)){ echo $edit['description_arabic']; } ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stars">Stars <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="stars" id="stars" class="select2_single form-control validThis" tabindex="-1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5" selected="">5</option>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
            <?php if(isset($edit['stars'])){ ?>
              <script type="text/javascript">$("#stars").val("<?= $edit['stars']; ?>");</script>
            <?php } ?>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/testimonials'); ?>" class="btn btn-primary">Cancel</a>
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