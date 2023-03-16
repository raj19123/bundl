<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Package Management <small>Control all packages</small></h3>
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

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> package category <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/package/categories/update') : base_url('admin/package/categories/add'); ?>"
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
              <ul class="parsley-errors-list"></ul>
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
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <?php //print_r($file); ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icon">Icon <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="icon" class="" accept=".ico, .png, .jpg" />
              <?php if(isset($file)){ ?>
                <input type="hidden" name="old_file" value="<?= $file['name']; ?>">
                <img src="<?= base_url('uploads/icons/' . $file['name']); ?>" height="72" width="72" style="margin-top: 15px">
              <?php } ?>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/package/categories'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="<?= (isset($edit)) ? 'Update' : 'Create'; ?>" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>