<!-- Design Management start -->
<!-- 

Order Item Status:
  0: questionnaire is required
  1: in process
  2: ready for approval
  3: approved / done
  4: adjustments in process

 -->


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
<?php //print_r($package_detail); ?>

<!-- Order Item Management -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Order Item Management
          <small></small>
        </h2>
        <div class="nav navbar-right">
          <?php
          if($history 
            && $item['status'] != 3
            && $item['item_type'] != 'logo'
          ):
            ?>
            <a href="<?= base_url('approve-item-admin/'.$item['id'].'/'.$item['order_id']); ?>" class="btn btn-primary">Self Approve</a>
            <?php
          endif;
          ?>
          <a href="<?= base_url('admin/orders/detail/'.$item['order_id']); ?>" class="btn btn-info">Back</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <?php 
      if(isset($item['status'])):

        if(in_array($item['status'], [1,4])):
        ?>
          <div class="x_content">
            <p>Drag multiple files to the box below for multi upload or click to select files.</p>
            <form action="<?= base_url('admin/orders/delivery-files'); ?>" 
              method="post" 
              enctype="multipart/form-data"
              id="dz" 
              class="dropzone">
              <div class="fallback">
                <input name="files" type="file" multiple />
              </div>
            </form>
            <br />
            <div class="form-group">
              <label for="remarks">Remarks (optional)</label>
              <textarea id="remarks" rows="5" class="form-control" placeholder="add any additional remarks..."></textarea>
            </div>
            <br />
            <button id="upload" class="btn btn-primary">Send for Approval</button>
            <span id="error-valid" class="text-danger"></span>
          </div>
          <script>
            Dropzone.autoDiscover = false;
            var dz = new Dropzone("#dz", {
              paramName: "files",
              maxFilesize: 100,
              timeout: 0,
              acceptedFiles : '.ico,.png,.jpg,.pdf,.ai,.psd,.eps,.indd,.doc,.docs,.ppt,.pptx,.xlsx,.xls,.zip,.ttc,.ttf,.otf,.mov',
              addRemoveLinks : true,
              dictRemoveFile : 'Remove',
              parallelUploads: 15,
              uploadMultiple:true,
              autoProcessQueue: false,
              
              init: function() {
                this.on('addedfile', function(files){
                  this.options.addRemoveLinks = true;
                  this.options.dictRemoveFile = 'Remove';
                });
                this.on('sending', function(file, xhr, formData){
                  var item_id = "<?= isset($item['id']) ? $item['id'] : ''; ?>";
                  var order_id = "<?= isset($item['order_id']) ? $item['order_id'] : ''; ?>";
                  var remarks = $('#remarks').val();
                  formData.append('item_id', item_id);
                  formData.append('order_id', order_id);
                  formData.append('remarks', remarks);
                });
                this.on("success", function(file, filename) { 
                  this.options.addRemoveLinks = false;
                  this.options.dictRemoveFile = '';
                  //this.processQueue();
                  window.location.reload();
                });
                this.on("error", function(file, message) { 
                    if(message.search("File is too big") != -1){
                          // $('#max_file_error').html("<?= $this->lang->line('big_files_error') ?>");
                          this.removeFile(file); 
                    }else{
                          this.removeFile(file);
                        // $('#max_file_error').html("");
                    }
                });
              }// end init function

            });// end dropzone
          </script>
        <?php endif; ?>

        <?php if(in_array($item['status'], [2,3,4])): ?>
          <div class="x_content">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Delivery Date</th>
                  <th>Files</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($history):
                  foreach ($history as $key => $history_file):
                    echo '<tr>';
                    $file_ids_array = explode(',', $history_file['delivery_files']);
                    $files = $this->db->where_in('id', $file_ids_array)->get('files');
                    if($files->num_rows() > 0){
                      echo '<td>'.date('Y-m-d H:i:s', strtotime($history_file['created_at'])).'</td>';
                      $files = $files->result_array(); 
                      $link = base_url('uploads/orders/') . $item['order_id'] . '/' . $item['id'] . '/';
                      //print_r($link);
                      $file_list = '<ul>';
                      foreach ($files as $key => $file) {
                        $file_list .= '<li><a href="'.$link.$file['name'].'" target="_blank"> FILE-'.($key + 1).'</a></li>';
                      }
                      $file_list .= '</ul>';
                      echo '<td>'.$file_list.'</td>';
                    }
                    echo '</tr>';
                  endforeach;
                endif;
                ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>

      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Adjustment History -->
<?php if(isset($item['status']) && ($item['status'] == 4)): ?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Adjustments
            <small></small>
          </h2>
          <div class="nav navbar-right">
            <!-- <button id="adjusted" class="btn btn-primary">Adjusted</button> -->
          </div>
          <div class="clearfix"></div>
        </div>
          <div class="x_content">
            <table id="" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Adjustment Date</th>
                  <th>Name</th>
                  <th>Comments</th>
                  <th>Attachments</th>
                  <th>Link</th>
                  <th>Deadline (Days)</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($adjustments):
                    $hours = 0;
                  //print_r($adjustments);
                  foreach ($adjustments as $key => $adjustment):
                      if(isset($previous_date)  && date('Y-m-d', strtotime($adjustment['created_on'])) != $previous_date ){
                          $hours = 0;
                          $previous_date = date('Y-m-d', strtotime($adjustment['created_on']));
                      }else{
                        $previous_date = date('Y-m-d', strtotime($adjustment['created_on'])); 
                      }
                    ?>
                    <tr>
                      <td><?= date('Y-m-d H:i:s', strtotime($adjustment['created_on'])); ?></td>
                      <td><?= $adjustment['item_name']; ?></td>
                      <td style="line-break: anywhere"><?= $adjustment['textbox']; ?></td>
                      <td>
                        <?php
                        $file_ids_array = explode(',', $adjustment['attachments']);
                        $files = $this->db->where_in('id', $file_ids_array)->get('files');
                        if($files->num_rows() > 0){
                          $files = $files->result_array(); 
                          $link = base_url('uploads/orders/') . $item['order_id'] . '/' . $item['id'] . '/adjustments/';
                          //print_r($link);
                          $file_list = '<ul>';
                          foreach ($files as $key => $file) {
                            $file_list .= '<li><a href="'.$link.$file['name'].'" target="_blank"> FILE-'.($key + 1).'</a></li>';
                          }
                          $file_list .= '</ul>';
                          echo $file_list;
                        }else{
                          echo 'No Attachments';
                        }
                        ?>
                      </td>
                      <td><?= $adjustment['file_link']; ?></td>
                      <!-- <td><?= date('Y-m-d H:i:s', strtotime( " hours" , $adjustment['created_on'])); ?></td> -->
                      <td><?php 
                            echo date("Y-m-d" , strtotime(ceil(($adjustment["unit_time"]*24)+$hours). "hours" , strtotime($adjustment['created_on']) ))." ($adjustment[unit_time])";
                            $hours = $hours + ($adjustment["unit_time"]*24);
                            ?>
                                
                            </td>
                      <td><?= $adjustment['qty']; ?></td>
                      <td><?= $adjustment['subtotal_price']; ?></td>
                    </tr>
                    <?php
                    endforeach;
                  endif;
                  ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
<?php endif; ?>


<!-- Questionnaire -->
<?php if( isset($item['item_type']) && ($item['item_type'] != 'logo')): ?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><?= $item['item_name']; ?>
            <small></small>
          </h2>
          <div class="nav navbar-right">
            
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <h3>LANGUAGE</h3>
          <h4><?php echo isset($questionnaire['language']) ? ucfirst($questionnaire['language']) : 'N/A'; ?></h4>
          <br />

          <h3>MEASUREMENT</h3>
          <h4><?php echo isset($questionnaire['measurement']) ? $questionnaire['measurement'] : 'N/A'; ?></h4>
          <br />

          <h3>CONTENT SAME AS</h3>
          <h4>
            <?php if(isset($questionnaire['content'])){
              $content = $this->db->get_where('order_items', ['id' => $questionnaire['content']])->row_array();
              if($content){
                echo $content['item_name'];
              }
            }else{
              echo "N/A";
            } 
            ?>
          </h4>
          <br />

          <h3>DESCRIPTION</h3>
          <h4 style="word-break: break-word;text-align: justify;"><?php echo isset($questionnaire['textbox']) ? $questionnaire['textbox'] : 'N/A'; ?></h4>
          <br />

          <h3>ATTACHMENTS</h3>
          <h4>
            <?php 
            if(isset($questionnaire['attachment'])){
              $file_ids = explode(',', $questionnaire['attachment']);
              $this->db->where_in('id', $file_ids);
              $attachments = $this->db->get('files')->result_array();
              if(count($attachments) > 0){
                echo "<h4>";
                echo "<ul>";
                foreach ($attachments as $file_key => $attachment){
                  echo "<li>";
                  ?>
                 <a href="<?= base_url('uploads/orders/') . $item['order_id'] . '/' . $attachment['name']; ?>" target="_blank"><?= $attachment["name"]; ?></a>
                <?php
                  echo "</li>";
                }
                echo "</ul></h4>";
              }else{
                echo 'N/A';
              }
            }
              ?> 
          </h4>
          <h3>Link</h3>
          <h4><?= ($questionnaire && $questionnaire['file_link'])?$questionnaire['file_link']:'N/A'; ?> </h4>
          <br />
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">


//$(function() {

  $('#upload').on('click', function(event){
    event.preventDefault();
    //dz.options.autoProcessQueue = true;
    if(dz.getAcceptedFiles().length == 0){
      $('#error-valid').html('Please put a file in upload area.');
      return false;
    }
    if(dz.getAcceptedFiles().length <= 15){
      dz.processQueue();
      $('#error-valid').html('');
    }else{
      $('#error-valid').html('Maximum 15 files are allowed to upload at once. Please remove some extra files.');
      return false;
    }
  });
//});

</script>

