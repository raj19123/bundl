<div class="top_nav printmeBTNFunction">
  <div class="nav_menu printmeBTNFunction" style="margin-bottom: 0;">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?php echo $this->User->full_name; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="<?= base_url('admin/profile');?>"><i class="fa fa-child pull-right"></i> Profile </a></li>
            <li><a href="<?= base_url('admin/profile/password');?>"><i class="fa fa-key pull-right"></i> Change Password </a></li>
            <i ></i>
            <li><a href="<?= base_url('admin/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>