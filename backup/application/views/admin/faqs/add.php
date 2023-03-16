<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>FAQs Management <small>FAQ Control Panel</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> FAQs <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/faqs/update') : base_url('admin/faqs/add'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question_english">English Question <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="question_english" 
                id="question_english"
                value="<?php if(isset($edit)){ echo $edit['question_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question_arabic">Arabic Question <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="question_arabic" 
                id="question_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['question_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">Category <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="category_id" class="select2_single form-control validThis" tabindex="-1">
                <option value="" selected="selected" disabled="disabled">Choose</option>
                <?php
                if(isset($cats)){
                  foreach ($cats as $k => $cat) {
                    ?>
                    <option value="<?= $cat['id']; ?>"
                    <?php
                    if(isset($edit)){
                        echo ($edit['category_id'] == $cat['id']) ? 'selected="selected"' : '';
                    }
                    ?>
                    ><?= $cat['name_english']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="answer_english">English Answer <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="answer_english" name="answer_english"><?php if(isset($edit)){ echo $edit['answer_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="answer_arabic">Arabic Answer <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="answer_arabic" name="answer_arabic"><?php if(isset($edit)){ echo $edit['answer_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/faqs'); ?>" class="btn btn-primary">Cancel</a>
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
    selector: '#answer_english',
    height: 350,
    theme: 'modern',
    menubar: false,
    branding: false
  });

  tinymce.init({
    selector: '#answer_arabic',
    height: 350,
    theme: 'modern',
    menubar: false,
    branding: false,
    directionality: 'rtl',
    language: 'ar'
  });
});
</script>