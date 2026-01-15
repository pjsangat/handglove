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

                    <!-- <ul class="profile-agency">
                        <li>Indeed</li>
                        <li>Apple</li>
                        <li>Orange</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <div id="profile-main" class="col-lg-8 col-md-12 col-sm-12 col-12">
                <?php if(!empty($votingArr)){ ?>
                <div id="votingSection">
                    <?php foreach($votingArr as $voting){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(!empty($voting) && !$voting['hasVoted']){ ?>
                                <h4><?php echo $voting['description']; ?></h4>
                                <div class="voting">
                                    <div id="voting<?php echo $voting['id']; ?>">
                                        <?php foreach($voting['details'] as $detail){ ?>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="clinician-details">
                                                        <img class="img-responsive" src="<?php echo $detail['clinician_details']['profile_pic_url'] != '' ? $detail['clinician_details']['profile_pic_url'] : base_url('assets/img/blank-img.png'); ?>" />
                                                        <div class="clinician-name pl-3"><?php echo $detail['clinician_details']['name']; ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 submit-button">
                                                    <a href="javascript:;" class="btn thm-btn vote-clinician" data-clinician_id="<?php echo $detail['clinician_id']; ?>" data-voting_id="<?php echo $voting['id']; ?>">Submit Vote</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>

            </div>
            <div id="profile-sidebar" class="col-lg-4 col-md-12 col-sm-12 col-12">
                <!-- <h3>Overview</h3>
                <div class="divider"></div>
                <div class="sidebar-list-job mt-10">
                    
                </div>
                <div class="divider"></div>
                <div class="buttons">
                    <button class="btn thm-btn-secondary" data-toggle="modal" data-target="#uploadModal">Credentials</button>
                    <button class="btn thm-btn-white" data-toggle="modal" data-target="#availabilityModal">Availability</button>
                </div> -->
                <div id="connector">
                    <?php if(!empty($votingArr)){ ?>
                    <div id="voting-results">
                        <h4>This week Vote</h4>
                        <?php foreach($votingArr as $voting){ ?>
                            <?php if(!empty($voting)){ ?>
                                <div class="voting-results mb-5">
                                <h6><?php echo $voting['description']; ?></h6>
                                <?php foreach($voting['details'] as $detail){ ?>
                                    <div class="row mb-1">
                                        <div class="col-md-12">
                                            <div class="clinician-details">
                                                <div class="clinician-name"><?php echo $detail['clinician_details']['name']; ?></div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $detail['vote_percentage'] . '%'; ?>;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <!-- <a href="<?php echo base_url('employee-award'); ?>" class="btn thm-btn">Add a Referral</a> -->
                    <!-- <ul id="connector_list">
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt=""></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>