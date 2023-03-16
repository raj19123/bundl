<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Careers Management <small>Control all vacancies</small></h3>
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
        <h2>Vacancy List <small></small></h2>
        <div class="nav navbar-right">
          <a href="<?= base_url('admin/careers/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vacancy</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Vacancy</th>
              <th>Status</th>
              <th>Description</th>
              <th>Qualification</th>
              <th>Created On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $vacancy) {
                ?>
                <tr>
                  <td><?= $vacancy['id']; ?></td>
                  <td><?= $vacancy['vacancy_english']; ?></td>
                  <td><?= ($vacancy['status'] == 1) ? 'Live' : 'Draft'; ?></td>
                  <td><?= $vacancy['description_english']; ?></td>
                  <td><?= $vacancy['qualification_english']; ?></td>
                  <td><?= $vacancy['created_on']; ?></td>
                  <td>
                      <a href="<?= base_url('admin/careers/edit/') . $vacancy['id']; ?>"
                        class="btn btn-primary btn-xs"
                      ><i class="fa fa-edit"></i> Edit</a>

                      <!-- <a href="<?php //base_url('admin/careers/delete/') . $vacancy['id']; ?>"
                        class="btn btn-danger btn-xs"
                      ><i class="fa fa-trash"></i> Delete</a> -->

                      <button onclick="deleteRecord(this)" 
                        type="button" 
                        data-table="careers" 
                        data-id="<?= $vacancy['id']; ?>" 
                        data-url="<?= base_url('admin/careers/delete'); ?>" 
                        data-images="no"
                        class="btn btn-danger btn-xs" 
                        title="Delete"><i class="fa fa-trash"></i> Delete</button> 

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