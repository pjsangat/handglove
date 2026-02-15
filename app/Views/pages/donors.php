<div id="donors-page" class="main-pages page-section">
    <div class="container">
        <!-- Hero Section: Coverage Map & Sponsors -->
        <div class="row align-items-start mb-5">
            <div class="col-md-7">
                <div class="text-center mb-4">
                    <h2 class="hero-title">Clinician <span class="highlight-orange">Light Up The Sky</span> <span class="highlight-blue">2025</span></h2>
                </div>
                <div class="coverage-map">
                    <img src="<?= base_url('assets/img/map-with-pins.png') ?>" alt="Coverage Map" class="img-fluid">
                </div>
            </div>
            <div class="col-md-5">
                <div class="sponsors-section p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="dash mr-2"></div>
                        <h4 class="mb-0 text-uppercase donor-heading">Donors & Sponsors</h4>
                    </div>
                    <div class="row sponsors-grid align-items-center">
                        <?php if(!empty($donors)): ?>
                            <?php foreach($donors as $donor): ?>
                                <div class="col-6 mb-4 text-center">
                                    <?php if($donor['url']): ?>
                                        <a href="<?= $donor['url'] ?>" target="_blank">
                                            <img src="<?= base_url($donor['logo']) ?>" alt="<?= $donor['name'] ?>" class="img-fluid donor-logo">
                                        </a>
                                    <?php else: ?>
                                        <img src="<?= base_url($donor['logo']) ?>" alt="<?= $donor['name'] ?>" class="img-fluid donor-logo">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Celebrating Weekly Clinician -->
        <div class="weekly-clinician mt-5 pt-5 border-top">
            <h2 class="section-title mb-5">Celebrating Weekly Clinician</h2>
            <div class="row">
                <!-- GNA Of the Week -->
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="text-brown mb-0">GNA Of the Week</h5>
                        <div class="dash ml-2 flex-grow-1"></div>
                    </div>
                    <div class="clinician-cards">
                        <div class="clinician-card d-flex align-items-center mb-4 pb-3 border-bottom">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">LinkedIn Member</h6>
                                <p class="mb-0 small text-muted">GNA at ManorCare</p>
                                <p class="mb-0 smallest text-muted">Hyattsville, KS</p>
                            </div>
                        </div>
                        <div class="clinician-card d-flex align-items-center mb-4 pb-3 border-bottom">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">LinkedIn Member</h6>
                                <p class="mb-0 small text-muted">GNA at Cromwell Care and Rehab</p>
                                <p class="mb-0 smallest text-muted">Baltimore City County, MD</p>
                            </div>
                        </div>
                        <div class="clinician-card d-flex align-items-center">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Aisha Dent</h6>
                                <p class="mb-0 small text-muted">GNA / GNA</p>
                                <p class="mb-0 smallest text-muted">Baltimore, MD</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nurse Of the Week -->
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="text-orange mb-0">Nurse Of the Week</h5>
                        <div class="dash ml-2 flex-grow-1"></div>
                    </div>
                    <div class="clinician-cards">
                        <div class="clinician-card d-flex align-items-center mb-4 pb-3 border-bottom">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Abi Hamilton</h6>
                                <p class="mb-0 small text-muted">Licensed Practical Nurse</p>
                                <p class="mb-0 smallest text-muted">Benton, KS</p>
                            </div>
                        </div>
                        <div class="clinician-card d-flex align-items-center mb-4 pb-3 border-bottom">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Kisha Griffin</h6>
                                <p class="mb-0 small text-muted">Registered Nurse</p>
                                <p class="mb-0 smallest text-muted">United States</p>
                            </div>
                        </div>
                        <div class="clinician-card d-flex align-items-center">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Danielle N. N.</h6>
                                <p class="mb-0 small text-muted">LPN Case Nurse</p>
                                <p class="mb-0 smallest text-muted">Jersey City Metropolitan Area</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DON Of the Week -->
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="text-blue mb-0">DON Of the Week</h5>
                        <div class="dash ml-2 flex-grow-1"></div>
                    </div>
                    <div class="clinician-cards">
                        <div class="clinician-card d-flex align-items-center mb-4 pb-3 border-bottom">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Don Jensen</h6>
                                <p class="mb-0 small text-muted">Sr. Director Baylor Scott</p>
                                <p class="mb-0 smallest text-muted">Frisco, TX</p>
                            </div>
                        </div>
                        <div class="clinician-card d-flex align-items-center mb-4 pb-3 border-bottom">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Don Bui</h6>
                                <p class="mb-0 small text-muted">Director of Clinical Quality</p>
                                <p class="mb-0 smallest text-muted">Laguna Hills, CA</p>
                            </div>
                        </div>
                        <div class="clinician-card d-flex align-items-center">
                            <img src="<?= base_url('assets/img/blank-img.png') ?>" alt="Member" class="winner-avatar">
                            <div class="ml-3">
                                <h6 class="mb-0">Don Woods</h6>
                                <p class="mb-0 small text-muted">Senior Living Advisor</p>
                                <p class="mb-0 smallest text-muted">Omaha, NE</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scholarship Section -->
        <div class="scholarship-section mt-5 pt-5 border-top">
            <h2 class="section-title mb-5">Scholarship</h2>
            <div class="row justify-content-center scholarship-cards">
                <div class="col-md-3 mb-4">
                    <img src="<?= base_url('assets/img/scholarship-card1.jpg') ?>" alt="Scholarship" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="<?= base_url('assets/img/scholarship-card2.jpg') ?>" alt="Scholarship" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-3 mb-4">
                    <img src="<?= base_url('assets/img/scholarship-card3.jpg') ?>" alt="Scholarship" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</div>
