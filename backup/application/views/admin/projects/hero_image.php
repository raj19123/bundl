<!-- Design Management start -->
<style>
  .image_picker_image {
    width: 200px;
    height: 200px;
  }

  .thumbnail a > img, .thumbnail > img {  
    width: 200px;
    height: 200px;
  }
</style>
<div class="page-title">
  <div class="title_left">
    <h3>Projects Management <small>Control all projects</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<div id="msgError" class="alert alert-danger alert-dismissible" style="display: none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Hero image failed to update.
</div>

<div id="msgSuccess" class="alert alert-success alert-dismissible" style="display: none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Hero image updated successfully!
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Hero Image <small><?= ($project) ? 'for '.$project['name_english'] : ''; ?></small></h2>
        <div class="nav navbar-right">
          <a href="<?= base_url('admin/projects'); ?>" class="btn btn-success"> Back</a>
          <button id="updateImage" class="btn btn-primary"><i class="fa fa-upload"></i> Update Image</button>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php if(isset($project['images']) && !empty($project['images'])){ 
          $image_ids = explode(",", $project['images']);
          $image_files = $this->db->where_in('id', $image_ids)->get('files')->result_array();

          $selected = ($project['hero_image']) ? $project['hero_image'] : '';
          ?>
          <select id="imgPick" class="image-picker">
            <?php foreach ($image_files as $key => $img) { ?>
              <option value="<?= $img['id']; ?>" 
                data-img-src="<?= base_url('uploads/projects/').$img['name']; ?>" 
                data-img-alt="<?= $img['id']; ?>"
                <?= ($img['id'] == $selected) ? 'selected' : ''; ?>
              >Image <?= $key+1; ?></option>
            <?php } ?>
          </select>
        <?php }else{ ?>
          <h1>No Images found for this project.</h1>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<script>
  $("#imgPick").imagepicker();
  $('.image-picker').masonry({
    itemSelector: 'option',
    columnWidth: 200,
    horizontalOrder: true
  });

  $("#updateImage").on('click', function(event){
    event.preventDefault();

    var heroImage = $("#imgPick").val();
    var projectId = "<?= $project['id']; ?>";
    //alert(heroImage);

    $.ajax({
      type: 'post',
      url: "<?= base_url('admin/projects/update-hero-image'); ?>",
      data: {'hero_image':heroImage, 'project_id':projectId},
      success: function(msg){
        console.log(msg);
        if(msg == "TRUE"){
          $("#msgSuccess").show().fadeOut(5000);
          $("#msgError").hide();
        }else{
          $("#msgError").show().fadeOut(5000);
          $("#msgSuccess").hide();
        }
      }
    });
  });
</script>