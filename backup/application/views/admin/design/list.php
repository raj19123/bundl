<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Design Management <small>Control all designs and add-ons</small></h3>
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
        <h2>Design List <small></small></h2>
        <div class="nav navbar-right">
          <a href="<?= base_url('admin/design/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Design</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>English Name</th>
              <th>Arabic Name</th>
              <th>Price</th>
              <th>Time Limit (days)</th>
              <th>Measurement Type</th>
              <th>Price Increment %</th>
              <th>Time Increment %</th>
              <th>Category</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $design) {
                ?>
                <tr>
                  <td><?= $design['name_english']; ?></td>
                  <td><?= $design['name_arabic']; ?></td>
                  <td><?= $design['price']; ?></td>
                  <td><?= $design['time']; ?></td>
                  <td><?= $design['type']; ?></td>
                  <td><?= $design['price_increment']; ?></td>
                  <td><?= $design['time_increment']; ?></td>
                  <td><?= $design['category_name_english']; ?></td>
                  <td><?= ($design['status'] == 1) ? 'Live' : 'Draft'; ?></td>
                  <td>
                    <a href="<?= base_url('admin/design/edit/') . $design['id']; ?>" 
                      class="btn btn-primary btn-xs"
                    ><i class="fa fa-edit"></i> Edit</a>

                    <!-- <a href="<?php //base_url('admin/design/delete/') . $design['id']; ?>" 
                      class="btn btn-danger btn-xs"
                    ><i class="fa fa-trash"></i> Delete</a> -->

                    <button onclick="deleteRecord(this)" 
                        type="button"
                        data-table="designs" 
                        data-id="<?= $design['id']; ?>" 
                        data-url="<?= base_url('admin/design/delete'); ?>" 
                        data-images="no"
                        class="btn btn-danger btn-xs" 
                        title="Delete"><i class="fa fa-trash"></i> Delete</button>

                    <a href="<?= base_url('admin/design/questionnaire/') . $design['id']; ?>" 
                      class="btn btn-info btn-xs"
                    ><i class="fa fa-question-circle"></i> Questionnaire</a>

                    <a href="<?= base_url('admin/design/adjustments/') . $design['id']; ?>" 
                      class="btn btn-warning btn-xs"
                    ><i class="fa fa-pencil-square-o"></i> Adjustments</a>

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