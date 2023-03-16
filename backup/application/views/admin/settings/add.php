<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Settings <small>general settings of the project</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

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

<!-- home vedio settings -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Vedio <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post"   
          action="<?= base_url('admin/settings/update'); ?>" 
          enctype="multipart/form-data" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Home Page Video <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <?php if(isset($edit) && $edit['video_home_page']){ ?>
                <video width="400" height="200" controls>
                  <source src="<?= base_url('uploads/settings/') . $edit['video_home_page']; ?>" type="video/mp4">
                </video>
              <?php } ?>
              <input type="file" name="video_home_page" accept="video/mp4" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <!-- <a href="<?php //base_url('admin/projects'); ?>" class="btn btn-primary">Cancel</a> -->
              <input type="submit" class="btn btn-success" value="Update" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- social media links -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Social Media Links <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post"   
          action="<?= base_url('admin/settings/social-update'); ?>" 
          enctype="multipart/form-data" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_arabic">Facebook </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="facebook"
                value="<?php if(isset($edit)){ echo $edit['facebook'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success" />
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="instagram"
                value="<?php if(isset($edit)){ echo $edit['instagram'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success" />
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="linked_in">Linked In </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="linked_in"
                value="<?php if(isset($edit)){ echo $edit['linked_in'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success" />
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter">Twitter </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="twitter"
                value="<?php if(isset($edit)){ echo $edit['twitter'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success" />
            </div>
          </div>

          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <!-- <a href="<?php //base_url('admin/projects'); ?>" class="btn btn-primary">Cancel</a> -->
              <input type="submit" class="btn btn-success" value="Update" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>