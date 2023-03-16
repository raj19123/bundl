<!-- Design Management start -->
<div class="page-title">
  <div class="title_left">
    <h3>Order Management <small></small></h3>
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
        <h2>Order List <small></small></h2>
        <div class="nav navbar-right">
          
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="show-order" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Project Name</th>
              <th>Customer Name</th>
              <th>Total Amount</th>
              <th>Amount Paid</th>
              <!-- <th>Total Time</th> -->
              <!-- <th>Transaction ID</th> -->
              <!-- <th>Payment Status</th> -->
              <th>Order Status</th>
              <th>Purchased Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($list)) && !(empty($list)) ){
              foreach ($list as $key => $order) {
                $customer = $this->db->get_where('users', ['id' => $order['user_id']])->row_array();
                ?>
                <tr>
                  <td><?= $order['id']; ?></td>
                  <td><?= $order['project_name']; ?></td>
                  <td><?= $customer['full_name']; ?></td>
                  <td><?= $order['grand_total']; ?></td>
                  <td><?= $order['total_amount']; ?></td>
                  <!-- <td><?php // $order['total_time']; ?></td> -->
                  <!-- <td><?= $order['trans_id']; ?></td> -->
                  <!-- <td><?php// ($order['payment_status'] == 1) ? 'Completed' : 'Pending'; ?></td> -->
                  <td>
                    <?php 
                    switch ($order['order_status']) {
                      case 0:
                        echo 'questionnaire required';
                        break;
                      case 1:
                        echo 'in process';
                        break;
                      case 2:
                        echo 'completed';
                      
                      default:
                        echo '';
                        break;
                    }
                  ?>
                  </td>
                  <!-- <td><?php //$order['created_on']; ?></td> -->
                  <td><?= $order['purchase_date']; ?></td>
                  <td>
                    <?php $complete_button = true;
                    $order_items_list = $this->db->get_where('order_items', ['order_id' => $order['id']])->result_array();
                    foreach ($order_items_list as $key1 => $order_item) {
                      if ($order_item['status'] != 3 && $order_item['item_type'] != 'package') {
                        $complete_button = false;
                      }
                    } 
                    if (($complete_button == true) && ($order['order_status'] != 2)) { ?>
                      <a href="<?= base_url('admin/orders/complete/') . $order['id']; ?>"
                        class="btn btn-primary btn-xs"
                      ><i class="fa fa-check"></i> Complete</a>
                    <?php } ?>
                      <a href="<?= base_url('admin/orders/detail/') . $order['id']; ?>"
                        class="btn btn-info btn-xs"
                      ><i class="fa fa-info"></i> Detail</a>

                      <a href="<?= base_url('admin/orders/transaction/') . $order['id']; ?>"
                        class="btn btn-success btn-xs"
                      ><i class="fa fa-money"></i> Transaction</a>

                      <a href="javascript:void(0)"
                        class="btn btn-danger btn-xs"
                        onclick="delete_order(<?= $order['id'] ?>)" 
                      ><i class="fa fa-trash"></i> Delete</a>

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

    $(document).ready(function() {
        $('#show-order').DataTable({
            "order": [[ 6, "desc" ]]
        });
    });
    function delete_order(order_id){
        swal({
            title: "Are you sure?",
            text: "You are going to delete the order. This action can not be undone.",
            type: "warning",
            confirmButtonText: "<?= $this->lang->line('continue'); ?>",
            confirmButtonClass: '',
            showCancelButton: true,
            cancelButtonText: "<?= $this->lang->line('cancel'); ?>",
            cancelButtonClass: ''
        },function(isConfirm) {
            if (isConfirm) {
                window.location.href =  "<?= base_url('admin/orders/delete/') ?>"+order_id;
            }
        });
    }
</script>