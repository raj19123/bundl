<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Careers Management <small>Control all applications</small></h3>
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
        <h2>Applicant List <small></small></h2>
        <div class="nav navbar-right">
          <!-- <a href="<?= base_url('admin/careers/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vacancy</a> -->
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Application ID</th>
              <th>Vacancy Name</th>
              <th>Applicant</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Message</th>
              <th>Attachments</th>
              <th>Applied On</th>
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
                  <td><?= $vacancy['vacancy']; ?></td>
                  <td><?= $vacancy['name']; ?></td>
                  <td><?= $vacancy['email']; ?></td>
                  <td><?= $vacancy['phone']; ?></td>
                  <td><?= $vacancy['message']; ?></td>
                  <td><?php 
                    $file_ids = explode(',', $vacancy['attachments']);
                    $files = $this->db->where_in('id', $file_ids)->get('files');
                    if($files->num_rows() > 0){
                      $files = $files->result_array();
                      $link = base_url('uploads/vacancy/');
                      $file_list = '<ul>';
                      foreach ($files as $key => $file) {
                        $file_list .= '<li><a href="'.$link.$file['name'].'" target="_blank"> FILE-'.($key + 1).'</a></li>';
                      }
                      $file_list .= '</ul>';
                      echo $file_list;
                    }else{
                      echo 'Not Uploaded by Applicant';
                    }
                  ?></td>
                  <td><?= $vacancy['applied_on']; ?></td>
                  <td>
                      <!-- <a href="<?php //base_url('admin/careers/edit/') . $vacancy['id']; ?>"
                        class="btn btn-primary btn-xs"
                      ><i class="fa fa-edit"></i> Edit</a> -->

                      <!-- <a href="<?php //base_url('admin/careers/applications/delete/') . $vacancy['id']; ?>"
                        class="btn btn-danger btn-xs"
                      ><i class="fa fa-trash"></i> Delete</a> -->

                      <button onclick="deleteRecord(this)" 
                        type="button" 
                        data-table="vacancy_applications" 
                        data-id="<?= $vacancy['id']; ?>" 
                        data-url="<?= base_url('admin/careers/applications/delete'); ?>" 
                        data-images="yes"
                        data-path="./uploads/vacancy/"
                        data-column="attachments"
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

<script>
  $('#datatable').DataTable({
    "order": [[ 0, "desc" ]]
  });
</script>