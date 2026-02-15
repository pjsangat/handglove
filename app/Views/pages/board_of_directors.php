<div id="board-of-directors" class="main-pages page-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="section-title text-center mb-5">
                    <h2>BOARD OF DIRECTORS</h2>
                </div>
                
                <div class="row board-grid">
                    <?php if(!empty($board_members)): ?>
                        <?php foreach($board_members as $member): ?>
                            <div class="col-md-4 mb-5">
                                <div class="member-card d-flex align-items-center">
                                    <div class="member-avatar">
                                        <?php if($member['picture']): ?>
                                            <img src="<?= base_url($member['picture']) ?>" alt="<?= $member['ceo_name'] ?>">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Default">
                                        <?php endif; ?>
                                    </div>
                                    <div class="member-info ml-3">
                                        <h5 class="mb-0"><?= $member['ceo_name'] ?></h5>
                                        <p class="mb-0 text-muted small"><?= $member['position'] ?></p>
                                        <p class="mb-0 text-muted small"><?= $member['company_name'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="media-section mt-5 py-5 border-top">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h3 class="mb-4">Media</h3>
                            <ul class="media-links list-unstyled">
                                <li class="d-flex align-items-center mb-4">
                                    <div class="icon-box mr-3">
                                        <i class="fas fa-comment-dots fa-2x"></i>
                                    </div>
                                    <div class="text-box">
                                        <h6 class="mb-0">Commercial</h6>
                                        <small class="text-muted">mentorship team</small>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center mb-4">
                                    <div class="icon-box mr-3">
                                        <i class="fas fa-chart-line fa-2x"></i>
                                    </div>
                                    <div class="text-box">
                                        <h6 class="mb-0">Progress Report</h6>
                                        <small class="text-primary">quality of service.</small>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="icon-box mr-3">
                                        <i class="fas fa-user-friends fa-2x"></i>
                                    </div>
                                    <div class="text-box">
                                        <h6 class="mb-0">Look Inside</h6>
                                        <small class="text-muted">client/driver.</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="partner-logos-grid row no-gutters">
                                <?php if(!empty($board_members)): ?>
                                    <?php foreach($board_members as $member): ?>
                                        <?php if($member['company_logo']): ?>
                                            <div class="col-4 p-2 text-center">
                                                <?php if($member['company_website']): ?>
                                                    <a href="<?= $member['company_website'] ?>" target="_blank">
                                                        <img src="<?= base_url($member['company_logo']) ?>" alt="<?= $member['company_name'] ?>" class="img-fluid grayscale">
                                                    </a>
                                                <?php else: ?>
                                                    <img src="<?= base_url($member['company_logo']) ?>" alt="<?= $member['company_name'] ?>" class="img-fluid grayscale">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
