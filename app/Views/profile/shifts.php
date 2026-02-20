<?php
    echo view('profile/includes/profile_banner');
?>

<div id="profile-bios" class="mb-5">
    <div class="container">
        <div class="row">
            <div id="profile-main" class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="profile-shifts">
                    <div class="heading">
                        <h2>My Shifts</h2>
                        <div class="buttons">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control datepicker" id="shiftDate" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                    </div>

                    <div id="clinicianShiftConfirmations"></div>
                    <div id="clinicianShifts"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="punchInModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Punch in</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="requestConfirmation"></div>

                <div class="punchDetails">

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="clockInDate"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="clockInStartTime"></div>
                            <div class="clockInStartTimeLabel">START TIME</div>
                        </div>
                        <div class="col-md-4">
                            <div class="clockInLabel">IN</div>
                        </div>
                        <div class="col-md-4">
                            <div class="clockInEndTime">00:00</div>
                            <div class="clockInEndTimeLabel">DURATION</div>
                        </div>
                    </div>
                </div>
                <div id="barCodeContainer">
                    <svg id="punchInBarcode"></svg>
                </div>
                
                <hr>
                <button style="width: 100%;" class="clock-in-clinician btn thm-btn p-4"><i class="fa fa-clock"></i> Punch In</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="punchOutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Punch out</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="requestConfirmation"></div>
                <div class="punchDetails text-left">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="clockOutDate text-center"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="clockOutStartTime"></div>
                            <div class="clockOutStartTimeLabel">END TIME</div>
                        </div>
                        <div class="col-md-4">
                            <div class="clockOutLabel">OUT</div>
                        </div>
                        <div class="col-md-4">
                            <div class="clockOutEndTime">00:00</div>
                            <div class="clockOutEndTimeLabel">DURATION</div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 ">
                    <?php if (in_array($profileData['type'], [2, 3])): ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">POC</label>
                            <select name="poc" id="poc" class="form-control selectpicker">
                                <option value="0">Incomplete</option>
                                <option value="10">Completed</option>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (in_array($profileData['type'], [1, 4])): ?>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="">ADL</label>
                            <select name="adl" id="adl" class="form-control selectpicker">
                                <option value="0">Incomplete</option>
                                <option value="10">Completed</option>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3" id="supervisorSignature">
                    <label for="">Supervisor Signature</label>
                    <div id="signature-pad" class="signature-pad text-center">
                        <div id="canvas-wrapper" class="signature-pad--body" style="text-align: center;">
                            <canvas style="border: 1px solid #ccc;"></canvas>
                        </div>
                        <div class="buttons text-center">
                            <button type="button" class="btn btn-black clear" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-black" data-action="undo" title="Ctrl-Z">Undo</button>
                        </div>
                    </div>
                </div>
                <hr>
                <button style="width: 100%;" class="clock-out-supervisor btn thm-btn p-4"><i class="fa fa-clock"></i> Punch Out</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ratingModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Rate the Facility</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div id="ratingConfirmation"></div>
                <form id="ratingForm">
                    <input type="hidden" name="shiftID" id="ratingShiftID">
                    
                    <div class="rating-category mb-3">
                        <label class="d-block mb-1">Cleanliness</label>
                        <div class="star-rating" data-category="cleanliness">
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="1"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="2"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="3"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="4"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="5"></i>
                            <input type="hidden" name="cleanliness" value="0">
                        </div>
                    </div>

                    <div class="rating-category mb-3">
                        <label class="d-block mb-1">Work Environment</label>
                        <div class="star-rating" data-category="work_environment">
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="1"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="2"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="3"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="4"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="5"></i>
                            <input type="hidden" name="work_environment" value="0">
                        </div>
                    </div>

                    <div class="rating-category mb-3">
                        <label class="d-block mb-1">Tools Needed</label>
                        <div class="star-rating" data-category="tools_needed">
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="1"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="2"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="3"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="4"></i>
                            <i class="far fa-star fa-2x cursor-pointer text-warning" data-value="5"></i>
                            <input type="hidden" name="tools_needed" value="0">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Comment</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Tell us more about your experience..."></textarea>
                    </div>

                    <button type="submit" class="btn thm-btn w-100 mt-4 p-3">Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.cursor-pointer { cursor: pointer; }
.star-rating i.fas { font-weight: 900; }
</style>
