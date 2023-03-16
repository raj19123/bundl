<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <!-- <h3>General</h3> -->
        <ul class="nav side-menu">
            <li><a target="_blank" href="<?php echo base_url(); ?>"><i class="fa fa-globe" aria-hidden="true"></i> Visit Site</a></li>
            <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-users" aria-hidden="true"></i> Users</a></li>
            
            <li><a><i class="fa fa-paint-brush"></i>Design<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('admin/design'); ?>"><i class="fa fa-list-ol" aria-hidden="true"></i>Designs</a></li> 
                    <li><a href="<?php echo base_url('admin/design/categories'); ?>"><i class="fa fa-book" aria-hidden="true"></i>Design Categories</a></li>
                    <li><a href="<?php echo base_url('admin/adjustments'); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Adjustments</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-cube"></i>Package<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('admin/package'); ?>"><i class="fa fa-list-ol" aria-hidden="true"></i>Packages</a></li> 
                    <li><a href="<?php echo base_url('admin/package/categories'); ?>"><i class="fa fa-book" aria-hidden="true"></i>Package Categories</a></li> 
                    <li><a href="<?php echo base_url('admin/package/components'); ?>"><i class="fa fa-chain" aria-hidden="true"></i>Package Components</a></li> 
                </ul>
            </li>

            <li><a href="<?php echo base_url('admin/orders'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Orders</a></li>
            <li><a href="<?php echo base_url('admin/orders/feedback'); ?>"><i class="fa fa-comments" aria-hidden="true"></i> Feedbacks</a></li>
            <li><a href="<?php echo base_url('admin/coupon'); ?>"><i class="fa fa-tags" aria-hidden="true"></i> Coupons</a></li>
            <li><a href="<?php echo base_url('admin/email'); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Email Templates</a></li>
            <li><a href="<?php echo base_url('admin/projects'); ?>"><i class="fa fa-tasks" aria-hidden="true"></i> Projects</a></li>
            <li><a href="<?php echo base_url('admin/about/edit'); ?>"><i class="fa fa-user" aria-hidden="true"></i> About Us</a></li>
            <li><a href="<?php echo base_url('admin/terms'); ?>"><i class="fa fa-gavel" aria-hidden="true"></i> Terms & Conditions</a></li>
            <li><a href="<?php echo base_url('admin/privacy'); ?>"><i class="fa fa-lock" aria-hidden="true"></i> Privacy Policy</a></li>
            <li><a href="<?php echo base_url('admin/testimonials'); ?>"><i class="fa fa-quote-left" aria-hidden="true"></i> Testimonials</a></li>

            <li><a><i class="fa fa-graduation-cap"></i>Careers<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('admin/careers'); ?>"><i class="fa fa-book" aria-hidden="true"></i>Vacancies</a></li> 
                    <li><a href="<?php echo base_url('admin/careers/applications'); ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Applications</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-question-circle"></i>FAQs<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('admin/faqs'); ?>"><i class="fa fa-list-ol" aria-hidden="true"></i>FAQs</a></li> 
                    <li><a href="<?php echo base_url('admin/faqs/categories'); ?>"><i class="fa fa-book" aria-hidden="true"></i>FAQs Categories</a></li>    
                </ul>
            </li>
            
            <li><a href="<?php echo base_url('admin/settings'); ?>"><i class="fa fa-gear" aria-hidden="true"></i> Settings</a></li>

        </ul>
    </div>
</div>