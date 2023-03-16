<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Profile Management <small>Set all your preferences</small></h3>
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
        <h2>Change Password <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= base_url('admin/profile/password/update'); ?>"
          class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"
                autofocus 
                name="password" 
                id="password"
                value=""
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_password">New Password <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"
                name="new_password" 
                id="new_password"
                value=""
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">Confirm Password <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"
                name="confirm_password" 
                id="confirm_password"
                value=""
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="Update" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>