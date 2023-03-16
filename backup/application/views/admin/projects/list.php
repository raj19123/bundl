<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Projects Management <small>Control all projects</small></h3>
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
        <h2>Projects List <small></small></h2>
        <div class="nav navbar-right">
          <a href="<?= base_url('admin/projects/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Projects</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>English Name</th>
              <th>Arabic Name</th>
              <th>Hero Image</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $project) {
                ?>
                <tr>
                  <td><?= $project['id']; ?></td>
                  <td><?= $project['name_english']; ?></td>
                  <td><?= $project['name_arabic']; ?></td>
                  <td><?= ($project['hero_image']) ? "Yes" : "No"; ?></td>
                  <td><?= $project['created_at']; ?></td>
                  <td>
                      <a href="<?= base_url('admin/projects/edit/') . $project['id']; ?>"
                        class="btn btn-primary btn-xs"
                      ><i class="fa fa-edit"></i> Edit</a>

                      <!-- <a href="<?php //base_url('admin/projects/delete/') . $project['id']; ?>"
                        class="btn btn-danger btn-xs"
                      ><i class="fa fa-trash"></i> Delete</a> -->

                      <button onclick="deleteRecord(this)" 
                        type="button" 
                        data-table="projects" 
                        data-id="<?= $project['id']; ?>" 
                        data-url="<?= base_url('admin/projects/delete'); ?>" 
                        data-images="yes"
                        data-path="./uploads/projects/"
                        data-column="images"
                        class="btn btn-danger btn-xs" 
                        title="Delete"><i class="fa fa-trash"></i> Delete</button>

                      <a href="<?= base_url('admin/projects/hero-image/') . $project['id']; ?>"
                        class="btn btn-info btn-xs"><i class="fa fa-image"></i> Hero Image</a>

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