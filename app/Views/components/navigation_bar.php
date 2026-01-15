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
                            <li class="list-inline-item dropdown me-4">
                            <a href="javascript:void(0)" class="header-item noti-icon position-relative" id="notification" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <div class="count position-absolute">3</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end p-0" aria-labelledby="notification">
                                <div class="notification-header border-bottom bg-light">
                                    <h6 class="mb-1"> Notification </h6>
                                    <p class="text-muted fs-13 mb-0">You have 4 unread Notification</p>
                                </div>
                                <div class="notification-wrapper dropdown-scroll">
                                    <a href="javascript:void(0)" class="text-dark notification-item d-block active">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs bg-primary text-white rounded-circle text-center">
                                                    <i class="uil uil-user-check"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1 fs-14">22 verified registrations</h6>
                                                <p class="mb-0 fs-12 text-muted"><i class="mdi mdi-clock-outline"></i> <span>3 min
                                                    ago</span></p>
                                            </div>
                                        </div>
                                    </a><!--end notification-item-->
                                    <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/user/img-02.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1 fs-14">James Lemire</h6>
                                                <p class="text-muted fs-12 mb-0"><i class="mdi mdi-clock-outline"></i> <span>15 min
                                                    ago</span></p>
                                            </div>
                                        </div>
                                    </a><!--end notification-item-->
                                    <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/featured-job/img-04.png" class="rounded-circle avatar-xs" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1 fs-14">Applications has been approved</h6>
                                                <p class="text-muted mb-0 fs-12"><i class="mdi mdi-clock-outline"></i> <span>45 min
                                                    ago</span></p>
                                            </div>
                                        </div>
                                    </a><!--end notification-item-->
                                    <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/user/img-01.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1 fs-14">Kevin Stewart</h6>
                                                <p class="text-muted mb-0 fs-12"><i class="mdi mdi-clock-outline"></i> <span>1 hour
                                                    ago</span></p>
                                            </div>
                                        </div>
                                    </a><!--end notification-item-->
                                    <a href="javascript:void(0)" class="text-dark notification-item d-block">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/featured-job/img-01.png" class="rounded-circle avatar-xs" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1 fs-15">Creative Agency</h6>
                                                <p class="text-muted mb-0 fs-12"><i class="mdi mdi-clock-outline"></i> <span>2 hour
                                                    ago</span></p>
                                            </div>
                                        </div>
                                    </a><!--end notification-item-->
                                </div><!--end notification-wrapper-->
                                <div class="notification-footer border-top text-center">
                                    <a class="primary-link fs-13" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                                    </a>
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
                                        <li><a href="<?php echo base_url('facility/manage'); ?>">Manage Facility</a></li>
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