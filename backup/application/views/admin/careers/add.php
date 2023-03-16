<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Careers Management <small>Control all career vacancies</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Vacancy <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post"
          action="<?= (isset($edit)) ? base_url('admin/careers/update') : base_url('admin/careers/add'); ?>"  
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacancy_english">English Vacancy Name<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="vacancy_english"
                id="vacancy_english"
                value="<?php if(isset($edit)){ echo $edit['vacancy_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacancy_arabic">Arabic Vacancy Name<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="vacancy_arabic"
                id="vacancy_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['vacancy_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_english">English Vacancy Description <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="description_english" name="description_english"><?php if(isset($edit)){ echo $edit['description_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_arabic">Arabic Vacancy Description <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="description_arabic" name="description_arabic"><?php if(isset($edit)){ echo $edit['description_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qualification_english">English Qualification <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="qualification_english" name="qualification_english"><?php if(isset($edit)){ echo $edit['qualification_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qualification_arabic">Arabic Qualification <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="qualification_arabic" name="qualification_arabic"><?php if(isset($edit)){ echo $edit['qualification_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="status" id="status" class="select2_single form-control validThis" tabindex="-1">
                <option value="" selected="selected" disabled="disabled">Choose</option>
                <option value="0">Draft</option>
                <option value="1">Live</option>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
            <?php if(isset($edit['status'])){ ?>
              <script type="text/javascript">$("#status").val("<?= $edit['status']; ?>");</script>
            <?php } ?>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/careers'); ?>" class="btn btn-primary">Cancel</a>
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
    selector: '#description_english',
    height: 350,
    theme: 'modern',
    menubar: false,
    branding: false
  });

  tinymce.init({
    selector: '#qualification_english',
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

  tinymce.init({
    selector: '#qualification_arabic',
    height: 350,
    theme: 'modern',
    menubar: false,
    branding: false,
    directionality: 'rtl',
    language: 'ar'
  });

});
</script>