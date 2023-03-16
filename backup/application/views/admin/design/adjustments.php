<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Design Management <small>Control all designs and add-ons</small></h3>
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

<div id="result"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= isset($design['name_english']) ? $design['name_english'] : 'Design'; ?> <small>Customize adjustments</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form name="myform" method="post"
          action="<?= base_url('admin/design/add-adjustments'); ?>" 
          id="frm" 
          class="form-horizontal form-label-left">
          
          <input type="hidden" name="design_id" value="<?= $design['id']; ?>" />
          <input type="hidden" name="the_id" value="" id="the_id" />

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adjustment_id">Available Adjustments <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="adjustment_id" id="adjustment_id" class="select2_single form-control validThis" tabindex="-1">
                <option value="" selected="selected" disabled="disabled">Choose</option>
                <?php
                if(isset($adjustments)){
                  foreach ($adjustments as $k => $adjustment) {
                    ?>
                    <option value="<?= $adjustment['id']; ?>"><?= $adjustment['name_english']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="category" id="category" class="select2_single form-control validThis" tabindex="-1">
                <option value="" selected="selected" disabled="disabled">Choose</option>
                <option value="main">What would you like to change?</option>
                <option value="extras">Extras</option>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" 
                  name="price" 
                  id="price"
                  value="<?php if(isset($edit)){ echo $edit['price'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                  class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time_limit">Time Limit (days) <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" 
                  name="time_limit" 
                  id="time_limit"
                  value="<?php if(isset($edit)){ echo $edit['time_limit'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                  class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

          <div id="questions" class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="components">Options <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">

              <div>
                <label>
                  <input type="checkbox" 
                    id="tt_box"
                    name="textbox" 
                    value="<?= isset($questionnaire['textbox']) ? $questionnaire['textbox'] : 0; ?>" 
                    <?= (isset($questionnaire['textbox']) && $questionnaire['textbox']==1) ? 'checked' : ''; ?>
                    class="js-switch" /> Text box
                </label>
              </div>

              <div>
                <label>
                  <input type="checkbox" 
                    id="tt_ment"
                    name="attachment" 
                    value="<?= isset($questionnaire['attachment']) ? $questionnaire['attachment'] : 0; ?>" 
                    <?= (isset($questionnaire['attachment']) && $questionnaire['attachment']==1) ? 'checked' : ''; ?>
                    class="js-switch" /> File attachment
                </label>
              </div>
            
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/design'); ?>" class="btn btn-primary">Back</a>
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
        <h2>Adjustment Detail <small>Adjustments for selected design</small></h2>
        <!-- <div class="nav navbar-right">
          <h2>Total Package Power: <?= $total_package_power; ?> TH/s</h2>
        </div> -->
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Adjustment</th>
              <th>Category</th>
              <th>Price</th>
              <th>Time Limit (days)</th>
              <th>Textbox</th>
              <th>Attachment</th>
              <th>Updated On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($design_adjustments)) && !(empty($design_adjustments)) ){
              foreach ($design_adjustments as $key => $detail) {
                ?>
                <tr>
                  <td><?= $detail['adjustment_name_english']; ?></td>
                  <td><?= $detail['adjustment_category']; ?></td>
                  <td><?= $detail['price']; ?></td>
                  <td><?= $detail['time_limit']; ?></td>
                  <td><?= ($detail['textbox'] == 1) ? 'On' : 'Off'; ?></td>
                  <td><?= ($detail['attachment'] == 1) ? 'On' : 'Off'; ?></td>
                  <td><?= $detail['updated_on']; ?></td>
                  <td>
                    <a href="<?= base_url('admin/design/remove-adjustments/') . $detail['design_id'] . '/' . $detail['adjustment_id']; ?>" 
                      class="btn btn-danger btn-xs"
                    ><i class="fa fa-trash"></i> Remove</a>
                    <button onclick="update_request(this);" class="btn btn-primary btn-xs" data-design="<?= $detail['design_id']; ?>" data-adjustment="<?= $detail['adjustment_id']; ?>"><i class="fa fa-edit"></i> Edit</button>
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
$(document).ready(function() {
  $('input[type=checkbox]').on('change', function(){
    this.value = this.checked ? 1 : 0;
    //console.log(this.value);
  }).change();

}).change();
</script>

<script type="text/javascript">
  var base_url = '<?= base_url(); ?>';

  function update_request(e) {

    var designId = $(e).data("design");
    var adjustmentId = $(e).data("adjustment");

    $.ajax({
        url: base_url + "admin/design/edit_adjustments",
        type: "post",
        data: {
            'design_id': designId,
            'adjustment_id': adjustmentId
        },
        success: function(response) {
            var data = $.parseJSON(response);
            console.log(data);
            if (((data.textbox == 1) && ($('#tt_box').prop("checked") == false)) || ((data.textbox == 0) && ($('#tt_box').prop("checked") == true))) {
              jQuery('#tt_box').trigger('click');
            }
            if (((data.attachment == 1) && ($('#tt_ment').prop("checked") == false)) || ((data.attachment == 0) && ($('#tt_ment').prop("checked") == true))) {
              jQuery('#tt_ment').trigger('click');
            }

            // $('#adjustment_id').find(":selected").attr("selected",false);
            // $('#category').find(":selected").attr("selected",false);

            $('#adjustment_id').find("option[value='"+data.adjustment_id+"']").attr("selected",true);
            $('#category').find("option[value='"+data.category+"']").attr("selected",true);
            $('#price').attr('value',data.price);
            $('#the_id').attr('value',data.id);
            $('#time_limit').attr('value',data.time_limit);
            $('input[type=submit]').attr('value','Edit');
            $('html, body').animate({
                scrollTop: $("#result").offset().top
            }, 200);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
  }
</script>