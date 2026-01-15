<div class="card">
    <div class="card-body">
        <div class="heading">
            <h2>Clinicians</h2>
            <div class="buttons">
                <a href="" class="btn thm-btn"  data-toggle="modal" data-target="#addClinicianModal">Add Clinicians</a>
            </div>
        </div>

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
                <tr>
                    <td>1\asdsadsaas</td>
                    <td>2</td>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="addClinicianModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title">
                    <strong>Add Clinician</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Level</label>
                            <select name="tier" id="tier" class="form-control">
                                <option value="10">Junior</option>
                                <option value="20">Reliable</option>
                                <option value="30">Senior</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" id="type" class="form-control">
                                <?php foreach($clinicianTypes as $clinicianType){ ?>
                                    <option value="<?php echo $clinicianType['id']; ?>"><?php echo $clinicianType['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" id="zip_code">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <input type="text" class="form-control" name="contact_number" id="contact_number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="buttons">
                    <a href="javascript:;" class="btn thm-btn" id="submitUnit">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="clinicianModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
        <div class="modal-header">
            <div id="modal-title">
                <strong><span id="clinicianNameHeader"></span></strong>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Name</label>
                            <div class="form-details" id="clinicianName"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Level</label>
                            <div class="form-details" id="clinicianLevel"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Address</label>
                            <div class="form-details" id="clinicianAddress"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Type</label>
                            <div class="form-details" id="clinicianType"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Zip Code</label>
                            <div class="form-details" id="clinicianZip"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Email</label>
                            <div class="form-details" id="clinicianEmail"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <div class="form-details" id="clinicianContact"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Status</label>
                            <div class="form-details" id="clinicianStatus"></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
