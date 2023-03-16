<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Design Management <small>Control all designs and add-ons</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($questionnaire); ?>

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
        <h2>Customize Design Questionnaire <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form name="myform" method="post"
          action="<?= (isset($questionnaire)) ? base_url('admin/design/update-questionnaire') : base_url('admin/design/add-questionnaire'); ?>" 
          id="frm" 
          class="form-horizontal form-label-left">
          
          <input type="hidden" name="design_id" value="<?= $design['id']; ?>" />

          <div id="questions" class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="components">Questions <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
              <div>
                <label>
                  <input type="checkbox" 
                    name="language"
                    value="<?= isset($questionnaire['language']) ? $questionnaire['language'] : 0; ?>" 
                    <?= (isset($questionnaire['language']) && $questionnaire['language']==1) ? 'checked' : ''; ?>
                    class="js-switch" /> Choose Language
                </label>
              </div>
              
              <div>
                <label>
                  <input type="checkbox" 
                    name="measurement" 
                    value="<?= isset($questionnaire['measurement']) ? $questionnaire['measurement'] : 0; ?>" 
                    <?= (isset($questionnaire['measurement']) && $questionnaire['measurement']==1) ? 'checked' : ''; ?>
                    class="js-switch" /> Measurement
                </label>
              </div>

              <div>
                <label>
                  <input type="checkbox" 
                    name="content" 
                    value="<?= isset($questionnaire['content']) ? $questionnaire['content'] : 0; ?>"
                    <?= (isset($questionnaire['content']) && $questionnaire['content']==1) ? 'checked' : ''; ?> 
                    class="js-switch" /> Content same as
                </label>
              </div>

              <div>
                <label>
                  <input type="checkbox" 
                    name="textbox" 
                    value="<?= isset($questionnaire['textbox']) ? $questionnaire['textbox'] : 0; ?>" 
                    <?= (isset($questionnaire['textbox']) && $questionnaire['textbox']==1) ? 'checked' : ''; ?>
                    class="js-switch" /> Text box
                </label>
              </div>

              <div>
                <label>
                  <input type="checkbox" 
                    name="attachment" 
                    value="<?= isset($questionnaire['attachment']) ? $questionnaire['attachment'] : 0; ?>" 
                    <?= (isset($questionnaire['attachment']) && $questionnaire['attachment']==1) ? 'checked' : ''; ?>
                    class="js-switch" /> File attachment
                </label>
              </div>
            
            </div>
          </div>

          <!-- <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="components">Custom Question <span class="required"></span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button type="button" class="btn  btn-primary"><i class="fa fa-plus"></i> </button>
            </div>
          </div> -->

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <a href="<?= base_url('admin/design'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="<?= (isset($edit)) ? 'Save' : 'Save'; ?>" />
            </div>
          </div>

        </form>
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