<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Package Management <small>Control all packages</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($design_adjustments); ?>

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
        <h2><?= isset($component['name_english']) ? $component['name_english'] : 'Component'; ?> <small>Customize component designs</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form name="myform" method="post"
          action="<?= base_url('admin/package/components/update-designs'); ?>" 
          id="frm" 
          class="form-horizontal form-label-left">
          
          <input type="hidden" name="component_id" value="<?= $component['id']; ?>" />

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="design_id">Available Designs <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="design_id" id="design_id" class="select2_single form-control validThis" tabindex="-1">
                <option value="" selected="selected" disabled="disabled">Choose</option>
                <?php
                if(isset($designs)){
                  foreach ($designs as $k => $design) {
                    ?>
                    <option value="<?= $design['id']; ?>"><?= $design['name_english']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">Quantity <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" 
                name="quantity" 
                id="quantity"
                value="<?php if(isset($edit)){ echo $edit['quantity'];} ?>" 
                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/package/components'); ?>" class="btn btn-primary">Back</a>
              <input type="submit" class="btn btn-success" value="Add" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Designs Detail <small>Designs for selected component</small></h2>
        <!-- <div class="nav navbar-right">
          <h2>Total Package Power: <?= $total_package_power; ?> TH/s</h2>
        </div> -->
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Design ID</th>
              <th>Design Name</th>
              <th>Quantity</th>
              <th>Updated On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($selected_designs)) && !(empty($selected_designs)) ){
              foreach ($selected_designs as $key => $detail) {
                ?>
                <tr>
                  <td><?= $detail['design_id']; ?></td>
                  <td><?= $detail['design_name']; ?></td>
                  <td><?= $detail['quantity']; ?></td>
                  <td><?= $detail['updated_on']; ?></td>
                  <td>
                    <a href="<?= base_url('admin/package/components/remove-designs/') . $detail['component_design_id'] .'/'.$detail['component_id']; ?>" 
                      class="btn btn-danger btn-xs"
                    ><i class="fa fa-trash"></i> Remove</a>
                  </td>
                </tr>
                <?php
              }
            }
            ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#design_id").select2();
</script>