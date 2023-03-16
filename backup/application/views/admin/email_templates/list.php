<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Email Templates Management <small></small></h3>
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
        <h2>Email Templates List <small></small></h2>
        <div class="nav navbar-right">
          <!-- <a href="<?= base_url('admin/email/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Email Template</a> -->
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>English Subject</th>
              <th>Arabic Subject</th>
              <th>Slug</th>
              <th>English Email Body</th>
              <th>Arabic Email Body</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $email) {
                ?>
                <tr>
                  <td><?= $email['id']; ?></td>
                  <td><?= $email['email_subject_english']; ?></td>
                  <td><?= $email['email_subject_arabic']; ?></td>
                  <td><?= $email['slug']; ?></td>
                  <td><?= $email['email_body_english']; ?></td>
                  <td><?= $email['email_body_arabic']; ?></td>
                  <td>
                    <a href="<?= base_url('admin/email/edit/') . $email['id']; ?>" 
                      class="btn btn-primary btn-xs"
                    ><i class="fa fa-edit"></i> Edit</a>

                    <!-- <a href="<?php //base_url('admin/email/delete/') . $email['id']; ?>" 
                      class="btn btn-danger btn-xs"
                    ><i class="fa fa-trash"></i> Delete</a> -->

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