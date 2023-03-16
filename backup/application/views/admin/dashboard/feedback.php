<div class="page-title">
  <div class="title_left">
    <h3>Client Feedback <small></small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php
 if($feedbacks): ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <?php foreach ($feedbacks as $f_key => $feedback) { 
      $qry = $this->db->get_where('orders',['id'=>$f_key]);
      if ($qry->num_rows() > 0) {
        $order = $qry->row_array();
      } else {
        continue;
      }
    ?>
    <div class="x_panel">
      <div class="x_title">
        <h2><?= $order['project_name']; ?> <small><?= date("F j, Y, g:i a" , strtotime($feedback[0]['created_on'])); ?></small></h2>
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
    <?php } ?>
  </div>
</div>
<?php endif; ?>