<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>About Us <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php if($this->session->flashdata('error')){ ?>
  <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
  </div>
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
  </div>
<?php } ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (!empty($edit)) ? 'Edit' : 'Create' ?> About Us <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= base_url('admin/about/update'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(!empty($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

         <!--  <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upper_section_english">English Upper Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="upper_section_english" 
                id="upper_section_english"
                value="<?php if(!empty($edit)){ echo $edit['upper_section_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upper_section_arabic">Arabic Upper Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="upper_section_arabic" 
                id="upper_section_arabic"
                dir="rtl"
                value="<?php if(!empty($edit)){ echo $edit['upper_section_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div> -->

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upper_section_english">English Upper Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_english" name="upper_section_english" rows="5" class="form-control col-md-7 col-xs-12"><?php if(!empty($edit)){ echo $edit['upper_section_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upper_section_arabic">Arabic Upper Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_arabic" dir="rtl" name="upper_section_arabic" rows="5" class="form-control col-md-7 col-xs-12"><?php if(!empty($edit)){ echo $edit['upper_section_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle_section_english">English Middle Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_english" name="middle_section_english" rows="5" class="form-control col-md-7 col-xs-12"><?php if(!empty($edit)){ echo $edit['middle_section_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle_section_arabic">Arabic Middle Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="email_arabic" dir="rtl" name="middle_section_arabic" rows="5" class="form-control col-md-7 col-xs-12"><?php if(!empty($edit)){ echo $edit['middle_section_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lower_section_english">English Lower Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="l_section_english" name="lower_section_english" rows="5" class="form-control col-md-7 col-xs-12"><?php if(!empty($edit)){ echo $edit['lower_section_english'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lower_section_arabic">Arabic Lower Section <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="l_section_arabic" dir="rtl" name="lower_section_arabic" rows="5" class="form-control col-md-7 col-xs-12"><?php if(!empty($edit)){ echo $edit['lower_section_arabic'];} ?></textarea>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <input type="submit" class="btn btn-success" value="<?= (!empty($edit)) ? 'Update' : 'Create'; ?>" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // $(document).ready(function() {
  //   tinymce.init({
  //     selector: '#email_english',
  //     height: 350,
  //     theme: 'modern',
  //     menubar: false,
  //     branding: false
  //   });

  //   tinymce.init({
  //     selector: '#email_arabic',
  //     height: 350,
  //     theme: 'modern',
  //     menubar: false,
  //     branding: false,
  //     directionality: 'rtl',
  //     language: 'ar'
  //   });
  // });
</script>