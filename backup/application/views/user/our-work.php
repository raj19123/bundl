<main class="main-contents work-page">
	<div class="scrolltop">
		<i class="fas fa-arrow-up"></i>
	</div>
	<div class="container">
		<section class="our-work">
			<div class="section-title sm-width">
				<h1>
					<?= $this->lang->line('our_work_text'); ?>
					<span class="add-icon"></span>
				</h1>
			</div>
			<!-- <?php if (!empty($hero_images)) { ?>
				<div class="pro-slider">
					<div class="main-img">
						<?php foreach ($hero_images as $key => $hero_image) { ?>
							<div class="image">
								<img src="<?= base_url('uploads/projects/').$hero_image['name']; ?>" alt="">
							</div>
						<?php }?>
					</div> --> <!-- to remove hero imaage slider -->
					<!-- <div class="thumb-img">
						<?php foreach ($hero_images as $key1 => $hero_image) { ?>
						<div class="image">
							<img src="<?= base_url('uploads/projects/').$hero_image['name']; ?>" alt="">
						</div>
						<?php }?>
					</div> -->
				<!-- </div> --> <!-- to remove hero imaage slider -->
				<!-- <div class="pro-desc">
					<div class="section-title">
						<h1>
							<?php //$feature_projects['name_'.$language]; ?>
							<span class="add-icon"></span>
						</h1>
					</div>
					<p><?php //$feature_projects['description_'.$language]; ?></p>
				</div> -->
			<!-- <?php } ?> --> <!-- to remove hero imaage slider -->
		</section>
		<section class="our-projects">
			<div class="row stack-on-414">
				<?php 
				$objPopUPRender = '';
				$objPopUPRenderJs = '';
				if($projects):
					foreach ($projects as $key => $project):
					//print_r($project);die;
						$project_images = explode(",", $project['images']);
						$img_id = ($project['hero_image']) ? $project['hero_image'] : $project_images[0];
						$image = $this->db->get_where('files', ['id' => $img_id])->row_array();
						?>
						<div class="col-lg-4 col-6">
							<div class="image">
								<a href="#" class="projectDetail projectDetailClickCapt<?= $project['id']; ?>" data-prjid="<?= $project['id']; ?>">
									<img src="<?= base_url('uploads/projects/') . $image['name']; ?>" alt="">
								</a>
							</div>
							<p>
								<a href="javascript:void(0);" class="projectDetail  projectDetailClickCapt<?= $project['id']; ?>"><?= strtoupper($project['name_'.$language]); ?></a>
							</p>
						</div>
						<?php
						
						
						//print_r($projectImages);
						
						$testImagesSliderIMage = '';
						
						if (!empty($projectImages[$project['id']])) {
							foreach ($projectImages[$project['id']] as $slider_tmp_image) { 
								$testImagesSliderIMage .= '<div class="image"><img src="'. base_url('uploads/projects/').$slider_tmp_image['name'].'" alt=""></div>';
							}
						}
				
							
							
						$objPopUPRender .= '<div class="modal fade" id="projectPopup'.$project['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
										<button type="button" class="close project-modal-close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									<div class="modal-body project-slides">
										<section class="our-work">
												<div class="pro-slider">
													<div class="main-img" id="full_image__'.$project['id'].'">'.$testImagesSliderIMage.'
													
													
													
													</div>
												</div>
												<div class="pro-desc">
													<div class="section-title">
														<h1 id="prjName">'.$project['name_'.$language].'<span class="add-icon"></span></h1>
													</div>
													<p id="prjDesc">'.$project['description_'.$language].'</p>
												</div>
										</section>
									</div>
								</div>
							</div>
						</div>';
						$objPopUPRenderJs .= '
						
						$(".projectDetailClickCapt'.$project['id'].'").on("click", function(e){
							
						
		e.preventDefault();
		$("#projectPopup'.$project['id'].'").modal("show");
	});
	
	$("#projectPopup'.$project['id'].'").on("shown.bs.modal", function (e) {
		$("#full_image__'.$project['id'].'").slick("slickNext");
		//$("#full_image").slick("slickNext");
		//$(window).trigger("resize");
	});
	
	
	
	';
	
	
	


	
					endforeach;
				endif;
				?>
			</div>
		</section>
	</div>
</main>
<!-- Project Detail pop up model --><!-- Project Detail pop up model --><!-- Project Detail pop up model --><!-- Project Detail pop up model -->
<?=$objPopUPRender?>
<? /*?>
<!-- Project Detail pop up model -->
	<div class="modal fade" id="projectPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<!-- <div class="modal-header"> -->
				<!-- <h5 class="modal-title" id="exampleModalLongTitle"></h5> -->
					<button type="button" class="close project-modal-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				<!-- </div> -->
				<div class="modal-body project-slides">
					<section class="our-work">
                            <div class="pro-slider">
								<div class="main-img" id="full_image"></div>
								<!-- <div class="thumb-img" id="small_image"></div> -->
							</div>
							<div class="pro-desc">
								<div class="section-title">
									<h1 id="prjName">tttttttttt</h1>
								</div>
								<p id="prjDesc"></p>
							</div>
					</section>
				</div>
				<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
				</div> -->
			</div>
		</div>
	</div>
<? */?>
<script>

<?=$objPopUPRenderJs?>
/*
	$(".projectDetail").on("click", function(e){
		e.preventDefault();
		var projectID = $(this).data('prjid');
		var language = "<?= $language; ?>";

		$.ajax({
			type: 'post',
			url: "<?= base_url('get-project-detail'); ?>",
			data: {'project_id':projectID},
			success: function(resp){
				var objData = $.parseJSON(resp);
				//console.log(objData.project);
				if(objData.status){
					var projectName = "objData.project.name_"+language;
					var projectDesc = "objData.project.description_"+language;
					$("#prjName").html(eval(projectName)+'<span class="add-icon"></span>');
					$("#prjDesc").html(eval(projectDesc));
					if(objData.prjImages){
						$('#full_image').slick('slickRemove',null ,null, true);
						$.each(objData.prjImages, function(index, value) {
							var img = '<div class="image"><img src="<?= base_url('uploads/projects/'); ?>'+value.name+'" alt=""></div>';
							$('#full_image').slick('slickAdd',img);
						});
						
						//$(window).trigger('resize');
					}
				}else{
					location.reload();
				}
			}
		});
		//$('#full_image').slick('refresh');
		$("#projectPopup").modal('show');

		//$(window).trigger('resize');
	});

	$('#projectPopup').on('shown.bs.modal', function (e) {
		// $('#full_image').slick('refresh');
		$('#full_image').slick('slickNext');
		$(window).trigger('resize');
	});*/
</script>
