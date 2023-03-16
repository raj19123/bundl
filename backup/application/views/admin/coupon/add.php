<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Coupon Management <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Coupon <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/coupon/update') : base_url('admin/coupon/add'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                autofocus 
                name="code" 
                id="code"
                value="<?php if(isset($edit)){ echo $edit['code'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount (%) <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="discount" 
                id="discount"
                maxlength="3"
                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                value="<?php if(isset($edit)){ echo $edit['discount'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="banner_text_english">Banner Text English <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="banner_text_english" 
                id="banner_text_english"
                value="<?php if(isset($edit)){ echo $edit['banner_text_english'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="banner_text_arabic">Banner Text Arabic <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"
                name="banner_text_arabic" 
                id="banner_text_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['banner_text_arabic'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expiry">Expire Date <span class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class='input-group date' id='expiryPicker'>
                <input type='text' 
                  name="expiry" 
                  value="<?php if(isset($edit)){ echo $edit['expiry'];} ?>" 
                  readonly="readonly" 
                  class="form-control" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Usage per coupon</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number"
                name="usage_per_coupon"
                value="<?php if(isset($edit)){ echo $edit['usage_per_coupon'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Usage per customer</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number"
                name="usage_per_customer" 
                value="<?php if(isset($edit)){ echo $edit['usage_per_customer'];} ?>"
                class="form-control col-md-7 col-xs-12 parsley-success" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Customers </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="applicable_on_customers[]" class="select2 form-control" multiple tabindex="-1">
                <option value="" disabled="disabled">Choose</option>
                <?php if(!empty($users)){ if(isset($edit)){ $customers = explode(',', $edit['applicable_on_customers']);} foreach ($users as $u_key => $u_val) { ?>
                    <option <?= (isset($edit) && in_array($u_val['id'], $customers))?'selected':''; ?>  value="<?= $u_val['id'] ?>"><?= $u_val['full_name']."(".$u_val['email'].")" ?></option>
                <?php }} ?>
              </select>
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
              <a href="<?= base_url('admin/coupon'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="<?= (isset($edit)) ? 'Update' : 'Create'; ?>" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
  <?php  if(isset($edit)){ ?>
    var date = "<?= (date('Y-m-d' , strtotime($edit['expiry'])) < date('Y-m-d'))?date('Y-m-d' , strtotime($edit['expiry'])):date('Y-m-d') ?>";
  <?php }else{ ?>
    var date = "<?= date('Y-m-d') ?>";
  <?php } ?>

    $('#expiryPicker').datetimepicker({
      format: 'YYYY-MM-DD',
      ignoreReadonly: true,
      allowInputToggle: true,
      // date: date,
      minDate: moment(date),
      keepInvalid: false
    });
    // datepicker.datepicker("setDate", date);
    $('.select2').select2({
        placeholder: "Choose",
    });
  });
</script>