<?php
    echo view('facility/includes/profile_banner');
?>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <div id="profile-main" class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div id="scheduler-calendar"></div>
            </div>
            <div id="profile-sidebar" class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div id="callout-heatmap">
                    <h4>Call out Heatmap</h4>
                    <div class="heatmap-grid-container">
                        <div class="heatmap-grid">
                            <!-- Labels -->
                            <div class="grid-label"></div>
                            <div class="grid-day">Mon</div>
                            <div class="grid-day">Tue</div>
                            <div class="grid-day">Wed</div>
                            <div class="grid-day">Thu</div>
                            <div class="grid-day">Fri</div>
                            <div class="grid-day">Sat</div>
                            <div class="grid-day">Sun</div>

                            <!-- 3am Row -->
                            <div class="grid-time">3 am</div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-1"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-1"></div>

                            <!-- 6am Row -->
                            <div class="grid-time">6 am</div>
                            <div class="grid-cell lvl-2">2x</div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-3">4x</div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-1"></div>
                            <div class="grid-cell lvl-0"></div>

                            <!-- 9am Row -->
                            <div class="grid-time">9 am</div>
                            <div class="grid-cell lvl-1"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-1"></div>
                            <div class="grid-cell lvl-4">5x</div>
                            <div class="grid-cell lvl-1"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>

                            <!-- 12pm Row -->
                            <div class="grid-time">12 pm</div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-2">2x</div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-2">2x</div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-2">2x</div>
                            <div class="grid-cell lvl-0"></div>

                            <!-- 3pm Row -->
                            <div class="grid-time">3 pm</div>
                            <div class="grid-cell lvl-1"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-0"></div>
                            <div class="grid-cell lvl-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Schedule Modal -->
<div class="modal fade" id="uploadScheduleModal" tabindex="-1" role="dialog" aria-labelledby="uploadScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadScheduleModalLabel">Upload Schedule for <span id="selected-date-display"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadScheduleForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="shift_date" id="selected-date">
                    <div class="form-group">
                        <label for="schedule_file">Choose PDF Schedule</label>
                        <input type="file" class="form-control-file" id="schedule_file" name="schedule_file" accept=".pdf" required>
                        <small class="form-text text-muted">Please upload only PDF files (Max 10MB).</small>
                    </div>
                </div>
                <div class="modal-header d-flex justify-content-end border-0">
                    <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnUploadSchedule">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>