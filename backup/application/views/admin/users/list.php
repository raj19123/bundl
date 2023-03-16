<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>User Management <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>
<div id="result"></div>
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
        <h2>User List <small></small></h2>
        <div class="nav navbar-right">
          
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Location</th>
              <th>Register Since</th>
              <th>Status</th>
              <th>Email Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $user) {
                ?>
                <tr>
                  <td><?= $user['id']; ?></td>
                  <td><?= $user['full_name']; ?></td>
                  <td><?= $user['email']; ?></td>
                  <td><?= $user['phone']; ?></td>
                  <td><?= $user['location']; ?></td>
                  <td><?= $user['registered_on']; ?></td>
                  <td><?= ($user['status'] == 1) ? 'Active' : 'Blocked'; ?></td>
                  <td><?= ($user['email_verification_status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                  <td>
                    <?php if($user['status'] == 1): ?>
                      <a href="<?= base_url('admin/users/block/') . $user['id']; ?>"
                        class="btn btn-danger btn-xs"
                      ><i class="fa fa-ban"></i> Block</a>
                    <?php else:; ?>
                      <a href="<?= base_url('admin/users/unblock/') . $user['id']; ?>"
                        class="btn btn-primary btn-xs"
                      ><i class="fa fa-child"></i> Unblock</a>
                    <?php endif; ?>
                    <?php if ($user['email_verification_status'] == 0) : ?>
                        <button onclick="update_request(this);" id="<?= $user['id']; ?>" title="Approve" class="btn btn-success btn-xs" type="button"><i class="fa fa-check-square-o"></i> Approved</button>
                        <?php $i++; ?>
                    <?php else : ?>
                        <!-- <button title="Approved" class="fa fa-check-square-o btn btn-default btn-sm disabled" type="button"></button> -->
                    <?php endif; ?>

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
  var base_url = '<?= base_url(); ?>';

  function update_request(e) {
      var id = $(e).attr('id');

      $.ajax({
          url: base_url + "admin/update_request",
          type: "post",
          data: {
              'user_id': id
          },
          success: function(response) {
              var data = $.parseJSON(response);
              // You will get response from your PHP page (what you echo or print)
              if (data.status == true) {
                  $(e).css('display', 'none');
                  $(e).closest('td').prev().text('Active');
                  // $(e).removeClass('btn-success');
                  $('#result').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Approved now.</div>');
                  // $(e).addClass('disabled');
                  // // $(e).html('Approved');
                  // $(e).prop('Approved');
                  // $(e).addClass('btn-default');
              } else {
                  $('#result').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Invalid request found.</div>');
              }
              console.log(data)
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }
      });

  }
</script>