<div class="page-title">
  <div class="title_left">
    <h3>Order Transaction <small></small></h3>
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

<a href="<?= base_url('admin/orders'); ?>" style="float: right;" class="btn btn-primary">Back</a>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Transaction Detail <small></small></h2>
        <div class="nav navbar-right">
          
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="show-order" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Amount</th>
              <th>Currency</th>
              <th>Status</th>
              <th>Message</th>
              <th>Card Type</th>
              <th>Card Scheme</th>
              <th>Transaction Id</th>
              <th>Transaction Time</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($trans)) && !(empty($trans)) ){
              foreach ($trans as $key => $val) {
                ?>
                <tr>
                  <td><?= $val['name']; ?></td>
                  <td><?= $val['cart_amount']; ?></td>
                  <td><?= $val['cart_currency']; ?></td>
                  <!-- <td><?= $val['tran_type']; ?></td> -->
                  <td><?= $val['response_status']; ?></td>
                  <td><?= $val['response_message']; ?></td>
                  <!-- <td><?= $val['acquirer_message']; ?></td> -->
                  <td><?= $val['card_type']; ?></td>
                  <td><?= $val['card_scheme']; ?></td>
                  <td><?= $val['cart_id']; ?></td>
                  <td><?= $val['transaction_time']; ?></td>
                  <!-- <td><?= $val['cart_description']; ?></td> -->
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

    $(document).ready(function() {
        $('#show-order').DataTable({
            "order": [[ 7, "desc" ]]
        });
    });
</script>