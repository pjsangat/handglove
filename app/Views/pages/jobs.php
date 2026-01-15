<div id="jobs-container">
    <div class="container">
        <?php if( !isset($profileData)){ ?>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="filler-job-form">
                    <i class="fa fa-clipboard"></i>
                    <select class="form-select form-control selectpicker" data-title="Select Job Type">
                        <option value="1">RN</option>
                        <option value="3">CNA</option>
                        <option value="4">GNA</option>
                        <option value="5">LPN/LVN</option>
                    </select>
                </div>
            </div><!--end col-->
            <div class="col-md-4 col-lg-3">
                <div>
                    <a href="javascript:void(0)" class="btn thm-btn"><i class="uil uil-filter"></i> Filter</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div id="jobs-list">
                    <div class="row">
                        <?php foreach($shifts as $shift){ ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="candidate-grid-box bookmark-post card mt-4">
                                    <div class="card-body p-4">

                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0 position-relative">
                                                <img src="<?php echo base_url('assets/img/blank-img.png'); ?>" alt="" class="avatar-md rounded">
                                            </div>
                                            <div class="ml-3">
                                                <a href="candidate-details.html" class="primary-link"><h5 class="fs-17"><?php echo $shift['company_name']; ?></h5></a>
                                                <span class="badge bg-info-subtle text-info fs-13">$<?php echo $shift['rate']; ?>/hr</span>
                                            </div>
                                        </div>

                                        <div class="border rounded mb-4">
                                            <div class="row g-0">
                                                <div class="col-lg-9">
                                                    <div class="border-end px-3 py-2">
                                                        <p class="text-muted mb-0">Slots: <?php echo ($shift['slots'] - $shift['slots_taken']) . ' Remaining'; ?></p>
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="px-3 py-2">
                                                        <p class="text-muted mb-0"><?php echo $shift['type_name']; ?></p>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div>
                                        <p class="text-muted"><?php echo $shift['type_name']; ?> Needed: <?php echo date("M d, Y", strtotime($shift['start_date'])) . ' ' . date("h:i A", strtotime($shift['shift_start_time'])) . ' - ' . date("h:i A", strtotime($shift['shift_end_time'])); ?></p>
                                        <div class="mt-3">
                                            <a href="javascript:;" data-bs-toggle="modal" data-shift_id="<?php echo $shift['id']; ?>" class="<?php echo isset($profileData) ? 'apply-now' : 'apply'; ?> btn thm-btn w-100 mt-2"><i class="mdi mdi-account-check"></i> Apply Now</a>
                                            <a href="<?php echo base_url('facility/profile/' . $shift['client_id']); ?>" class="btn thm-btn-white w-100 mt-2"><i class="mdi mdi-eye"></i> View Profile</a>
                                        </div>
                                    </div>
                                </div> <!--end card-->
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="applicantsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Apply Now</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="applicationConfirmation"></div>
                <div id="employee-application">
                    <form class="formApplication" id="formApplication">
                        <div class="page-form mt-0 pl-3 pr-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="First Name" name="first_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Last Name" name="last_name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" placeholder="Email Address" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Contact Number"  name="contact_number"class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Certification or License</label>
                                            <?php 
                                                foreach($clinician_types as $clin_type){ 
                                                    echo '<div class="form-check form-switch">';
                                                        echo '<input class="form-check-input" type="radio" id="'.strtolower($clin_type['name']).'" name="type" value="'.$clin_type['id'].'">';
                                                        echo '<label for="'.strtolower($clin_type['name']).'">'.$clin_type['name'].'</label>';
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="">Do you have a resume? <div><small>If you'd like, you can upload a PDF file with your resume here.</small></div></label>
                                            
                                            <input type="file" name="cv" class="form-control" accept=".pdf,.jpg,.png,.jpeg">
                                            <div><small><em>Allowed File types: PDF, JPG, PNG files</em></small></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="buttons text-right">
                                                <input type="hidden" name="shift_id" id="shift_id_field">
                                                <button class="thm-btn" id="submit-application">Submit <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>