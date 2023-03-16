<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Coupon Management <small></small></h3>
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
        <h2>Coupon List <small></small></h2>
        <div class="nav navbar-right">
          <a href="<?= base_url('admin/coupon/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Coupon</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Coupon Code</th>
              <th>Discount (%)</th>
              <th>Expiry Date</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $coupon) {
                ?>
                <tr>
                  <td><?= $coupon['id']; ?></td>
                  <td><?= $coupon['code']; ?></td>
                  <td><?= $coupon['discount']; ?></td>
                  <td><?= $coupon['expiry']; ?></td>
                  <td><?= ($coupon['status'] == 1) ? 'Live' : 'Draft'; ?></td>
                  <td><?= $coupon['created_at']; ?></td>
                  <td>
                    <a href="<?= base_url('admin/coupon/edit/') . $coupon['id']; ?>" 
                      class="btn btn-primary btn-xs"
                    ><i class="fa fa-edit"></i> Edit</a>

                    <!-- <a href="<?php //base_url('admin/coupon/delete/') . $coupon['id']; ?>" 
                      class="btn btn-danger btn-xs"
                    ><i class="fa fa-trash"></i> Delete</a> -->

                    <?php if($coupon['id'] != 8){ ?>

                    <button onclick="deleteRecord(this)"
                        type="button" 
                        data-table="coupons" 
                        data-id="<?= $coupon['id']; ?>" 
                        data-url="<?= base_url('admin/coupon/delete'); ?>" 
                        data-images="no"
                        class="btn btn-danger btn-xs" 
                        title="Delete"><i class="fa fa-trash"></i> Delete</button>
                    <?php } ?>
                    <?php if($coupon['status'] == 1){ ?>
                    <button class="btn btn-info btn-xs <?= ($coupon['show_on_web'] == "yes")?'disabled':''; ?>" onclick="show_on_web(this , <?= $coupon['id'] ?>)">Show On Web</button>
                    <?php } ?>

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
  function show_on_web(ref , id){
    $.ajax({
        type: 'post',
        url: '<?= base_url('admin/Coupon/show_coupon_on_web'); ?>',
        data: {"id":id},
        success: function(msg){
            location.reload();
        }
    });

  }
</script>