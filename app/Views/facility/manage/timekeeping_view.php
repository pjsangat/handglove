<div id="profile-bios">
    <div class="container">
        <div class="row">
            <?php echo view('facility/sidebar'); ?>
            <div id="profile-main" class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4">
                            <a href="<?php echo base_url('facility/manage/timekeeping'); ?>" class="text-muted mb-2 d-inline-block"><i class="fas fa-arrow-left"></i> Back to Time Logs</a>
                            <h2 class="font-weight-bold">Timesheet #<?php echo $punch['shift_id']; ?></h2>
                            <?php echo $status_label; ?>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar-wrapper mr-3">
                                        <img src="<?php echo $punch['profile_pic_url'] ? $punch['profile_pic_url'] : base_url('assets/img/blank-img.png'); ?>" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h4 class="mb-0 font-weight-bold"><?php echo $punch['clinician_name']; ?></h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 border-right">
                                        <div class="d-flex align-items-start mb-4">
                                            <div class="mr-3 text-primary"><i class="fas fa-sign-in-alt fa-lg"></i></div>
                                            <div>
                                                <h5 class="font-weight-bold mb-3">Check-in</h5>
                                                <div class="mb-3">
                                                    <div class="text-muted small">Scheduled</div>
                                                    <div class="font-weight-bold"><?php echo date('m/d/Y - h:iA', strtotime($punch['shift_start_date'] . ' ' . $punch['shift_start_time'])); ?></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="text-muted small">Actual check-in</div>
                                                    <div class="font-weight-bold"><?php echo $clock_in ? date('m/d/Y - h:iA', strtotime($clock_in['punch_datetime'])) : '--'; ?></div>
                                                </div>
                                                <button class="btn btn-sm btn-light border text-muted px-4">Adjust check-in</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start mb-4 ml-md-3">
                                            <div class="mr-3 text-primary"><i class="fas fa-sign-out-alt fa-lg"></i></div>
                                            <div>
                                                <h5 class="font-weight-bold mb-3">Check-out</h5>
                                                <div class="mb-3">
                                                    <div class="text-muted small">Scheduled</div>
                                                    <div class="font-weight-bold"><?php echo date('m/d/Y - h:iA', strtotime($punch['shift_start_date'] . ' ' . $punch['shift_end_time'])); ?></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="text-muted small">Actual check-out</div>
                                                    <div class="font-weight-bold"><?php echo $clock_out ? date('m/d/Y - h:iA', strtotime($clock_out['punch_datetime'])) : '--'; ?></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="text-muted small">Adjusted check-out time</div>
                                                    <div class="text-muted font-italic">--</div>
                                                </div>
                                                <button class="btn btn-sm btn-light border text-muted px-4">Adjust check-out</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="font-weight-bold mb-4"><i class="far fa-clock mr-2 text-primary"></i> Hours Breakdown</h5>
                                        <div class="mb-3">
                                            <div class="text-muted small">Total shift time</div>
                                            <div class="font-weight-bold h5 mb-0"><?php echo $total_shift_time; ?> hrs</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Total break time</div>
                                            <div class="font-weight-bold h5 mb-0">0:00 hrs</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Payable time</div>
                                            <div class="font-weight-bold h5 mb-0"><?php echo $payable_time; ?> hrs</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="font-weight-bold mb-4"><i class="far fa-comments mr-2 text-primary"></i> Comments</h5>
                                        
                                        <div class="d-flex align-items-start mb-4">
                                            <div class="mr-3">
                                                <div class="bg-success-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-check text-success"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-muted small"><?php echo date('M d, Y h:i A', strtotime($punch['punch_datetime'])); ?></div>
                                                <div class="font-weight-bold"><?php echo $punch['clinician_name']; ?> checked in for this timesheet</div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start mb-4">
                                            <div class="mr-3">
                                                <img src="<?php echo $punch['profile_pic_url'] ? $punch['profile_pic_url'] : base_url('assets/img/blank-img.png'); ?>" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                            </div>
                                            <div>
                                                <div class="font-weight-bold mb-0"><?php echo $punch['clinician_name']; ?></div>
                                                <div class="text-muted small">Nurse</div>
                                            </div>
                                        </div>

                                        <button class="btn btn-outline-primary btn-block rounded-pill py-2">Add a comment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-light {
        background-color: #e6f7ec;
    }
    .card {
        border-radius: 10px;
    }
    h2, h4, h5 {
        color: #0d2149;
    }
</style>
