<?php
    echo view('facility/includes/profile_banner');
?>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <div id="profile-main" class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>Shifts</h2>
                            <div class="buttons">
                                <select id="shiftUnit" class="selectpicker">
                                    <?php foreach($units as $unit){ ?>
                                        <option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div id="formConfirmation"></div>
                        <div id="facilityShifts">
                        </div>
                    </div>
                </div>
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
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="pccModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    PCC Request
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        Are you sure you want to submit PCC for this shift?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <a href="javascript:;" class="calloff-shift btn btn-success">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="calloffModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    Call off Shift
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        Are you sure you want to call off this clinician for this shift?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <a href="javascript:;" class="calloff-shift btn btn-warning">Call-off Shift</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="dnrModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    DNR Shift
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Reason</label>
                            <textarea name="dnr_message" id="dnr_message" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <a href="javascript:;" class="dnr-shift btn btn-danger">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
