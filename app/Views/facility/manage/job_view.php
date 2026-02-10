<div id="job_view_page">
    <div class="card mb-4">
        <div class="card-body">
            <div class="heading mb-4">
                <h2>Shift # <?php echo $shift['id']; ?> Details</h2>
                <div class="buttons">
                    <a href="<?php echo base_url('facility/manage/jobs'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back to Jobs</a>
                    <a href="javascript:;" class="btn btn-danger cancel-shift" data-id="<?php echo $shift['id']; ?>">Cancel Shift</a>
                    <a href="javascript:;" class="btn thm-btn edit-shift" data-id="<?php echo $shift['id']; ?>">Edit Shift</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="info-box p-3 border rounded bg-light mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold mb-1">Date</label>
                        <div class="h5"><?php echo date("M d, Y", strtotime($shift['start_date'])); ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box p-3 border rounded bg-light mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold mb-1">Time</label>
                        <div class="h5"><?php echo date("h:i A", strtotime($shift['shift_start_time'])) . ' - ' . date("h:i A", strtotime($shift['shift_end_time'])); ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box p-3 border rounded bg-light mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold mb-1">Positions</label>
                        <div class="h5"><?php echo $shift['accepted_count']; ?> / <?php echo $shift['slots']; ?> Filled</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box p-3 border rounded bg-light mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold mb-1">Unit</label>
                        <div class="h5"><?php echo $shift['unit_name']; ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box p-3 border rounded bg-light mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold mb-1">Role / Type</label>
                        <div class="h5"><?php echo $shift['type_name']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-white pt-3 pb-0 border-0">
                    <h4>Applicants</h4>
                </div>
                <div class="card-body">
                    <div id="applicationConfirmation"></div>
                    <?php if(!empty($shift['applicants'])): ?>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Clinician</th>
                                        <th>Level</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($shift['applicants'] as $applicant): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php if($applicant['profile_pic_url']): ?>
                                                        <img src="<?php echo $applicant['profile_pic_url']; ?>" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <?php endif; ?>
                                                    <div>
                                                        <strong><?php echo $applicant['name']; ?></strong><br>
                                                        <small class="text-muted"><?php echo $applicant['type_name']; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $applicant['tier']; ?></td>
                                            <td class="text-center">
                                                <a href="javascript:;" data-shift-id="<?php echo $shift['id']; ?>" data-id="<?php echo $applicant['clinician_id']; ?>" data-value="20" class="respond-request btn btn-sm thm-btn px-3" title="Accept">Accept</a>
                                                <a href="javascript:;" data-shift-id="<?php echo $shift['id']; ?>" data-id="<?php echo $applicant['clinician_id']; ?>" data-value="100" class="respond-request btn btn-sm btn-danger px-3" title="Decline">Decline</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted py-3">No pending applications at the moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card h-100">
                <div class="card-header bg-white pt-3 pb-0 border-0">
                    <h4>Accepted Clinicians</h4>
                </div>
                <div class="card-body">
                    <?php if(!empty($shift['accepted_clinicians'])): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($shift['accepted_clinicians'] as $accepted): ?>
                                <li class="list-group-item d-flex align-items-center border-0 px-0">
                                    <?php if($accepted['profile_pic_url']): ?>
                                        <img src="<?php echo $accepted['profile_pic_url']; ?>" class="rounded-circle mr-3" style="width: 45px; height: 45px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div>
                                        <strong><?php echo $accepted['name']; ?></strong><br>
                                        <span class="badge bg-green text-white"><?php echo $accepted['type_name']; ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted py-3">No clinicians have been accepted for this shift yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
