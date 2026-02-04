<div id="profile-banner">
    <div class="container">
        <div class="profile">
            <div class="profile-img">
                <img src="<?php echo $profileData['profile_pic_url'] != '' ? $profileData['profile_pic_url'] : base_url('assets/img/blank-img.png'); ?>" alt="">
            </div>
            <div class="profile-details">
                <div class="profile-name">
                    <h1><?php echo $profileData['name']; ?></h1>
                </div>
                <div class="profile-extras">
                    <div class="profile-detail-info">
                        <?php $color = ($profileData['tier'] == 30 ? '#FFD700' : ($profileData['tier'] == 20 ? '#C0C0C0' : '#CD7F32')); ?>
                        <ul class="profile-agency">
                            <li><?php echo $profileData['type_name']; ?></li>
                            <li style="background: #fff;color: <?php echo $color; ?>;border: 1px solid <?php echo $color; ?>;"><i class="fa fa-award"></i> <?php echo ($profileData['tier'] == 30 ? 'Senior' : ($profileData['tier'] == 20 ? 'Reliable' : 'Junior')); ?></li>
                        </ul>
                        
                        <ul class="profile-short-info">
                            <li><i class="fa fa-map-marker-alt"></i> <?php echo $profileData['address']; ?></li>
                            <li><i class="fa fa-phone"></i> </i> <?php echo $profileData['contact_number']; ?></li>
                        </ul>
                    </div>

                    <div class="profile-statistics">
                        <div class="no-of-shifts-cont stats">
                            <div class="person-card">
                                <i class="fa fa-user"></i>
                                <div class="card-counter">400+</div>
                                <p>Shifts</p>
                            </div>

                        </div>
                        <div class="attendance-cont stats">
                            <div class="circle-card">
                                <div class="circle" data-percent="85" style="background: conic-gradient(#3bb4e5 <?php echo 85*3.6.'deg'; ?>, #eee <?php echo 85*3.6.'deg'; ?>);"></div>
                                <div class="card-counter">85%</div>
                                <p>Attendance</p>
                            </div>
                        </div>
                        <div class="tardiness-cont stats">
                            <div class="circle-card">
                                <div class="circle" data-percent="6" style="background: conic-gradient(#3bb4e5 <?php echo 6*3.6.'deg'; ?>, #eee <?php echo 6*3.6.'deg'; ?>);"></div>
                                <div class="card-counter">6%</div>
                                <p>Lateness</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>