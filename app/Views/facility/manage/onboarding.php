<div id="facility_onboarding">
    <div class="card">
        <div class="card-body">
            <div class="heading">
                <h2>Onboarding</h2>
            </div>

            <h4>Settings</h4>
            <div id="settingConfirmation"></div>
            <div id="settingValidationErrors"></div>
            <div class="onboarding-form">
                <form action="" id="onboardingSettingsForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Timezone</label>
                                <select name="timezone" data-title="Select timezone.." id="timezone" class="selectpicker form-control">
                                    <option value="America/New_York" <?php echo (isset($onboardingSettings['timezone']) && $onboardingSettings['timezone'] == 'America/New_York' ? 'selected' : '' ); ?>>America/New_York</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Clock In</label>
                                <select name="clock_in[]" data-title="Select clock-in type.." id="clock_in" class="selectpicker form-control" multiple>
                                    <option value="Web" <?php echo (isset($onboardingSettings['clock_in']) && in_array('Web', $onboardingSettings['clock_in']) ? 'selected' : '' ); ?>>Web</option>
                                    <option value="SMS" <?php echo (isset($onboardingSettings['clock_in']) && in_array('SMS', $onboardingSettings['clock_in']) ? 'selected' : '' ); ?>> SMS</option>
                                    <option value="Kiosk" <?php echo (isset($onboardingSettings['clock_in']) && in_array('Kiosk', $onboardingSettings['clock_in']) ? 'selected' : '' ); ?>>Kiosk</option>
                                    <option value="GeoFence" <?php echo (isset($onboardingSettings['clock_in']) && in_array('GeoFence', $onboardingSettings['clock_in']) ? 'selected' : '' ); ?>>GeoFence</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Access</label>
                                <select name="access[]" data-title="Select door access.." id="access" class="selectpicker form-control" multiple>
                                    <option value="Front" <?php echo (isset($onboardingSettings['access']) && in_array('Front', $onboardingSettings['access']) ? 'selected' : '' ); ?>>Front Door</option>
                                    <option value="Back" <?php echo (isset($onboardingSettings['access']) && in_array('Back', $onboardingSettings['access']) ? 'selected' : '' ); ?>>Back Door</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Clock out Approval</label>
                                <select name="clock_out_approval[]" data-title="Select clock-out approval.." id="clock_out_approval" class="selectpicker form-control" multiple>
                                    <option value="all" <?php echo (isset($onboardingSettings['clock_out_approval']) && in_array('all', $onboardingSettings['clock_out_approval']) ? 'selected' : '' ); ?>>All Supervisor</option>
                                    <option value="unit_manager" <?php echo (isset($onboardingSettings['clock_out_approval']) && in_array('unit_manager', $onboardingSettings['clock_out_approval']) ? 'selected' : '' ); ?>>Unit Manager</option>
                                    <option value="scheduler" <?php echo (isset($onboardingSettings['clock_out_approval']) && in_array('scheduler', $onboardingSettings['clock_out_approval']) ? 'selected' : '' ); ?>>Scheduler</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Task Delay</label>
                                <select name="task_delay[]" data-title="Select task delay approval.." id="task_delay" class="selectpicker form-control" multiple>
                                    <option value="all" <?php echo (isset($onboardingSettings['task_delay']) && in_array('all', $onboardingSettings['task_delay']) ? 'selected' : '' ); ?>>All Supervisor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Back up approval to avoid penalty</label>
                                <select name="back_up_approval[]" data-title="Select backup approval.." id="back_up_approval" class="selectpicker form-control" multiple>
                                    <option value="all" <?php echo (isset($onboardingSettings['back_up_approval']) && in_array('all', $onboardingSettings['back_up_approval']) ? 'selected' : '' ); ?>>All Supervisor</option>
                                    <option value="unit_manager" <?php echo (isset($onboardingSettings['back_up_approval']) && in_array('unit_manager', $onboardingSettings['back_up_approval']) ? 'selected' : '' ); ?>>Unit Manager</option>
                                    <option value="scheduler" <?php echo (isset($onboardingSettings['back_up_approval']) && in_array('scheduler', $onboardingSettings['back_up_approval']) ? 'selected' : '' ); ?>>Scheduler</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">Phone extn</label>

                            <div class="row mb-1">
                                <div class="col-md-3">On call</div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="phone[on_call][name]" placeholder="Name" value="<?php echo (isset($onboardingSettings['phone']['on_call']['name']) ? $onboardingSettings['phone']['on_call']['name'] : '') ; ?>">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phone[on_call][ext]" placeholder="Ext" value="<?php echo (isset($onboardingSettings['phone']['on_call']['name']) ? $onboardingSettings['phone']['on_call']['ext'] : '') ; ?>">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-3">Dietary</div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="phone[dietary][name]" placeholder="Name" value="<?php echo (isset($onboardingSettings['phone']['dietary']['name']) ? $onboardingSettings['phone']['dietary']['name'] : '') ; ?>">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phone[dietary][ext]" placeholder="Ext" value="<?php echo (isset($onboardingSettings['phone']['dietary']['ext']) ? $onboardingSettings['phone']['dietary']['ext'] : '') ; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Cleaner</div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="phone[cleaner][name]" placeholder="Name" value="<?php echo (isset($onboardingSettings['phone']['cleaner']['name']) ? $onboardingSettings['phone']['cleaner']['name'] : '') ; ?>">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phone[cleaner][ext]" placeholder="Ext" value="<?php echo (isset($onboardingSettings['phone']['cleaner']['ext']) ? $onboardingSettings['phone']['cleaner']['ext'] : '') ; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="buttons text-right">
                    <a href="javascript:;" class="btn thm-btn" id="submitOnboardingSettings">Save</a>
                </div>
            </div>

            <div class="heading mt-5">
                <h4>Files</h4>
            </div>
            
            <div id="formConfirmation"></div>
            <table id="files_table" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 40%;">Name</th>
                        <th style="width: 22.5%;text-align: center;">PDF</th>
                        <th style="width: 22.5%;text-align: center;">Youtube</th>
                        <th style="width: 15%;text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="modal fade" id="updateFileModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Update File</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="validationErrors"></div>
                <form action="" id="fileAddForm">
                    <div id="validationErrors"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="hidden" name="onboardingID" id="onboardingID">
                                <select name="name" data-title="Select type" id="name" class="selectpicker form-control">
                                    <option value="Floor tour">Floor tour</option>
                                    <option value="AED Pixel">AED Pixel</option>
                                    <option value="Med room">Med room</option>
                                    <option value="Code blue">Code blue</option>
                                    <option value="Discharge">Discharge</option>
                                    <option value="Admission">Admission</option>
                                    <option value="Assignment sheet">Assignment sheet</option>
                                    <option value="Fall">Fall</option>
                                    <option value="Missed Punch">Missed Punch</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" rows="2" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">PDF File</label>
                               <input type="file" class="form-control" name="pdf"  accept=".pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Youtube link</label>
                                <input type="text" name="youtube_link" id="youtube_link" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Command</label>
                                <input type="text" name="command" id="command" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="buttons">
                    <a href="javascript:;" class="btn thm-btn" id="submitOnboarding">Update File</a>
                </div>
            </div>
        </div>
    </div>
</div>