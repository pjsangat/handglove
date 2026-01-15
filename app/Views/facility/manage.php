<div id="profile-banner">
    <div class="container">
        <div class="profile">
            <div class="profile-img">
                <img src="<?php echo (!empty($facility['company_logo']) ? $facility['company_logo'] : base_url('assets/img/blank-img.png')); ?>" alt="">
            </div>
            <div class="profile-details">
                <div class="profile-name">
                    <h1><?php echo $facility['company_name']; ?></h1>
                </div>
                <div class="profile-detail-info">
                    <ul class="profile-short-info">
                        <li><i class="fa fa-map-marker-alt"></i> <?php echo $facility['company_address']; ?></li>
                        <li><i class="fa fa-phone"></i> <?php echo $facility['company_number']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <?php echo view("facility/sidebar"); ?>

            <div id="profile-main" class="col-lg-9 col-md-12 col-sm-12 col-12">
                <?php echo view("facility/manage/".$page); ?>

                <!-- <div id="biography">
                    <h2>Biography</h2>
                    <div class="profile-biography">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce orci leo, tincidunt eget aliquet quis, laoreet ut justo. Nulla suscipit feugiat erat, a bibendum massa. Aenean et tortor eget ex vestibulum semper nec vel mi. Donec congue justo et eros vehicula, id gravida augue pretium. Aliquam suscipit porta augue eu mattis. Nunc semper ex nulla, quis semper metus ultricies sit amet. Etiam metus ante, elementum ut laoreet sed, finibus sit amet velit. Vivamus non imperdiet leo. Vestibulum viverra odio vitae pellentesque maximus. Nam non risus ante.</p>
                        <p>Donec cursus finibus leo, at cursus nulla fermentum sed. Nam quis risus varius, consectetur dui dapibus, scelerisque neque. Nam bibendum, urna a sagittis tincidunt, mi ligula mollis eros, et imperdiet ex ex at mauris. Vestibulum eget aliquam nibh. Vestibulum ullamcorper, tortor vitae sagittis laoreet, leo nibh bibendum libero, sit amet elementum lorem quam vel sapien. Vivamus porttitor posuere purus, id dignissim magna. Donec eu mollis leo. Sed mi est, eleifend eu purus quis, ultricies elementum justo.</p>
                    </div>
                </div> -->
                <!-- <div class="divider"></div>
                <div id="work-experience">
                    <h2>Work Experience</h2>
                </div>
                <div class="divider"></div>
                <div id="education">
                    <h2>Education</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <li>Cambridge University(2001-2004)</li>
                                <li>Brads University(2004-2006)</li>
                                <li>Cambridge University(2006-2010)</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-muted lh-32">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet. Deleniti asperiores, commodi quae ipsum quas est itaque
                            </p>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div id="skills">
                    <h2>Professional Skills</h2>
                </div> -->
            
            </div>
        </div>
    </div>
</div>

