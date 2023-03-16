<?php
//$order_id = 1;
if(isset($_GET['oid'])){
	$order_id = $_GET['oid'];
}
?>

<?php if($this->session->flashdata('paytab_data')){
	//print_r($this->session->flashdata('paytab_data'));
} ?>

<?php if($this->session->flashdata('error')){ ?>
    <div class="text-danger border-message">
        <strong><?= $this->lang->line('error'); ?></strong> <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
    <div class="text-success border-message">
        <strong><?= $this->lang->line('success'); ?></strong> <?= $this->session->flashdata('success'); ?>
    </div>
<?php } ?>

<div class="dashboard-tabs">
	<ul class="dashboard-head">
		<li><?= $this->lang->line('bundle_name'); ?></li>
		<li><?= $this->lang->line('items'); ?></li>
		<li><?= $this->lang->line('status'); ?></li>
		<li><?= $this->lang->line('adjustment'); ?></li>
		<li><?= $this->lang->line('art_work'); ?></li>
	</ul>

	<!-- <for-web> -->
	<ul class="nav nav-tabs hide-on-mobile" id="myTab" role="tablist">

		<?php if(isset($projects)): foreach ($projects as $key => $project):
			if( ! isset($order_id)){ $order_id = $project['id']; }
			$pack_detail = [];
			//get package info
			$pack = $this->db->get_where('order_items', ['order_id' => $project['id'], 'item_type' => 'package']);
			if($pack->num_rows() > 0){
				$pack = $pack->row_array();
				$pack_detail = $this->db->get_where('packages', ['id' => $pack['item_id']])->row_array();
				/*if($pack_detail->num_rows() > 0){
					$pack_detail = $pack_detail->row_array();
				}*/
			}

			if(empty($pack_detail)){
				$pack_detail['name_'.$language] = $this->lang->line('custom_bundl');
			}
			?>

			<li class="nav-item">
			    <a class="nav-link <?= ($project['id'] == $order_id) ? 'active' : ''; ?>" 
			    	id="<?= $project['id']; ?>-tab" 
			    	data-toggle="tab" 
			    	href="#<?= $project['id']; ?>" 
			    	role="tab"
			    	aria-controls="<?= $project['id']; ?>" 
			    	aria-selected="<?= ($project['id'] == $order_id) ? 'true' : 'false'; ?>">
			    	
			    	<span class="item"><?= strtoupper($project['project_name']); ?></span>
			    	<?php if(isset($pack_detail['name_'.$language])): ?>
			    		<span class="date"><?= $pack_detail['name_'.$language]; ?></span>
			    	<?php endif; ?>
			    	<span class="date"><?= date('m/d/Y', strtotime($project['created_on'])); ?></span>
			    </a>
			</li>

		<?php endforeach; endif; ?>
	</ul>

	<!-- <for-mobile> -->
	<div class="dashboard-tabs dropdown-for-mobile show-on-mobile" style="margin-bottom: 20px;">
		<a href="#" class="toggler">
			<?= $this->lang->line('bundls'); ?>
		</a>
		<div class="hide-show">
			<ul class="nav nav-tabs menu-for-mobile" id="myTab" role="tablist">

				<?php if(isset($projects)): foreach ($projects as $key => $project):
					if( ! isset($order_id)){ $order_id = $project['id']; }
					$pack_detail = [];
					//get package info
					$pack = $this->db->get_where('order_items', ['order_id' => $project['id'], 'item_type' => 'package']);
					if($pack->num_rows() > 0){
						$pack = $pack->row_array();
						$pack_detail = $this->db->get_where('packages', ['id' => $pack['item_id']])->row_array();
						/*if($pack_detail->num_rows() > 0){
							$pack_detail = $pack_detail->row_array();
						}*/
					}

					if(empty($pack_detail)){
						$pack_detail['name_'.$language] = $this->lang->line('custom_bundl');
					}
					?>

					<li class="nav-item">
					    <a class="nav-link <?= ($project['id'] == $order_id) ? 'active' : ''; ?>" 
					    	id="<?= $project['id']; ?>-tab" 
					    	data-toggle="tab" 
					    	href="#<?= $project['id']; ?>" 
					    	role="tab"
					    	aria-controls="<?= $project['id']; ?>" 
					    	aria-selected="<?= ($project['id'] == $order_id) ? 'true' : 'false'; ?>">
					    	
					    	<span class="item"><?= strtoupper($project['project_name']); ?></span>
					    	<?php if(isset($pack_detail['name_'.$language])): ?>
					    		<span class="date"><?= $pack_detail['name_'.$language]; ?></span>
					    	<?php endif; ?>
					    	<span class="date"><?= date('m/d/Y', strtotime($project['created_on'])); ?></span>
					    </a>
					</li>

				<?php endforeach; endif; ?>

			</ul>
		</div>

	</div>

	<div class="tab-content" id="myTabContent">

		<?php 
		if(isset($projects)): 
			foreach ($projects as $key => $project): 
				if( ! isset($order_id)){ $order_id = $project['id']; }
				?>

				<div class="tab-pane <?= ($project['id'] == $order_id) ? 'fade show active' : 'fade'; ?>" 
					id="<?= $project['id']; ?>" 
					role="tabpanel" 
					aria-labelledby="<?= $project['id']; ?>-tab">
					
					<?php //if( ($project['branding'] == 1) && ($project['order_status'] == 0) ):
						//$exist = $this->db->get_where('answers_brand', ['order_id' => $project['id']]);
						//if($exist->num_rows() > 0){
						//	$this->db->update('orders', ['order_status' => 1], ['id' => $project['id']]);
						//}

						?>
						<!-- <table class="dashboard-tables" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td></td>
									<td>branding questionnaire is required for this project</td>
									<td>
										<div class="adjustments">
											<span></span>
											<a href="<?= base_url('questionnaire?oid=') . $project['id']; ?>">fill questionnaire</a>
										</div>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table> -->


					<?php //else: ?>

						<h3 class="bundl-names show-on-mobile">
							<span class="item"><?= strtoupper($project['project_name']); ?></span>
					    	<?php if(isset($pack_detail['name_'.$language])): ?>
					    		<span class="date"><?= $pack_detail['name_'.$language]; ?></span>
					    	<?php endif; ?>
					    	<span class="date"><?= date('m/d/Y', strtotime($project['created_on'])); ?></span>
						</h3>

						<table class="dashboard-tables" cellpadding="0" cellspacing="0">
							<tbody>
								<?php 
								$items = $this->db->get_where('order_items', ['order_id' => $project['id'], 'status !=' => 100])->result_array();

								//sort logo first
								$logo = FALSE;
								$logo_design = FALSE;
								$logo_design_items = array();
								$k = NULL;
								$logo_element = array();
								$arr_to_merge = array();
								$branding_ids_db = $this->db->get_where("designs" , ['category_id' => 1])->result_array();
								if($branding_ids_db){
									$branding_ids = array_column($branding_ids_db, "id");
								}else{
									$branding_ids = array();
								}

								foreach ($items as $key => $item) {
									if($item['item_type'] == 'logo'){
										$logo = TRUE;
										// $k = $key;
										unset($items[$key]);
										array_unshift($items, $item);
									}elseif($item['item_type'] == 'addon' && in_array($item['item_id'] , $branding_ids) ){
										if($item['item_id'] == 76){
											$logo_design = TRUE;
											$logo_design_items[] = $item;
										}else{
											$arr_to_merge[] = $item; 
										}
										unset($items[$key]);
									}
								}
								if($logo){
									$logo_element[] = array_shift($items);
									$items = array_merge($logo_element , $logo_design_items ,$arr_to_merge , $items);
									// array_splice(input, offset)
								}else{
									$items = array_merge($logo_design_items , $arr_to_merge , $items);
								}

								// if($k){
								// 	unset($items[$k]);
								// 	array_unshift($items, $logo);
								// }
								$questionnaire_text = TRUE;
								$questionnaire_button = TRUE;
								foreach ($items as $row => $item):
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

									if($item['item_type'] != 'package'):

								?>
										<tr>
											<td><?= ($item['item_type'] == 'logo') ?  $this->lang->line('logo').'(' . (($item['item_name'] == 'both') ? $this->lang->line('languages_both') : (($item['item_name'] == 'arabic') ? $this->lang->line('languages_arabic') : $this->lang->line('languages_english'))) . ')' : $item['item_name']; ?></td>
											<td>
												<?php
												switch ($item['status']) {
													case 0:
														if($item['item_type'] == 'logo'){
															echo $this->lang->line('question_req');
															$questionnaire_text = FALSE;
														}elseif($item['item_type'] == 'addon' && in_array($item['item_id'] , $branding_ids)){
															if($questionnaire_text){
																echo $this->lang->line('question_req');
																$questionnaire_text = FALSE;
															}
														}else{
															echo $this->lang->line('questionnaire_required');
														}
														
														break;
													case 1:
														echo $this->lang->line('in_process');
														if(isset($item['deadline'])):
														?>
															<p class="times">
																<img src="<?= base_url(); ?>assets_user/images/glyph-stopwatch.png" alt=""> 
																<?= date('d/m/Y', strtotime($item['deadline'])); ?>
															</p>
														<?php
														endif;
														break;
													case 2:
														//echo $this->lang->line('ready_for_approval');
														echo $this->lang->line('done');
														break;
													case 3:
														echo $this->lang->line('done');
														break;
													case 4:
														echo $this->lang->line('amendments_in_process');
														break;
													case 5:
														echo $this->lang->line('hold_till_logo_approval');
														break;
													default:
														echo $this->lang->line('unknown_status');
														break;
												}
												?>
											</td>
											<td>
												<?php 
												switch ($item['status']) {
													case 0:
														?>
														<div class="adjustments">
															<?php
																if($item['item_type'] == 'logo'){
																	$b = $this->lang->line('home_fill_questionnaire');
																	$questionnaire_button = FALSE;
																}elseif($item['item_type'] == 'addon' && in_array($item['item_id'] , $branding_ids)){
																	if($questionnaire_button){
																		$b = $this->lang->line('home_fill_questionnaire');
																		$questionnaire_button = FALSE;
																	}else{
																		$b = '';
																	}
																}else{
																	$b = $this->lang->line('fill_question');
																}
															?>
															<?php if($b){ ?>
																<span></span>
																<a href="<?= base_url('questionnaire?oid=') . $project['id']; ?>">
																	<?= $b  ?>
																</a>
															<?php } ?>
														</div>
														<?php
														break;
													case 2:
													
														?>
														<ul class="action-links">
															<?php if($item['item_type'] == 'logo' || $item['item_id'] == 76): ?>
																<li>
																	<a href="#" class="approve" data-item="<?= $item['id']; ?>">
																		<i class="fa fa-check"></i>
																		<?= $this->lang->line('approve_link'); ?>
																	</a>
																</li>
															<?php endif; ?>
															<li>
																<a href="<?= base_url('adjustments/') . $item['id']; ?>">
																	<i class="fa fa-pencil"></i>
																	<?= $this->lang->line('edit_link'); ?>
																</a>
															</li>
														</ul>
														<?php
														break;
													case 3:
														?>
														<ul class="action-links">
															<li>
																<a href="<?= base_url('adjustments/') . $item['id']; ?>">
																	<i class="fa fa-pencil"></i>
																	<?= $this->lang->line('edit_link'); ?>
																</a>
															</li>
														</ul>
														<?php
														break;
													case 5:
														echo '<div class="adjustments disabled"><span></span>'.$this->lang->line("fill_questionnaire").'</div>';
														break;
													case 1:
													case 4:
													default:
														echo '';
														break;
												}
													?>
														
											</td>
											<td>
												<?php 
												switch ($item['status']) {
													case 0:
													case 1:
													case 4:
													case 5:
														echo '';
														break;
													case 3:
													case 2:
														?>
														<ul class="action-links">
															<li>
																<a href="#" class="dFile" data-item="<?= $item['id']; ?>">
																	<i class="fa fa-download"></i>
																	<?= $this->lang->line('download_link'); ?>
																</a>
															</li>
															<!-- <li>
																<a href="#">
																	<i class="fa fa-times"></i>
																	delete
																</a>
															</li> -->
														</ul>
														<?php
														break;
													
													default:
														echo '';
														break;
												}
													?>
											</td>
										</tr>	
								<?php 
									endif;
								endforeach; 
								?>
								<tr>
									<td colspan="4">
										<!-- <div class="proceed-text">
											<h4><?= $this->lang->line('we_glad') ?></h4>
										</div> -->
										<ul class="custom-links">
											<li>
												<a id="editBundl" href="<?= base_url('edit-bundl/').$project['id']; ?>">
													<img src="<?= base_url(); ?>assets_user/images/add-icon.png" alt=""> <?= $this->lang->line('add_ons_to_bundl'); ?> 
												</a>
											</li>
											<li>
												<a href="<?= base_url(); ?>">
													<img src="<?= base_url(); ?>assets_user/images/customize-icon.png" alt=""> <?= $this->lang->line('parchase_bundle'); ?> 
												</a>
											</li>
										</ul>
									</td>
								</tr>

								<!-- <tr>
									<td>- Buisness card</td>
									<td>Questionnaire required</td>
									<td class="disabled">
										<div class="adjustments">
											<span></span>
											fill questionnaire
										</div>
									</td>
									<td class="empty">&nbsp;</td>
								</tr> -->

							</tbody>
						</table>
					<?php //endif; ?>

				</div>
				<?php 
			endforeach; 
		endif; 
		?>

	</div>
</div>


<!-- file download modal -->
<div id="mFile" class="modal fade files-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?= $this->lang->line('download_file'); ?> </h4>
      </div>
      <div class="modal-body" id="file-list"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('close'); ?></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	//tab will be selected after page refresh
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});

	<?php if(isset($_GET['oid'])){ ?>
		localStorage.setItem('activeTab', '#<?= $_GET["oid"] ?>');
	<?php } ?>

	<?php if($this->session->flashdata('order_id')){ ?>
		localStorage.setItem('activeTab', '#<?= $this->session->flashdata("order_id") ?>');
	<?php } ?>
	
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        var eTab = $('#myTab a[href="' + activeTab + '"]');
        eTab.tab('show');
        var tapParent = $('#myTab a[href="' + activeTab + '"]').parent().attr("data-slick-index");
        // console.log(tapParent);

		$('.slider-for-mobile').slick('slickGoTo', tapParent);
    }

	$('.dFile').on('click', function(event){
		event.preventDefault();

		var item = $(this).data('item');
		//alert(item);
		$.ajax({
			type: 'post',
			url: '<?= base_url('get-delivery-files'); ?>',
			data: {'item_id' : item},
			success: function(msg){
				console.log(msg);
				$('#file-list').html(msg);
				$('#mFile').modal('show');
			}
		});
	});

	$('.approve').on('click', function(event){
		event.preventDefault();
		var a = $(this).hasClass("disabled");
		if(a){
			return;
		}
		var btn = $(this);
		var item = $(this).data('item');
		btn.addClass("disabled");
		$.ajax({
			type: 'post',
			url: '<?= base_url('approve-item'); ?>',
			data: {'item_id' : item},
			success: function(msg){
				btn.removeClass("disabled");
				console.log(msg);
				if(msg == '1'){
					//location.reload();
					btn.hide();
					btn.closest('tr').children('td').eq(1).html('done');
				}
				window.location.reload();
				//$('#file-list').html(msg);
				//$('#mFile').modal('show');
			}
		});
	});
});
</script>