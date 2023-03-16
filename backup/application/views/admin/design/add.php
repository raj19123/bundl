<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Design Management <small>Control all designs and add-ons</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Design <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form style="max-width: 700px; margin: auto;" method="post" 
          action="<?= (isset($edit)) ? base_url('admin/design/update') : base_url('admin/design/add'); ?>" 
          id="" 
          class="form-horizontal form-label-left">
          
          <?php if(isset($edit)){ ?>
            <input type="hidden" name="id" value="<?= $edit['id']; ?>" />
          <?php } ?>

          <div class="well">
            <label style="display: block; text-align: center; margin-bottom: 24px;" >Basic Properties</label>
            <div class="form-group">
              <label class="control-label" for="name_english">English Name <span class="required">*</span></label>
              <div class="">
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
              <label class="control-label" for="name_arabic">Arabic Name <span class="required">*</span></label>
              <div class="">
                <input type="text"
                  name="name_arabic" 
                  id="name_arabic"
                  dir="rtl"
                  value="<?php if(isset($edit)){ echo $edit['name_arabic'];} ?>"
                  class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <?php if(isset($edit)) { ?>
              <div class="form-group">
                <label class="control-label" for="slug">Slug </label>
                <div class="">
                  <input type="text" 
                    disabled="disabled" 
                    name="slug" 
                    id="slug" 
                    value="<?php if(isset($edit)){ echo $edit['slug'];} ?>"
                    class="form-control col-md-7 col-xs-12 parsley-success" />
                  <ul class="parsley-errors-list"></ul>
                </div>
              </div>
            <?php } ?>

            <div class="form-group">
              <label class="control-label" for="category_id">Category <span class="required">*</span></label>
              <div class="">
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
              <label class="control-label" for="height">Default Height <span class="required"></span></label>
              <div class="">
                <input type="text" 
                  name="height" 
                  id="height"
                  value="<?php if(isset($edit)){ echo $edit['height'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                  class="form-control col-md-7 col-xs-12 parsley-success" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="width">Default Width <span class="required"></span></label>
              <div class="">
                <input type="text" 
                  name="width" 
                  id="width"
                  value="<?php if(isset($edit)){ echo $edit['width'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                  class="form-control col-md-7 col-xs-12 parsley-success" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="status">Unit <span class="required"></span></label>
              <div class="">
                <select name="unit" id="unit" class="select2_single form-control validThis" tabindex="-1">
                  <option value="inch" <?= (isset($edit) && $edit['unit'] == 'inch') ? 'selected' : ''; ?>>inch</option>
                  <option value="pixel" <?= (isset($edit) && $edit['unit'] == 'pixel') ? 'selected' : ''; ?>>pixel</option>
                  <option value="mm" <?= (isset($edit) && $edit['unit'] == 'mm') ? 'selected' : ''; ?>>mm</option>
                  <option value="cm" <?= (isset($edit) && $edit['unit'] == 'cm') ? 'selected' : ''; ?>>cm</option>
                </select>
                <ul class="parsley-errors-list"></ul>
              </div>
              <?php if(isset($edit['unit'])){ ?>
                <script type="text/javascript">$("#status").val("<?= $edit['unit']; ?>");</script>
              <?php } ?>
            </div>
          

            <div class="form-group">
              <label class="control-label" for="description_english">English Description</label>
              <div class="">
                <textarea name="description_english" 
                  id="description_english"
                  class="form-control col-md-7 col-xs-12 parsley-success" 
                  ><?php if(isset($edit)){ echo $edit['description_english'];} ?></textarea>
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="description_arabic">Arabic Description</label>
              <div class="">
                <textarea name="description_arabic" 
                  id="description_arabic" 
                  dir="rtl"
                  class="form-control col-md-7 col-xs-12 parsley-success" 
                  ><?php if(isset($edit)){ echo $edit['description_arabic'];} ?></textarea>
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="status">Status <span class="required">*</span></label>
              <div class="">
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
          </div>

          <div class="well">
            <label style="display: block; text-align: center; margin-bottom: 24px;" >Price & Time limit Control</label>
            <div class="form-group">
              <label class="control-label" for="price">Price <span class="required">*</span></label>
              <div class="">
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
              <label class="control-label" for="time">Time Limit (days) <span class="required">*</span></label>
              <div class="">
                <input type="text" 
                  name="time" 
                  id="time"
                  value="<?php if(isset($edit)){ echo $edit['time'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                  class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <?php if(isset($edit) && $edit['slug'] == 'logo') { ?>
              <div class="form-group">
                <label class="control-label" for="dual_lang_price">Dual Language Price <span class="required">*</span></label>
                <div class="">
                  <input type="text" 
                    name="dual_lang_price" 
                    id="dual_lang_price"
                    value="<?php if(isset($edit)){ echo $edit['dual_lang_price'];} ?>" 
                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                    class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                  <ul class="parsley-errors-list"></ul>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label" for="time">Dual Language Time Limit (days) <span class="required">*</span></label>
                <div class="">
                  <input type="text" 
                    name="dual_lang_time" 
                    id="dual_lang_time"
                    value="<?php if(isset($edit)){ echo $edit['dual_lang_time'];} ?>" 
                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                    class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                  <ul class="parsley-errors-list"></ul>
                </div>
              </div>
            <?php } ?>

            <div class="form-group">
              <label class="control-label" for="type">Measurement Type <span class="required">*</span></label>
              <div class="">
                <select name="type" id="type" class="select2_single form-control validThis" tabindex="-1">
                  <option value="" selected="selected" disabled="disabled">Choose</option>
                  <option value="page">Page</option>
                  <option value="fold">Fold</option>
                  <option value="side">Side</option>
                  <option value="quantity">Quantity</option>
                </select>
                <ul class="parsley-errors-list"></ul>
              </div>
              <?php if(isset($edit['type'])){ ?>
                <script type="text/javascript">$("#type").val("<?= $edit['type']; ?>");</script>
              <?php } ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="price_increment">Increment Price Percentage <span class="required">* (valid values form 0% to 999% without decimals)</span></label>
              <div class="">
                <input type="text"
                  name="price_increment"
                  id="price_increment"
                  value="<?php if(isset($edit)){ echo $edit['price_increment'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                  maxlength="3"
                  class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="time_increment">Increment Time Limit Percentage<span class="required">* (valid values form 0% to 999% without decimals)</span></label>
              <div class="">
                <input type="text" 
                  name="time_increment" 
                  id="time_increment"
                  value="<?php if(isset($edit)){ echo $edit['time_increment'];} ?>" 
                  oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                  maxlength="3"
                  class="form-control col-md-7 col-xs-12 parsley-success validThis" />
                <ul class="parsley-errors-list"></ul>
              </div>
            </div>

          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class=" col-md-offset-3">
              <a href="<?= base_url('admin/design'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="<?= (isset($edit)) ? 'Update' : 'Create'; ?>" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>