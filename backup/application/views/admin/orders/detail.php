  <!-- Design Management start -->
  <style type="text/css">
    .p-text{
      word-break: break-word;
      text-align: justify;
      background-color: #eee;
      opacity: 1;
      color: #555;
      padding: 6px 12px;
      border: 1px solid #ccc;
      font-size: 14px;
      /*border-radius: 4px;*/
      -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
      box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    /*-webkit-transition: border-*/
    }
  </style>
<div class="page-title printmeBTNFunction">
  <div class="title_left">
    <h3>Order Management <small></small></h3>
  </div>
  <div class="title_right" style="text-align: right;">
  
  <script language="javascript">
  function printDiv() 
{

  //var divToPrint=document.getElementById('tempPrintArea1');
 // var newWin=window.open('','Print-Window');
//  newWin.document.open();
//  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
//  newWin.document.close();
  
  //$("body").addClass("printing");
  //$("body").removeClass("printing");
window.print();
 // setTimeout(function(){newWin.close();},10);
  
  

}
  </script>
    <!-- <a href="<?= base_url('admin/orders/delete/'.$this->uri->segment(4)); ?>" class="btn btn-danger">Delete</a> -->
  	<input type='button' id='btnPRINT' value='Download PDF'  class="btn btn-primary printmeBTN" onclick='printDiv();'>
    <a href="<?= base_url('admin/orders'); ?>" class="btn btn-primary">Back</a>
    <?php $complete_button = false;
      $order_items_list = $this->db->get_where('order_items', ['order_id' => $order['id']])->result_array();
      foreach ($order_items_list as $key1 => $order_item) {
        if ($order_item['status'] != 3 && $order_item['item_type'] != 'package') {
          $complete_button = true;
          break;
        }
      } 
      if (($complete_button == true) && ($order['order_status'] != 2)) { ?>
        <a href="javascript:void(0)" class="btn btn-primary" onclick="complete_order(<?= $order['id'] ?>)" >Self Complete</a>
      <?php } ?>
  </div>
</div>

<?php if($this->session->flashdata('error')){ ?>
  <div class="alert alert-danger alert-dismissible printmeBTNFunction">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
  </div>
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  <div class="alert alert-success alert-dismissible printmeBTNFunction">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
  </div>
<?php } ?>
<?php //print_r($package_detail); ?>


<div class="row top_tiles printmeBTNFunction">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2><?= (isset($order)) ? $order['project_name'] : ''; ?></h2></div>
      <h3>Project Name</h3>
      <p>Customer's project name.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2><?= (isset($package_detail['package_name'])) ? $package_detail['package_name'] : ''; ?></h2></div>
      <h3>Package</h3>
      <p>Package (bundl) Name.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2><?= (isset($order)) ? date('Y-m-d', strtotime($order['created_on'])) : ''; ?></h2></div>
      <h3>Start Date</h3>
      <p>Order is created on this date.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2 class="text-danger"><?= (isset($order_detail['last_date'])) ? $order_detail['last_date'] : ''; ?></h2></div>
      <h3>Last Date</h3>
      <p>The deadline.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <!-- <div class="count"><h2><?php// (isset($order)) ? $order['total_time'] . ' days' : ''; ?></h2></div> -->
      <div class="count"><h2><?= (isset($package_detail['package_deadline'])) ? $package_detail['package_deadline'] . ' days' : ''; ?></h2></div>
      <h3>Package Time</h3>
      <p>Package (bundl) time of the order.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2><?= (isset($package_detail['addon_deadline'])) ? $package_detail['addon_deadline'] . ' days' : ''; ?></h2></div>
      <h3>Add-on Time</h3>
      <p>Total Add-ons time of the order.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2><?= (isset($adjustments_time)) ? $adjustments_time . ' days'  : '0'; ?></h2></div>
      <h3>Adjustments Time</h3>
      <p>Total time against design adjustments of the order.</p>
    </div>
  </div>

  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
      <div class="count"><h2><?= isset($order_detail['progress']) ? round($order_detail['progress']) : '0'; ?>%</h2></div>
      <h3>Progress</h3>
      <p>Overall progress of this order.</p>
    </div>
  </div>
</div>

<!-- order item detail -->
<div class="row printmeBTNFunction">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Order # <?= isset($order) ? $order['id'] : ''; ?><small> item detail</small></h2>
        <div class="nav navbar-right">
          <h2><small>Customer Name </small><?= $customer['full_name']; ?></h2>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Item Name</th>
              <th>Type</th>
              <th>Quantity</th>
              <!-- <th>Deadline</th> -->
              <th>Status</th>
              <th>Purchase Date</th>
              <th>Content Uploaded Date</th>
              <th>Deadline</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( (isset($order_items)) && !(empty($order_items)) ){
              foreach ($order_items as $key => $item) {
                /*check payment status of customize items.
                if status is 0 (no payment) than skip the item. */
                /*$payment = $this->db->get_where('payments', ['item_id' => $item['id']]);
                if($payment->num_rows() > 0){
                  $payment = $payment->row_array();
                  if($payment['payment_status'] == 0){
                    //print_r($payment);
                    continue; 
                  }
                }*/
                
                if($item['item_type'] != 'package'){
                  if($item['item_type'] == 'logo'){
                    $item['item_name'] = $item['item_type']. ' Design (' . $item['item_name'] . ')';
                  }
                ?>
                <tr>
                  <td><?= $item['item_name']; ?></td>
                  <td><?= $item['item_type']; ?></td>
                  <td><?= $item['qty']; ?></td>
                  <!-- <td><?= $item['deadline']; ?></td> -->
                  <td>
                    <?php
                    switch ($item['status']) {
                      case 0:
                        echo "questionnaire required";
                        break;
                      case 1:
                        echo 'in process';
                        break;
                      case 2:
                        echo 'ready for approval';
                        break;
                      case 3:
                        echo 'done';
                        break;
                      case 4:
                        echo 'amendments in process';
                        break;
                      case 5:
                        echo 'hold till logo approval';
                        break;  
                      
                      default:
                        echo 'unknown status';
                        break;
                    }


                    ?>
                    </td>
                  <td><?= date("Y-m-d" , strtotime($item['created_on'])) ?></td>
                  <td><?= (isset($item['content_uploaded_date']))?date("Y-m-d" , strtotime($item['content_uploaded_date'])):'N/A' ?></td>
                  <td><?= (isset($item['content_uploaded_date']))?date("Y-m-d" , strtotime(ceil($item["unit_time"]*24). "hours" ,  strtotime($item['content_uploaded_date']))):'N/A' ?></td>
                  <td><?= number_format($item['subtotal_price']) ?> SAR</td>
                  <td>
                    <?php if( ! in_array($item['status'], [0,5])): ?>
                      <a href="<?= base_url('admin/orders/item/') . $item['id']; ?>"
                        class="btn btn-info btn-xs"
                      ><i class="fa fa-info"></i> Detail</a>
                    <?php endif; ?>
                    <?php if($item['status'] == 0 || $item['status'] == 5 ){ ?>
                      <a href="<?= base_url('admin/orders/item_update/') . $item['id']; ?>"
                        class="btn btn-warning btn-xs"
                      ><i class="fa fa-arrow-circle-right"></i> Skip Content</a>
                    <?php } ?>
                  </td>
                </tr>
                <?php
                }
              }
            }
            ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Zubair Working -->
<div id="tempPrintArea1" class="row disable-data ">
  <div id="tempPrintArea2"  class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Questionnaire <small>branding and logo</small>
        </h2>
        <div class="nav navbar-right">
          <a href="<?= base_url('admin/orders/download-questionnaire'); ?>" class="btn btn-primary">Download Questionnaire</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content question-form">
        <h3 class="link-right" >
          ABOUT YOUR BUSINESS
        </h3>
          <?php 
          if(isset($brand_questionnaire)):
            foreach ($brand_questionnaire as $key => $value):
              if($value['question_id'] == 2):
                ?>
                <div class="form-group">
                  <label>What industry does your business operate in?<span>*</span></label>
                  <input type="text" name="2" value="<?= $value['answer']; ?>" class="form-control" readonly>
                </div>
                <?php
              endif;
            endforeach;
          endif;
          ?>

          <?php 
          if(isset($brand_questionnaire)):
            foreach ($brand_questionnaire as $key => $value):
              if($value['question_id'] == 3):
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Where is your business located?<span>*</span></label>
                      <input type="text" value="<?= $value['answer']; ?>" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <?php
              endif;
            endforeach;
          endif;
          ?>
            
        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 4):
              ?>
              <div class="form-group">
                <label>What are you branding to what is your business? <span>*</span></label>
                <ul class="h-list select-btns">

                    <li class="radio">
                      <label>
                        <input type="radio" name="4" value="company" checked="checked" <?= ($value['answer'] == 'company') ? 'checked="checked"' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/company-img.png" alt="">
                            <?php if($value['answer'] == 'company'): ?>
                              <img src="<?= base_url(); ?>assets_user/images/company-img-hover.png" class="hover-img" alt="">
                            <?php endif; ?>
                          </figure>Company
                        </span>
                      </label>
                    </li>
                  
                    <li class="radio">
                      <label>
                        <input type="radio" name="4" value="product" <?= ($value['answer'] == 'product') ? 'checked="checked"' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/product-img.png" alt="">
                            <?php if($value['answer'] == 'product'): ?>
                              <img src="<?= base_url(); ?>assets_user/images/product-img-hover.png" class="hover-img" alt="">
                            <?php endif; ?>
                          </figure>Product                    
                        </span>
                      </label>
                    </li>
                  
                    <li class="radio">
                      <label>
                        <input type="radio" name="4" value="services" <?= ($value['answer'] == 'services') ? 'checked="checked"' : ''; ?> >
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/services-icon.png" alt="">
                            <?php if($value['answer'] == 'services'): ?>
                              <img src="<?= base_url(); ?>assets_user/images/services-icon-hover.png" class="hover-img" alt="">
                            <?php endif; ?>
                          </figure>Services                   
                        </span>
                      </label>
                    </li>

                </ul>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 5):
              ?>
              <div class="form-group">
                <label>Who are your competitors in the region? Out of the region?<span>*</span></label>
                <!-- <input type="text" name="5" class="form-control" value="<?= $value['answer']; ?>" readonly> -->
                <p class="p-text"><?= $value['answer']; ?></p>
               
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 6):
              ?>
              <div class="form-group">
                <label>How are you better/worse than your competitors?</label>
                <!-- <input type="text" name="6" value="<?= $value['answer']; ?>" class="form-control" readonly> -->
                <p class="p-text"><?= $value['answer']; ?></p>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>
        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 21):
              ?>
              <div class="form-group">
                <label>What is your website if you have one?</label>
                <input type="text" name="21" value="<?= $value['answer']; ?>" class="form-control" readonly>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>
        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 22):
              ?>
              <div class="form-group">
                <label>Do you have social media accounts?</label>
                <input type="text" name="22" value="<?= $value['answer']; ?>" class="form-control" readonly>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>
        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 23):
              ?>
              <div class="form-group">
                <label>If your files are large in size, please place shared link below</label>
                <!-- <input type="text" name="22" value="<?= $value['answer']; ?>" class="form-control" readonly> -->
                <p class="p-text"><?= $value['answer']; ?></p>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 8):
              $genders = json_decode($value['answer']);
              ?>
              <h3 class="padding-top-40 link-right" id="target-market">ABOUT YOUR TARGET MARKET</h3>
              <div class="form-group target-customers">
                <label class="padding-bottom-30">How old are your target customers?<span>*</span></label>
                <?php
                foreach ($genders as $gender => $ages):
                  if($gender == 'female'):
                    ?>
                    <ul class="h-list align-items-center padding-bottom-40">
                      <li class="select-btns">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="7[]" value="female" class="validThis" data-id="female" checked="checked">
                            <span>
                              <figure>
                                <!-- <img src="<?= base_url(); ?>assets_user/images/female-icon.png" alt=""> -->
                                <img src="<?= base_url(); ?>assets_user/images/female-icon-hover.png" class="hover-img" alt="">
                              </figure>
                              Female                      
                            </span>
                          </label>
                        </div>
                      </li>
                      <li class="age-selector active" id="female">
                        <ul>
                          <?php //foreach ($ages as $age): ?>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="1-10" <?= in_array('1-10', $ages) ? 'checked=""' : ''; ?> >
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img1.png" alt="">
                                      <?php if(in_array('1-10', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img1-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    10 years or<br> younger 
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="11-17" <?= in_array('11-17', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img2.png" alt="">
                                      <?php if(in_array('11-17', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img2-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    11 - 17<br> years                         
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="18-23" <?= in_array('18-23', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img3.png" alt="">
                                      <?php if(in_array('18-23', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img3-hover.png" class="hover-img" alt=""> 
                                      <?php endif; ?>
                                    </figure>
                                    18 - 23<br> years                      
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="24-30" <?= in_array('24-30', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img4.png" alt="">
                                      <?php if(in_array('24-30', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img4-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    24 - 30<br> years                         
                                  </span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="31-40" <?= in_array('31-40', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img5.png" alt="">
                                      <?php if(in_array('31-40', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img5-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    31 -40<br> years                          
                                  </span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="41-60" <?= in_array('41-60', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img6.png" alt="">
                                      <?php if(in_array('41-60', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img6-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    41 - 60<br> years                         
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[female][]" value="61-70" <?= in_array('61-70', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/female-icons/img7.png" alt="">
                                      <?php if(in_array('61-70', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/female-icons/img7-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    61 - 70<br> years                        
                                  </span>
                                </label>
                              </div>
                            </li>
                          <?php //endforeach; ?>
                        </ul>
                      </li>
                    </ul>
                  <?php endif; ?>

                  <?php if($gender == 'male'): ?>
                    <ul class="h-list align-items-center padding-bottom-20">
                      <li class="select-btns">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="7[]" value="male" data-id="male" checked="checked">
                            <span>
                              <figure>
                                <!-- <img src="<?= base_url(); ?>assets_user/images/male-icon.png" alt=""> -->
                                <img src="<?= base_url(); ?>assets_user/images/male-icon-hover.png" class="hover-img" alt="">
                              </figure>
                              Male                      
                            </span>
                          </label>
                        </div>
                      </li>
                      <li class="age-selector active" id="male">
                        <ul>
                          <?php //foreach ($ages as $age): ?>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="1-10" <?= in_array('1-10', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/male-icons/img1.png" alt="">
                                      <?php if(in_array('1-10', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img1-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    10 years or<br> younger  
                                  </span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="11-17" <?= in_array('11-17', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/male-icons/img2.png" alt="">
                                      <?php if(in_array('11-17', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img2-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    11 - 17<br> years 
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="18-23" <?= in_array('18-23', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/male-icons/img3.png" alt="">
                                      <?php if(in_array('18-23', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img3-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    18 - 23<br> years 
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="24-30" <?= in_array('24-30', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/male-icons/img4.png" alt="">
                                      <?php if(in_array('24-30', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img4-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    24 - 30<br> years 
                                  </span>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="31-40" <?= in_array('31-40', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/male-icons/img5.png" alt="">
                                      <?php if(in_array('31-40', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img5-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    31 -40<br> years 
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="41-60" <?= in_array('41-60', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                      <img src="<?= base_url(); ?>assets_user/images/male-icons/img6.png" alt="">
                                      <?php if(in_array('41-60', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img6-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    41 - 60<br> years 
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>
                            </li>
                            <li>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="8[male][]" value="61-70" <?= in_array('61-70', $ages) ? 'checked=""' : ''; ?>>
                                  <span>
                                    <figure>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img7.png" alt="">
                                      <?php if(in_array('61-70', $ages)): ?>
                                        <img src="<?= base_url(); ?>assets_user/images/male-icons/img7-hover.png" class="hover-img" alt="">
                                      <?php endif; ?>
                                    </figure>
                                    60 - 70<br> years 
                                  </span>
                                  <ul class="valid-error"></ul>
                                </label>
                              </div>    
                            </li>
                          </ul>
                        </li>
                      <?php //endforeach; ?>
                    </ul>
                  <?php endif; ?> 
                <?php endforeach; ?>
              
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 9):
              ?>
              <div class="form-group">
                <label>What else can you tell us about your customer?</label>
                <!-- <input type="text" name="9" value="<?= $value['answer']; ?>" class="form-control" readonly=""> -->
                <p class="p-text"><?= $value['answer']; ?></p>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 10):
              ?>
              <h3 class="padding-top-40 link-right" id="your-brand">ABOUT YOUR BRAND</h3>
              <div class="form-group">
                <label>What is the one thing that is unique about your brand?<span>*</span></label>
                <!-- <input type="text" name="10" value="<?= $value['answer']; ?>" class="form-control" readonly=""> -->
                <p class="p-text"><?= $value['answer']; ?></p>
                <ul class="valid-error"></ul>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>


        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 11):
              ?>
              <div class="form-group">
                <label>What is the overall message, concept you wish to portray with your brand?<span>*</span></label>
                <!-- <input type="text" name="11" value="<?= $value['answer']; ?>" class="form-control" readonly=""> -->
                <p class="p-text"><?= $value['answer']; ?></p>
                <ul class="valid-error"></ul>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 12):
              $sub_answers = json_decode($value['answer']);
              ?>
              <div class="form-group">
                <label>How would you describe your brand character?<span>*</span></label>
                <div class="progress-slider">
                  <?php foreach ($sub_answers as $k => $v): ?>
                    <div class="bar">
                      <span class="label-left"><?= ucfirst($k); ?></span>
                      <span class="label-right">
                        <?php
                        switch ($k) {
                          case 'classic':
                            echo 'Modern';
                            break;

                          case 'mature':
                            echo 'Youthful';
                            break;

                          case 'feminine':
                            echo 'Masculine';
                            break;

                          case 'economical':
                            echo 'Luxurious';
                            break;

                          case 'playful':
                            echo 'Sophisticated';
                            break;

                          case 'abstract':
                            echo 'Literal';
                            break;

                          case 'geometric':
                            echo 'Organic';
                            break;
                          
                          default:
                            echo '';
                            break;
                        }
                        ?>
                      </span>
                      <input class="range-slider" type="range" min="0" max="100" step="1" value="<?= $v; ?>" disabled="">
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 13):
              ?>
              <div class="form-group">
                <label>If you had to choose one of these fonts for your brand, which would you choose?</label>
                <ul class="h-list select-btns grid-view padding-top-20">
                  
                  <li class="radio">
                    <label>
                      <input type="radio" name="13" value="classic" <?= ($value['answer'] == 'classic') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/font-samples/img1.png" alt="">
                          <?php if($value['answer'] == 'classic'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/font-samples/img1-hover.png" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Classic                 
                      </span>
                      <ul class="valid-error"></ul>
                    </label>
                  </li>

                  <li class="radio">
                    <label>
                      <input type="radio" name="13" value="modern" <?= ($value['answer'] == 'modern') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/font-samples/img2.png" alt="">
                          <?php if($value['answer'] == 'modern'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/font-samples/img2-hover.png" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Modern                   
                      </span>
                      <ul class="valid-error"></ul>
                    </label>
                  </li>
                  <li class="radio">
                    <label>
                      <input type="radio" name="13" value="handwritten" <?= ($value['answer'] == 'handwritten') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/font-samples/img3.png" alt="">
                          <?php if($value['answer'] == 'handwritten'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/font-samples/img3-hover.png" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Handwritten                    
                      </span>
                    </label>
                  </li>
                  <li class="radio">
                    <label>
                      <input type="radio" name="13" value="typewriter" <?= ($value['answer'] == 'typewriter') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/font-samples/img4.png" alt="">
                          <?php if($value['answer'] == 'typewriter'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/font-samples/img4-hover.png" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Typewriter                   
                      </span>
                      <ul class="valid-error"></ul>
                    </label>
                  </li>
                  <li class="radio">
                    <label>
                      <input type="radio" name="13" value="surprise me" <?= ($value['answer'] == 'surprise me') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/font-samples/img5.png" alt="">
                          <?php if($value['answer'] == 'surprise me'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/font-samples/img5-hover.png" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Surprise me!       
                      </span>
                    </label>
                  </li>
                </ul>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 14):
              ?>

              <div class="form-group padding-top-40">
                <label>
                  What is your prefered color scheme?<span>*</span>
                  <i>Press on more than one color to customise</i>
                </label>

                <?php if($value['answer'] == 'surprise me'): ?>
                <div class="form-group">    
                <ul class="h-list select-btns grid-4 pickup-color" style="justify-content: center;" >
                  <li class="radio surprise-color">
                    <label>
                      <input type="radio" name="14" value="surprise me" checked="checked">
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/surprise-color-pallete.jpg" alt="">
                        </figure>Surprise me!                   
                      </span>
                      <ul class="valid-error"></ul>
                    </label>
                  </li>
                </ul>
                </div>
              <?php else: ?>
                <ul class="h-list select-btns grid-view padding-top-20">
                <?php
                $colors = explode(',', $value['answer']);
                foreach ($colors as $color):
                  $color = ($color[0] != '#') ? '#'.$color : $color;
                  ?>
                    <li class="radio">
                      <label>
                        <input type="radio" name="13" value="classic">
                        <span>
                          <figure style="background:<?= $color; ?>;" ></figure>
                          <?php echo $color; ?>                 
                        </span>
                        <ul class="valid-error"></ul>
                      </label>
                    </li>
                  <?php
                endforeach;
                ?>
                </ul>
              <?php endif; ?>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 24):
              ?>
              <div class="form-group padding-top-40">
                <label>Color Choosen from</label>
                <!-- <input type="text" name="15" value="<?= $value['answer']; ?>" class="form-control" readonly=""> -->
                <?php if($value['answer'] == "color_pallet"){ ?>
                    <p class="p-text">Customised Pallet</p>
                <?php }elseif($value['answer'] == "surprise_me"){ ?>
                  <p class="p-text">Surprise me</p>
                <?php }else{?>
                  <p class="p-text">Given Colors</p>
                <?php } ?>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>
        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 15):
              ?>
              <div class="form-group padding-top-40">
                <label>Is there anything else you would like to communicate to the designer?</label>
                <!-- <input type="text" name="15" value="<?= $value['answer']; ?>" class="form-control" readonly=""> -->
                <p class="p-text"><?= $value['answer']; ?></p>
              </div>
              <?php
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        $text_show = true;
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 16):
              ?>
              <?php if($text_show){  ?>
                <div class="form-group">
                  <label>Do you have any images, sketches, or documents that might be helpful?</label>
                </div>
              <?php } $text_show = false; ?>
              <?php
              $file_ids = explode(',', $value['answer']);
              $this->db->where_in('id', $file_ids);
              $attachments = $this->db->get('files')->result_array();
              if(count($attachments) > 0):
                foreach ($attachments as $file_key => $attachment):
                  $file_src = base_url('uploads/orders/') . $order['id'] . '/' . $attachment['name'];
                  $mime = explode("/", $attachment['type']);
                  if($mime[0] == 'image'){
                    $showcase = $file_src;
                  }else{
                    $showcase = base_url('assets_user/images/file-icons/file.png');
                  }
                  ?>
                 <a href="<?= $file_src; ?>" target="_blank" class="clickable" download><img src="<?= $showcase; ?>" height="72" width="72" /></a>
                <?php
                endforeach;
              endif;
            endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 17):
              ?>
              <br />
              <br />
              <br />
              <h3 class="padding-top-40 link-right">
                ABOUT YOUR LOGO
              </h3>
              <div class="form-group">
                <label>What is the exact lettering you would like in your logo, if you have one?</label>
                <input type="text" name="17" value="<?= $value['answer']; ?>" class="form-control" readonly>
              </div>
              <?php
              endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 18):
              ?>
              <div class="form-group">
                <label>Do you have a slogan you want to be incorporated in your logo?</label>
                <input type="text" name="18" value="<?= $value['answer']; ?>" class="form-control" readonly>
              </div>
              <?php
              endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 19):
              ?>

              <div class="form-group">
                <label>
                  Which logo structure do you prefer?<span>*</span>
                </label>
                <ul class="h-list select-btns grid-4 padding-top-20">
                  <li class="radio">
                    <label>
                      <input type="radio" name="19" value="Typographic" <?= ($value['answer'] == 'Typographic') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/structure-samples/img1.jpg" alt="">
                          <?php if($value['answer'] == 'Typographic'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/structure-samples/img1-hover.jpg" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Typographic 
                      </span>
                    </label>
                  </li>
                  <li class="radio">
                    <label>
                      <input type="radio" name="19" value="Iconic" <?= ($value['answer'] == 'Iconic') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/structure-samples/img2.jpg" alt="">
                          <?php if($value['answer'] == 'Iconic'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/structure-samples/img2-hover.jpg" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Iconic 
                      </span>
                    </label>
                  </li>
                  <li class="radio">
                    <label>
                      <input type="radio" name="19" name="Both (Typographic & Iconic)" <?= ($value['answer'] == 'Both (Typographic & Iconic)') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/structure-samples/img3.jpg" alt="">
                          <?php if($value['answer'] == 'Both (Typographic & Iconic)'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/structure-samples/img3-hover.jpg" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Both 
                      </span>
                    </label>
                  </li>
                  <li class="radio">
                    <label>
                      <input type="radio" name="19" value="Surprise me" <?= ($value['answer'] == 'Surprise me') ? 'checked=""' : ''; ?>>
                      <span>
                        <figure>
                          <img src="<?= base_url(); ?>assets_user/images/structure-samples/img4.jpg" alt="">
                          <?php if($value['answer'] == 'Surprise me'): ?>
                            <img src="<?= base_url(); ?>assets_user/images/structure-samples/img4-hover.jpg" class="hover-img" alt="">
                          <?php endif; ?>
                        </figure>Surprise me 
                      </span>
                    </label>
                  </li>
                </ul>
              </div>
              
              <?php
              endif;
          endforeach;
        endif;
        ?>

        <?php 
        if(isset($brand_questionnaire)):
          foreach ($brand_questionnaire as $key => $value):
            if($value['question_id'] == 20):
              $colorss = explode(',', $value['answer']);
                ?>
                <div class="form-group padding-top-40">
                  <label>
                    Which of the following logo designs would suit your brand the most?<span>*</span>
                  </label>
                  <ul class="h-list select-btns grid-4 padding-top-20">
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('watercolor', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img1.png" alt="">
                            <?php if(in_array('watercolor', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img1-hover.png" class="hover-img" alt="">
                            <?php endif; ?>
                          </figure>Watercolor
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('geometric', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img2.jpg" alt="">
                            <?php if(in_array('geometric', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img2-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Geometric 
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('mascot', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img3.jpg" alt="">
                            <?php if(in_array('mascot', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img3-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Mascot 
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('abstract', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img4.jpg" alt="">
                            <?php if(in_array('abstract', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img4-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Abstract
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('signature', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img5.jpg" alt="">
                            <?php if(in_array('signature', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img5-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Signature 
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('emblem', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img6.jpg" alt="">
                            <?php if(in_array('emblem', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img6-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Emblem 
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('pictorial', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img7.jpg" alt="">
                            <?php if(in_array('pictorial', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img7-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Pictorial 
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('minimal', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img8.jpg" alt="">
                            <?php if(in_array('minimal', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img8-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Minimal
                        </span>
                      </label>
                    </li>

                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('linear', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img9.jpg" alt="">
                            <?php if(in_array('linear', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img9-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Linear
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('hand', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img10.jpg" alt="">
                            <?php if(in_array('hand', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img10-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Hand Drawn
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('letterform', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img11.jpg" alt="">
                            <?php if(in_array('letterform', $colorss)): ?>
                              
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img11-hover.jpg" class="hover-img" alt="">
                            <?php endif; ?>
                          </figure>Letterform
                        </span>
                      </label>
                    </li>
                    <li class="checkbox">
                      <label>
                        <input type="checkbox" name="20" <?= in_array('surprise', $colorss) ? 'checked=""' : ''; ?>>
                        <span>
                          <figure>
                            <img src="<?= base_url(); ?>assets_user/images/brand-samples/img12.jpg" alt="">
                            <?php if(in_array('surprise', $colorss)): ?>
                              <img src="<?= base_url(); ?>assets_user/images/brand-samples/img12-hover.jpg" class="hover-img" alt="">
                              
                            <?php endif; ?>
                          </figure>Surprise me
                        </span>
                      </label>
                    </li>
                  </ul>
                </div>
                <?php
              endif;
          endforeach;
        endif;
        ?>


      </div>
    </div>
  </div>
</div>

<!-- Questionnaire -->
<!-- <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Questionnaire <small>branding and logo</small>
        </h2>
        <div class="nav navbar-right">
          
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php 
        if(isset($brand_questionnaire)): $i = 0;
          foreach ($brand_questionnaire as $key => $value): $i++;
            ?>
            <h3><?= 'Q' . $i . ': ' . $value['question']; ?></h3>

            <?php if($value['question_id'] == 12): $j = 0;
              $sub_answers = json_decode($value['answer']);
              echo '<div class="x_content">';
              foreach ($sub_answers as $k => $v): $j++;
                //if($j == 4){ echo $j;}
               ?> 
               <div class="row">  
                <div class="col-md-2 text-right"> <?= ucfirst($k); ?> </div>
                <div class="col-md-8">
                  <input type="range" disabled="" value="<?= $v; ?>">
                </div>
                <div class="col-md-2 text-left">
                  <?php 
                  switch ($k) {
                    case 'classic':
                      echo 'Modern';
                      break;

                    case 'mature':
                      echo 'Youthful';
                      break;

                    case 'feminine':
                      echo 'Masculine';
                      break;

                    case 'economical':
                      echo 'Luxurious';
                      break;

                    case 'playful':
                      echo 'Sophisticated';
                      break;

                    case 'abstract':
                      echo 'Literal';
                      break;

                    case 'geometric':
                      echo 'Organic';
                      break;
                    
                    default:
                      echo '';
                      break;
                  }
                 ?> 
               </div>
               </div>
               <br />
               
              <?php endforeach; echo '</div>'; ?>
              <br />
              <br />

            <?php elseif($value['question_id'] == 8): 
              $counter8 = 0;
              $genders = json_decode($value['answer']);
              echo "<h4>Answer: </h4>";
              foreach ($genders as $gender => $ages):
                if($gender == 'male'):
                  echo "Male: </ br>";
                  echo "<ul>";
                  foreach ($ages as $age) {
                    echo "<li>".$age."</li>";
                  }
                  echo "</ul>";
                else:
                  echo "Female: </ br>";
                  echo "<ul>";
                  foreach ($ages as $age) {
                    echo "<li>".$age."</li>";
                  }
                  echo "</ul>";
                endif;
              endforeach; 
              ?>

            <?php elseif($value['question_id'] == 14): $k = 0;

              echo "<h4>Answer: </h4>";
              echo "<ul>";

              if($value['answer'] == 'surprise me'){
                echo "<li>surprise me</li>";
              }else{
                $list_answers = explode(',', $value['answer']);
                foreach ($list_answers as $x):
                  echo "<li style='margin-bottom: 7px;'><div style='display: inline-block; min-width: 100px; vertical-align: middle; '>#" . $x . 
                    ' </div><div style="background:#' . $x . '; vertical-align: middle;display:inline-block;width:72px;height:72px;border:1px solid rgba(0, 0, 0, .2);"></div></li>';
                endforeach;
              }
              echo "</ul>"; ?>

            <?php elseif($value['question_id'] == 16):
              $file_ids = explode(',', $value['answer']);
              $this->db->where_in('id', $file_ids);
              $attachments = $this->db->get('files')->result_array();
              echo "<h4>Answer: ";
              if(count($attachments) > 0){
                foreach ($attachments as $file_key => $attachment){
                  $file_src = base_url('uploads/orders/') . $order['id'] . '/' . $attachment['name'];
                  ?>
                 <a href="<?= $file_src; ?>" target="_blank"><img src="<?= $file_src; ?>" height="72" width="72" /></a>
                <?php
                }
                echo "</h4>";
              }else{
                echo 'N/A';
              }
              ?> 

            <?php else:; ?>
              <h4>Answer: <?= $value['answer']; ?></h4><br />
            <?php endif; ?>

            <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>
  </div>
</div> -->

<!-- Client Feedback -->
<style type="text/css">

  .bar {display: flex; justify-content: space-between;align-items: center;}
  .bar-input{margin-top: 10px;}
  .bar-input input {border:none;border-bottom: 1px solid;border-top:none !important; background-color: #fff !important;}
  .shadow-remover {-webkit-box-shadow:none !important;box-shadow: none!important;}
  .extra-margin { margin-bottom: 70px; }
</style>
<?php //print_r($feedback); ?>
<?php if($feedback): ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Feedback <small>client thoughts</small></h2>
        <div class="nav navbar-right"></div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php foreach ($feedback as $key => $value): ?>
          
          <?php if($value['question_id'] == 1): ?>
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group extra-margin">
                <label>How would you rate the overall quality of our work?</label>
                <div class="progress-slider">
                  <div class="bar">
                    <span class="text-left">Excellent</span>
                    <span class="label-center">Good</span>
                    <span class="label-right">Poor</span>
                  </div>
                  <div>  
                    <input class="range-slider" disabled type="range" min="0" max="100" step="1" value="<?= $value['rating']; ?>">
                  </div>
                </div>
                <?php if($value['explanation']): ?>
                  <div  class="bar-input"> 
                    <label>Explanation</label>
                    <!-- <input type="text" readonly class="form-control shadow-remover" value="<?= $value['explanation']; ?>"> -->
                    <p class="p-text"><?= $value['explanation']; ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if($value['question_id'] == 2): ?>
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group extra-margin">
                <label>How would you rate the process of the website?</label>
                <div class="progress-slider">
                  <div class="bar">
                    <span class="text-left">Excellent</span>
                    <span class="label-center">Good</span>
                    <span class="label-right">Poor</span>
                  </div>
                  <div>  
                    <input class="range-slider" disabled type="range" min="0" max="100" step="1" value="<?= $value['rating']; ?>">
                  </div>
                </div>
                <?php if($value['explanation']): ?>
                  <div  class="bar-input"> 
                    <label>Explanation</label>
                    <!-- <input type="text" readonly class="form-control shadow-remover" value="<?= $value['explanation']; ?>"> -->
                    <p class="p-text"><?= $value['explanation']; ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if($value['question_id'] == 3): ?>
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group extra-margin">
                <label>How would you rate the verity of the BUNDLs?</label>
                <div class="progress-slider">
                  <div class="bar">
                    <span class="text-left">Excellent</span>
                    <span class="label-center">Good</span>
                    <span class="label-right">Poor</span>
                  </div>
                  <div>  
                    <input class="range-slider" disabled type="range" min="0" max="100" step="1" value="<?= $value['rating']; ?>">
                  </div>
                </div>
                <?php if($value['explanation']): ?>
                  <div  class="bar-input"> 
                    <label>Explanation</label>
                    <!-- <input type="text" readonly class="form-control shadow-remover" value="<?= $value['explanation']; ?>"> -->
                    <p class="p-text"><?= $value['explanation']; ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if($value['question_id'] == 4): ?>
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group extra-margin">
                <label>Would you use BUNDL again?</label>
                <div class="progress-slider">
                  <div class="bar">
                    <span class="text-left">Yes</span>
                    <span class="label-center">Maye</span>
                    <span class="label-right">No</span>
                  </div>
                  <div>  
                    <input class="range-slider" disabled type="range" min="0" max="100" step="1" value="<?= $value['rating']; ?>">
                  </div>
                </div>
                <?php if($value['explanation']): ?>
                  <div  class="bar-input"> 
                    <label>Explanation</label>
                    <!-- <input type="text" readonly class="form-control shadow-remover" value="<?= $value['explanation']; ?>"> -->
                    <p class="p-text"><?= $value['explanation']; ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if($value['question_id'] == 5): ?>
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group extra-margin">
                <label>Anything else you would like to share?</label>
                <?php if($value['explanation']): ?>
                  <div  class="bar-input">
                    <label>Explanation</label>
                    <!-- <input type="text" readonly class="form-control shadow-remover" value="<?= $value['explanation']; ?>"> -->
                    <?= $value['explanation']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
  function complete_order(order_id){
      swal({
          title: "Are you sure?",
          text: "You are going to complete the order. This action can not be undone.",
          type: "warning",
          confirmButtonText: "<?= $this->lang->line('continue'); ?>",
          confirmButtonClass: '',
          showCancelButton: true,
          cancelButtonText: "<?= $this->lang->line('cancel'); ?>",
          cancelButtonClass: ''
      },function(isConfirm) {
          if (isConfirm) {
              window.location.href =  "<?= base_url('admin/orders/item_complete/') ?>"+order_id;
          }
      });
  }
</script>