<header class="">
    <nav class="main-nav-one stricky">
        <div class="container">
            <div class="inner-container">
                <div class="logo-box">
                    <a href="<?php echo base_url(); ?>" class="nav-logo">
                        <img src="<?php echo base_url('assets/img/handglove-logo.png'); ?>" alt="" width="100">
                        Handglove
                    </a>
                    <a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i></a>
                </div><!-- /.logo-box -->
                <div class="main-nav__main-navigation">
                    <!-- <ul class="main-nav__navigation-box">
                        <li class="">
                            <a href="about-1.html">About Us</a>
                        </li>
                        <li class="dropdown">
                            <a href="services.html">Clinician</a>
                        </li>
                        <li class="dropdown">
                            <a href="#">Facility</a>
                            <ul>
                                <li><a href="blog-standard.html">MyShift</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>/.main-nav__navigation-box -->

                    <?php  if( session()->get('isLoggedIn') == 1 ){ ?>
                        <ul class="main-nav__navigation-box" id="user_menu">
                            <li class="list-inline-item dropdown mr-4">
                                <a href="javascript:void(0)" class="header-item noti-icon position-relative" id="notification" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <div class="count position-absolute" id="notification-count" style="display:none; background-color: #E41E3F; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 11px; display: flex; align-items: center; justify-content: center; top: -5px; right: -5px;">0</div>
                                </a>
                                <div class="dropdown-menu p-0 notification-dropdown" aria-labelledby="notification">
                                    <div class="notification-header">
                                        <h6>Notifications</h6>
                                        <a href="javascript:void(0)" id="mark-all-read" style="color: #0084FF; font-size: 13px; font-weight: 500; text-decoration: none;">Mark all as read</a>
                                    </div>
                                    <div class="notification-wrapper dropdown-scroll" id="notification-list">
                                        <div class="p-4 text-center text-muted">Loading notifications...</div>
                                    </div><!--end notification-wrapper-->
                                    <div class="notification-footer text-center">
                                        <a href="<?= base_url('notifications') ?>" class="fs-13">See all notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#">
                                    <div class="user-image">
                                        <img src="<?php echo base_url('/assets/img/blank-img.png'); ?>" class="" alt="User Image">
                                    </div>
                                    <div class="user-name">
                                        <div><strong>Hi, <?php echo session()->get('first_name');?></strong></div>
                                    </div>
                                </a>
                                <ul>
                                    <?php if( session()->get('type') == 10){ ?>
                                        <li><a href="<?php echo base_url('profile'); ?>">View Profile</a></li>
                                        <li><a href="<?php echo base_url('profile/shifts'); ?>">My Shifts</a></li>
                                    <?php } ?>
                                    <?php if( session()->get('facility_id') != 0){ ?>
                                        <li><a href="<?php echo base_url('facility'); ?>">Facility Profile</a></li>
                                        <?php if(session()->get('type') != 5){ ?>
                                            <li><a href="<?php echo base_url('facility/manage'); ?>">Manage Facility</a></li>
                                        <?php } ?>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url('login/logout'); ?>">Logout</a></li> 
                                </ul> 
                            </li> 
                        </ul>
                    <?php } ?>

                </div>

            </div><!-- /.inner-container -->
        </div><!-- /.container -->
    </nav><!-- /.main-nav-one -->
</header>