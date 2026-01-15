<div id="facility_jobs">
    <div class="card">
        <div class="card-body">
            <div class="heading">
                <h2>Jobs</h2>
                <div class="buttons">
                    <select id="shiftTime" class="selectpicker">
                        <option value="all">All</option>
                        <option value="am">Morning</option>
                        <option value="pm">Afternoon</option>
                        <option value="eve">Night</option>
                    </select>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control datepicker" id="shiftDate" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <a href="" class="btn thm-btn"  data-toggle="modal" data-target="#addUnitModal">Add Shift</a>
                </div>
            </div>

            <div id="formConfirmation"></div>
            <div>
            </div>
            <table id="units_table" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 75%;">Details</th>
                        <th style="width: 300px;text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addUnitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Add Shift</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="validationErrors"></div>
                <form action="" id="unitAddForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Type</label>
                                <select name="shift_type" id="shift_type" class="form-control selectpicker" data-title="Select shift type..">
                                    <?php foreach($shiftTypes as $shiftType){ ?>
                                        <option value="<?php echo $shiftType['id']; ?>"><?php echo $shiftType['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Rate/hr ($)</label>
                                <input type="number" name="rate" class="form-control" steps="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Unit</label>
                                <select name="unit_id" id="unit_id" class="form-control selectpicker" data-title="Select unit..">
                                    <?php foreach($units as $unit){ ?>
                                        <option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="text" name="date" class="form-control datepicker" readonly autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Time</label>
                                <select name="time" id="time" class="form-control selectpicker" data-title="Select time..">
                                    <?php foreach($shiftTimes as $shiftTime){ ?>
                                        <option value="<?php echo $shiftTime; ?>"><?php echo $shiftTime; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Open Positions</label>
                                <input type="number" name="slots" class="form-control" steps="1">
                            </div>
                        </div>
                    </div>
            
                </form>
            </div>
            <div class="modal-footer">
                <div class="buttons">
                    <a href="javascript:;" class="btn thm-btn" id="submitUnit">Add Shift</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Request for Clinicians</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="requestConfirmation"></div>
                <table id="clinicians_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Clinician Details</th>
                            <th style="width: 15%;">Type</th>
                            <th style="width: 15%;">Level</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 15%;text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="applicantsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong><span id="shift-details-id"></span></strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label id="shiftDetailsDateTime" class="shiftDetails mb-2" style="font-size: 20px;"></label>
                            <div><span class="alert alert-warning text-center p-1" id="shiftDetailsSlots"></span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-right">
                            <a href="javascript:;" class="cancel-shift btn btn-danger">Cancel Shift</a>
                            <a href="javascript:;" class="edit-shift btn thm-btn">Edit Shift</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Role/Type</label>
                                    <div id="shiftDetailsType" class="shiftDetails"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Unit</label>
                                    <div id="shiftDetailsUnit" class="shiftDetails"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div id="applicationConfirmation"></div>
                        <table id="applicants_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Clinician Details</th>
                                    <th style="width: 15%;">Type</th>
                                    <th style="width: 15%;">Level</th>
                                    <th style="width: 15%;text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

