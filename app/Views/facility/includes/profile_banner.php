<div id="profile-banner">
    <div class="container">
        <div class="profile">
            <div class="profile-img">
                <img src="<?php echo (!empty($facility['company_logo']) ? $facility['company_logo'] : base_url('assets/img/blank-img.png')); ?>" alt="">
            </div>
            <div class="profile-details">
                <div class="profile-name">
                    <h2><?php echo $facility['company_name']; ?></h2>
                </div>
                <div class="profile-extras">
                    <div class="profile-detail-info">
                        <ul class="profile-short-info">
                            <li><i class="fa fa-map-marker-alt"></i> <?php echo $facility['company_address']; ?></li>
                            <li><i class="fa fa-phone"></i> <?php echo $facility['company_number']; ?></li>
                        </ul>
                    </div>
                    <div class="profile-statistics">
                        <div class="no-of-shifts-cont stats">
                            <div class="person-card">
                                <i class="fa fa-user"></i>
                                <div class="card-counter">400+</div>
                                <p>Total Beds</p>
                            </div>

                        </div>
                        <div class="attendance-cont stats">
                            <div class="circle-card">
                                <div class="circle" data-percent="85" style="background: conic-gradient(#3bb4e5 <?php echo 85*3.6.'deg'; ?>, #eee <?php echo 85*3.6.'deg'; ?>);"></div>
                                <div class="card-counter">1:20</div>
                                <p>Census</p>
                            </div>
                        </div>
                        <div class="tardiness-cont stats">
                            <div class="circle-card">
                                <div class="circle" data-percent="6" style="background: conic-gradient(#3bb4e5 <?php echo 6*3.6.'deg'; ?>, #eee <?php echo 6*3.6.'deg'; ?>);"></div>
                                <div class="card-counter">6%</div>
                                <p>Work Friendly</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>