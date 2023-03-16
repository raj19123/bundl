<div class="container adjustments-page feedback-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<h3 class="hide-on-mobile"><?= $this->lang->line('bundle_n'); ?></h3>
	
	<!-- <for-web> -->
	<div class="dashboard-tabs">
		<ul class="nav nav-tabs hide-on-mobile" id="myTab" role="tablist">
			<?php
			if($projects):
				foreach ($projects as $key => $project): $i = $key + 1;
					?>
					<li class="nav-item">
					    <a class="nav-link <?= ($i == 1)?'active':''; ?>" 
					    	id="<?= $i; ?>-tab" 
					    	data-toggle="tab" 
					    	href="#<?= $i; ?>" 
					    	role="tab" 
					    	aria-controls="<?= $i; ?>" 
					    	aria-selected="<?= ($i == 1)?'true':'false'; ?>">
					    	
					    	<span class="item"><?= strtoupper($project['project_name']); ?></span>
					    	<span class="date"><?= date('d/m/Y', strtotime($project['created_on'])); ?></span>
					    </a>
					</li>
					<?php
				endforeach;
			endif;
			?>
		</ul>
		<div class="dashboard-tabs dropdown-for-mobile show-on-mobile" style="margin-bottom: 20px;">
			<a href="#" class="toggler">
				<?= $this->lang->line('bundls'); ?>
			</a>
			<div class="hide-show">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<?php
					if($projects):
						foreach ($projects as $key => $project): $i = $key + 1;
							?>
							<li class="nav-item">
							    <a class="nav-link <?= ($i == 1)?'active':''; ?>" 
							    	id="<?= $i; ?>-tab" 
							    	data-toggle="tab" 
							    	href="#<?= $i; ?>" 
							    	role="tab" 
							    	aria-controls="<?= $i; ?>" 
							    	aria-selected="<?= ($i == 1)?'true':'false'; ?>">
							    	
							    	<span class="item"><?= strtoupper($project['project_name']); ?></span>
							    	<span class="date"><?= date('m/d/Y', strtotime($project['created_on'])); ?></span>
							    </a>
							</li>
							<?php
						endforeach;
					endif;
					?>
				</ul>
			</div>
		</div>			
		<div class="tab-content" id="myTabContent">
			<?php
			if($projects):
				foreach ($projects as $key => $project): $i = $key + 1;
					?>
					<div class="tab-pane fade <?= ($i == 1)?'show active':''; ?>"
						id="<?= $i; ?>" 
						role="tabpanel" 
						aria-labelledby="<?= $i; ?>-tab">

						<h3 class="bundl-names show-on-mobile">
							<span class="item"><?= strtoupper($project['project_name']); ?></span>
					    	<span class="date"><?= date('m/d/Y', strtotime($project['created_on'])); ?></span>
						</h3>

						<form class="feedback-form">
							<input type="hidden" name="order_id" value="<?= $project['id']; ?>">
							<div class="form-group">
								<label><?= $this->lang->line('rate_quality'); ?></label>
								<div class="progress-slider">
									<div class="bar">
										<span class="label-left active"><?= $this->lang->line('excellent'); ?></span>
										<span class="label-center"><?= $this->lang->line('good'); ?></span>
										<span class="label-right"><?= $this->lang->line('poor'); ?></span>
										<input class="range-slider" name="feedback[1][rating]" type="range" min="0" max="100" step="1" value="9">
									</div>
								</div>
								<!-- <input type="text" name="feedback[1][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_poor_can_you_explain'); ?>"> -->
								<textarea name="feedback[1][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_poor_can_you_explain'); ?>"></textarea>
							</div>
							<div class="form-group">
								<label><?= $this->lang->line('rate_process'); ?></label>
								<div class="progress-slider">
									<div class="bar">
										<span class="label-left active"><?= $this->lang->line('excellent'); ?></span>
										<span class="label-center"><?= $this->lang->line('good'); ?></span>
										<span class="label-right"><?= $this->lang->line('poor'); ?></span>
										<input class="range-slider" name="feedback[2][rating]" type="range" min="0" max="100" step="1" value="9">
									</div>
								</div>
								<!-- <input type="text" name="feedback[2][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_poor_can_you_explain'); ?>"> -->
								<textarea name="feedback[2][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_poor_can_you_explain'); ?>"></textarea>
							</div>
							<div class="form-group">
								<label><?= $this->lang->line('rate_verity'); ?></label>
								<div class="progress-slider">
									<div class="bar">
										<span class="label-left active"><?= $this->lang->line('excellent'); ?></span>
										<span class="label-center"><?= $this->lang->line('good'); ?></span>
										<span class="label-right"><?= $this->lang->line('poor'); ?></span>
										<input class="range-slider" name="feedback[3][rating]" type="range" min="0" max="100" step="1" value="9">
									</div>
								</div>
								<!-- <input type="text" name="feedback[3][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_poor_can_you_explain'); ?>"> -->
								<textarea name="feedback[3][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_poor_can_you_explain'); ?>"></textarea>
							</div>
							<div class="form-group">
								<label><?= $this->lang->line('use_again'); ?></label>
								<div class="progress-slider">
									<div class="bar">
										<span class="label-left active"><?= $this->lang->line('yes'); ?></span>
										<span class="label-center"><?= $this->lang->line('maybe'); ?></span>
										<span class="label-right"><?= $this->lang->line('no'); ?></span>
										<input class="range-slider" name="feedback[4][rating]" type="range" min="0" max="100" step="1" value="9">
									</div>
								</div>
								<!-- <input type="text" name="feedback[4][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_no_can_you_explain'); ?>"> -->
								<textarea name="feedback[4][explanation]" class="form-control" placeholder="<?= $this->lang->line('if_your_answer_no_can_you_explain'); ?>"></textarea>
							</div>
							<div class="form-group">
								<label><?= $this->lang->line('you_like_share'); ?></label>
								<!-- <input type="text" name="feedback[5][explanation]" class="form-control" placeholder="<?= $this->lang->line('write_your_answer_here'); ?>"> -->
								<textarea name="feedback[5][explanation]" class="form-control" placeholder="<?= $this->lang->line('write_your_answer_here'); ?>"></textarea>
							</div>
							<div class="button-row">
								<button type="button" onclick="feedbackSubmit($(this));" class="btn btn-default"><?= $this->lang->line('feedback_submit'); ?></button>
							</div>
							<div class="proceed-text" id="feedbMsg" style="display: none;">
								<h4><?= $this->lang->line('feedback_recieved'); ?></h4>
							</div>
						</form>

					</div>
					<?php
				endforeach;
			else:
				?>
				<div class="alert alert-danger alert-dismissible text-purple">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong><?= $this->lang->line('cart_alert'); ?></strong> <?= $this->lang->line('feedback_empty'); ?>
				</div>
				<?php
			endif;
			?>
		</div>
		
	</div>

</div>

<script type="text/javascript">
	function feedbackSubmit(element) {
		var form = element.closest('form');
		var data = form.serializeArray();
		//console.log(data);
		//alert('me');

		$.ajax({
			type: 'post',
			url: '<?= base_url('feedback-response'); ?>',
			data: data,
			success: function(msg){
				console.log(msg);
				if(msg == 'yes'){
					//$('.button-row').hide();
					$('#feedbMsg').show().fadeOut(30000);
					element.hide();
				}
			}
		});
	}
</script>