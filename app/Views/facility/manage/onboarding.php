<div id="facility_onboarding">
    <div class="card">
        <div class="card-body">
            <div class="heading">
                <h2>Onboarding</h2>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="settings-tab" data-toggle="tab" data-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="true">Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="files-tab" data-toggle="tab" data-target="#files" type="button" role="tab" aria-controls="files" aria-selected="false">Files</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="settings-tab" style="padding: 20px;">
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
                                        <select name="access[doors][]" data-title="Select door access.." id="access" class="selectpicker form-control" multiple>
                                            <option value="Front" <?php echo (isset($onboardingSettings['access']['doors']) && in_array('Front', $onboardingSettings['access']['doors']) ? 'selected' : '' ); ?>>Front Door</option>
                                            <option value="Back" <?php echo (isset($onboardingSettings['access']['doors']) && in_array('Back', $onboardingSettings['access']['doors']) ? 'selected' : '' ); ?>>Back Door</option>
                                            <option value="Pixel" <?php echo (isset($onboardingSettings['access']['doors']) && in_array('Pixel', $onboardingSettings['access']['doors']) ? 'selected' : '' ); ?>>Pixel Room</option>
                                        </select>
                                    </div>

                                    <div class="access-pin-codes">
                                        <div class="row">
                                            <div class="col-md-4 pin-codes" id="access-front-pin" <?php echo (isset($onboardingSettings['access']['doors']) && in_array('Front', $onboardingSettings['access']['doors']) ? 'style="display: block;"' : '' ); ?>>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 12px;">Front Door Code</label>
                                                    <input type="text" name="access[pins][front]" value="<?php echo (isset($onboardingSettings['access']['pins']['front']) ? $onboardingSettings['access']['pins']['front'] : '' ); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pin-codes" id="access-back-pin" <?php echo (isset($onboardingSettings['access']['doors']) && in_array('Back', $onboardingSettings['access']['doors']) ? 'style="display: block;"' : '' ); ?>>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 12px;">Back Door Code</label>
                                                    <input type="text" name="access[pins][back]" value="<?php echo (isset($onboardingSettings['access']['pins']['back']) ? $onboardingSettings['access']['pins']['back'] : '' ); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pin-codes" id="access-pixel-pin"  <?php echo (isset($onboardingSettings['access']['doors']) && in_array('Pixel', $onboardingSettings['access']['doors']) ? 'style="display: block;"' : '' ); ?>>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 12px;">Pixel Room Code</label>
                                                    <input type="text" name="access[pins][pixel]" value="<?php echo (isset($onboardingSettings['access']['pins']['pixel']) ? $onboardingSettings['access']['pins']['pixel'] : '' ); ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
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
                                        <label for="">Allow Overtime</label>
                                        <div>
                                            <input type="checkbox" <?php echo (isset($onboardingSettings['allow_overtime']) && $onboardingSettings['allow_overtime'] == 10 ? 'checked' : '' ); ?> name="allow_overtime" value="10" data-toggle="toggle" data-on="Yes" data-off="No" data-height="20" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Task Delay</label>
                                        <select name="task_delay[]" data-title="Select task delay approval.." id="task_delay" class="selectpicker form-control" multiple>
                                            <option value="all" <?php echo (isset($onboardingSettings['task_delay']) && in_array('all', $onboardingSettings['task_delay']) ? 'selected' : '' ); ?>>All Supervisor</option>
                                            <option value="unit_manager" <?php echo (isset($onboardingSettings['task_delay']) && in_array('unit_manager', $onboardingSettings['task_delay']) ? 'selected' : '' ); ?>>Unit Manager</option>
                                            <option value="scheduler" <?php echo (isset($onboardingSettings['task_delay']) && in_array('scheduler', $onboardingSettings['task_delay']) ? 'selected' : '' ); ?>>Scheduler</option>
                                            <option value="don" <?php echo (isset($onboardingSettings['task_delay']) && in_array('don', $onboardingSettings['task_delay']) ? 'selected' : '' ); ?>>DON</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Back up approval to avoid penalty</label>
                                        <select name="back_up_approval[]" data-title="Select backup approval.." id="back_up_approval" class="selectpicker form-control" multiple>
                                            <option value="hr" <?php echo (isset($onboardingSettings['back_up_approval']) && in_array('hr', $onboardingSettings['back_up_approval']) ? 'selected' : '' ); ?>>HR</option>
                                            <option value="don" <?php echo (isset($onboardingSettings['back_up_approval']) && in_array('don', $onboardingSettings['back_up_approval']) ? 'selected' : '' ); ?>>DON</option>
                                            <option value="admin" <?php echo (isset($onboardingSettings['back_up_approval']) && in_array('admin', $onboardingSettings['back_up_approval']) ? 'selected' : '' ); ?>>Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="">Phone extn</label>
                                    <div class="row mb-1" id="PhoneExtnClone">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="phone[type][]" placeholder="Type" disabled>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="phone[name][]" placeholder="Name" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="phone[extn][]" placeholder="Extn" disabled>
                                        </div>
                                        <a href="javascript:;" class="btn remove-phone-extn">X</a>
                                    </div>
                                    <div id="phoneExtnContainer">
                                        <?php 
                                        if(isset($onboardingSettings['phone']) && isset($onboardingSettings['phone']['type'])){ 
                                            if(count($onboardingSettings['phone']['type']) > 0){
                                                for($ctr = 0; $ctr < count($onboardingSettings['phone']['type']); $ctr++){
                                                    echo '<div class="row mb-1">';
                                                        echo '<div class="col-md-3">';
                                                            echo '<input type="text" class="form-control" name="phone[type][]" value="'.$onboardingSettings['phone']['type'][$ctr].'" placeholder="Type">';
                                                        echo '</div>';
                                                        echo '<div class="col-md-5">';
                                                            echo '<input type="text" class="form-control" name="phone[name][]" value="'.$onboardingSettings['phone']['name'][$ctr].'" placeholder="Name" >';
                                                        echo '</div>';
                                                        echo '<div class="col-md-4">';
                                                            echo '<input type="text" class="form-control" name="phone[extn][]" value="'.$onboardingSettings['phone']['extn'][$ctr].'" placeholder="Extn" >';
                                                        echo '</div>';
                                                        echo '<a href="javascript:;" class="btn remove-phone-extn"><i class="fa fa-times"></i></a>';
                                                    echo '</div>';
                                                }
                                            }
                                        }    
                                        ?>
                                    </div>
                                    <div class="text-right">
                                        <a href="javascript:;" class="add-phone-extn">Add Row</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="buttons text-right mt-5">
                            <a href="javascript:;" class="btn thm-btn" id="submitOnboardingSettings">Save</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab" style="padding: 20px;">
                    <div id="formConfirmation"></div>

                    <div class="buttons text-right">
                        <a href="" class="btn thm-btn"  data-toggle="modal" data-target="#addFileModal">Add Files</a>
                    </div>
                    <table id="files_table" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Name</th>
                                <th style="width: 15%;text-align: center;">PDF</th>
                                <th style="width: 15%;text-align: center;">Youtube</th>
                                <th style="width: 30%;text-align: center;">Actions</th>
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

<div class="modal fade" id="addFileModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Add File</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="insertValidationErrors"></div>
                <form action="" id="fileAddForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="name_add">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" rows="2" id="description_add" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nurse PDF File</label>
                               <input type="file" class="form-control" name="pdf"  accept=".pdf">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Youtube link</label>
                                <input type="text" name="youtube_link" id="youtube_link_add" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Supervisor Checklist</label>
                               <input type="file" class="form-control" name="supervisor_checklist"  accept=".pdf">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Command</label>
                                <input type="text" name="command" id="command_add" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="buttons">
                    <a href="javascript:;" class="btn thm-btn" id="submitAddOnboarding">Add File</a>
                </div>
            </div>
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
                <form action="" id="fileUpdateForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="hidden" name="onboardingID" id="onboardingID">
                                <input type="text" class="form-control" name="name" id="name">

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