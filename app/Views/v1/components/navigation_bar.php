<header class="">
    <section class="topbar-one">
        <div class="container">
            <div class="topbar-one__left">
                <a href="#">
                    <i class="fa fa-map-marker-alt"></i>
                    89 Alberg lane, Middle River, Maryland, 21220, USA
                </a>
                <a href="#">
                    <i class="far fa-clock"></i>
                    Mon - Sat 9.00 - 18.00
                </a>
                <a href="tel:+251-235-3256">
                    <i class="fa fa-phone"></i>
                    +1 (662) 364-6798
                </a>
            </div><!-- /.topbar-one__left -->

            <div class="topbar-one__right">
                <div class="topbar-one__social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-rss"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#"><i class="fab fa-vimeo-v"></i></a>
                </div><!-- /.topbar-one__social -->
            </div><!-- /.topbar-one__right -->
        </div><!-- /.container -->
    </section><!-- /.topbar-one -->

    <nav class="main-nav-one stricky">
        <div class="container">
            <div class="inner-container">
                <div class="logo-box">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url('assets/img/handglove-logo.png'); ?>" alt="" width="100">
                    </a>
                    <a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i></a>
                </div><!-- /.logo-box -->
                <div class="main-nav__main-navigation">
                    <ul class="main-nav__navigation-box">
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
                    </ul><!-- /.main-nav__navigation-box -->

                    <?php  if( session()->get('isLoggedIn') == 1 ){ ?>
                        <ul class="main-nav__navigation-box" id="user_menu">
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

                <?php  if( session()->get('isLoggedIn') != 1 ){ ?>
                <div class="main-nav__right">
                    <a href="<?php echo base_url('login'); ?>" class="thm-btn main-nav-one__btn">
                        Sign In <i class="fa fa-sign-in-alt"></i></a><!-- /.thm-btn main-nav-one__btn -->
                </div>
                <?php } ?>

            </div><!-- /.inner-container -->
        </div><!-- /.container -->
    </nav><!-- /.main-nav-one -->
</header>