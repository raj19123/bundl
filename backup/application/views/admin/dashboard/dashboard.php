<!-- dashboard start -->
<div class="page-title">
  <div class="title_left">
    <h3>Dashboard <small>Overall View</small></h3>
  </div>
  <div class="title_right"></div>
</div>

<?php //$this->files->file_size($usage); ?>


<div class="row">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel tile fixed_height_320">
      <div class="x_title">
        <h2>Stats</h2>
        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <h4>Stats across the application</h4>
        <div class="widget_summary">
          <div class="w_left">
            <span>Designs</span>
          </div>
          <!-- <div class="w_center w_55"></div> -->
          <div class="w_right">
            <span><?= (isset($designs)) ? $designs : '0'; ?></span>
          </div>
        </div>

        <div class="widget_summary">
          <div class="w_left">
            <span>Packages</span>
          </div>
          <!-- <div class="w_center w_55"></div> -->
          <div class="w_right">
            <span><?= (isset($packages)) ? $packages : '0'; ?></span>
          </div>
        </div>

        <div class="widget_summary">
          <div class="w_left">
            <span>Users</span>
          </div>
          <div class="w_right">
            <span><?= (isset($users)) ? $users : '0'; ?></span>
          </div>
        </div>

        <div class="widget_summary">
          <div class="w_left">
            <span>Email Templates</span>
          </div>
          <div class="w_right">
            <span><?= (isset($email_templates)) ? $email_templates : '0'; ?></span>
          </div>
          
        </div>
        <div class="widget_summary">
          <div class="w_left">
            <span>files</span>
          </div>
          <div class="w_right">
            <span><?= (isset($files)) ? $files : '0'; ?></span>
          </div>
        </div>
        <div class="widget_summary">
          <div class="w_left">
            <span>Space Usage</span>
          </div>
          <div class="w_right">
            <span><?= (isset($usage)) ? $this->files->file_size($usage) : '0'; ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>