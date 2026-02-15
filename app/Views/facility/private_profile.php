<?php
    echo view('facility/includes/profile_banner');
?>

<div id="profile-bios">
    <div class="container">
        <div class="row">
            <div id="profile-main" class="col-lg-8 col-md-12 col-sm-12 col-12">
                <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="shifts-tab" data-toggle="tab" href="#shifts" role="tab" aria-controls="shifts" aria-selected="true">Shifts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false">Invoices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="time-logs-tab" data-toggle="tab" href="#time-logs" role="tab" aria-controls="time-logs" aria-selected="false">Time Logs</a>
                    </li>
                </ul>
                <div class="tab-content" id="profileTabsContent">
                    <div class="tab-pane fade show active" id="shifts" role="tabpanel" aria-labelledby="shifts-tab">
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
                    <div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover paystub-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0 pl-4">Product</th>
                                                        <th class="border-top-0 text-center">Amount</th>
                                                        <th class="border-top-0 text-right">Price</th>
                                                        <th class="border-top-0 text-right pr-4">Price</th>
                                                        <th class="border-top-0"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-wrapper mr-3">
                                                                    <img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt="" class="rounded-circle avatar-sm">
                                                                    <span class="status-indicator online"></span>
                                                                </div>
                                                                <div>
                                                                    <div class="font-weight-bold">Alden Murray</div>
                                                                    <div class="text-muted small">Customer ID# 00224</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center align-middle">377 <span class="text-muted small">x</span></td>
                                                        <td class="text-right align-middle font-weight-bold">$ 80.00</td>
                                                        <td class="text-right align-middle font-weight-bold pr-4">$ 80.00</td>
                                                        <td class="text-center align-middle">
                                                            <a href="javascript:;" class="text-muted"><i class="fas fa-chevron-right"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-wrapper mr-3">
                                                                    <img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt="" class="rounded-circle avatar-sm">
                                                                    <span class="status-indicator online"></span>
                                                                </div>
                                                                <div>
                                                                    <div class="font-weight-bold">outdoor furniture</div>
                                                                    <div class="text-muted small">Lamp</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center align-middle">337 <span class="text-muted small">x</span></td>
                                                        <td class="text-right align-middle font-weight-bold">$ 50.00</td>
                                                        <td class="text-right align-middle font-weight-bold pr-4">$ 50.00</td>
                                                        <td class="text-center align-middle">
                                                            <a href="javascript:;" class="text-muted"><i class="fas fa-chevron-right"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-wrapper mr-3">
                                                                    <img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt="" class="rounded-circle avatar-sm">
                                                                    <span class="status-indicator online"></span>
                                                                </div>
                                                                <div>
                                                                    <div class="font-weight-bold">laundry bag with stand</div>
                                                                    <div class="text-muted small">Wallet</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center align-middle">217 <span class="text-muted small">x</span></td>
                                                        <td class="text-right align-middle font-weight-bold">$ 10.00</td>
                                                        <td class="text-right align-middle font-weight-bold pr-4">$ 10.00</td>
                                                        <td class="text-center align-middle">
                                                            <a href="javascript:;" class="text-muted"><i class="fas fa-chevron-right"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-wrapper mr-3">
                                                                    <img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt="" class="rounded-circle avatar-sm">
                                                                    <span class="status-indicator online"></span>
                                                                </div>
                                                                <div>
                                                                    <div class="font-weight-bold">laundry bag with stand</div>
                                                                    <div class="text-muted small">Wallet</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center align-middle">217 <span class="text-muted small">x</span></td>
                                                        <td class="text-right align-middle font-weight-bold">$ 10.00</td>
                                                        <td class="text-right align-middle font-weight-bold pr-4">$ 10.00</td>
                                                        <td class="text-center align-middle">
                                                            <a href="javascript:;" class="text-muted"><i class="fas fa-chevron-right"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="time-logs" role="tabpanel" aria-labelledby="time-logs-tab">
                        <div class="row">
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

                <div id="callout-heatmap" class="mt-5">
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
