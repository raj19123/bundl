<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Package Management <small>Control all packages</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //print_r($edit); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?= (isset($edit)) ? 'Edit' : 'Create' ?> Package Component<small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="post" 
          action="<?= (isset($edit)) ? base_url('admin/package/components/update') : base_url('admin/package/components/add'); ?>" 
          id="" 
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

          <?php if(isset($edit)) { ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Sort Order <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" 
                name="sort_order" 
                id="sort_order"
                value="<?php if(isset($edit)){ echo $edit['sort_order'];} ?>" 
                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slogan_english">English Slogan<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" 
                name="slogan_english" 
                id="slogan_english"
                value="<?php if(isset($edit)){ echo $edit['slogan_english'];} ?>" 
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slogan_arabic">Arabic Slogan<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" 
                name="slogan_arabic" 
                id="slogan_arabic"
                dir="rtl"
                value="<?php if(isset($edit)){ echo $edit['slogan_arabic'];} ?>" 
                class="form-control col-md-7 col-xs-12 parsley-success validThis" />
              <ul class="parsley-errors-list"></ul>
            </div>
          </div>

          <!-- <div class="form-group">
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
                    ><?= $cat['name']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <ul class="parsley-errors-list"></ul>
            </div>
          </div> -->

          <!-- <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designs">Designs <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="pillbox form-control validThis" name="designs[]" multiple="multiple" tabindex="-1">
                <?php
                /*if(isset($designs)){
                  foreach ($designs as $k => $design) {
                    ?>
                    <option value="<?= $design['id']; ?>"
                    <?php
                    if(isset($edit)){
                      if(isset($selected_designs) && !empty($selected_designs)){ 
                        foreach ($selected_designs as $key => $id) {
                          echo ($id['design_id'] == $design['id']) ? 'selected="selected"' : '';
                        }
                      }
                    }*/
                    ?>
                    ><?php //echo $design['name_english']; ?></option>
                    <?php
                  /*}
                }*/
                ?>
              </select>

              <script type="text/javascript">
                $(document).ready(function() {
                  $('.pillbox').select2();
                });
              </script>

              <ul class="parsley-errors-list"></ul>
            </div>
          </div> -->

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
              <a href="<?= base_url('admin/package/components'); ?>" class="btn btn-primary">Cancel</a>
              <input type="submit" class="btn btn-success" value="<?= (isset($edit)) ? 'Update' : 'Create'; ?>" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>