<div id="profile-bios">
    <div class="container">
        <div class="row">
            <?php echo view('facility/sidebar'); ?>
            <div id="profile-main" class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading d-flex justify-content-between align-items-center mb-4">
                            <h2>Time Logs</h2>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="timekeepingTable" class="table table-hover w-100">
                                        <thead>
                                            <tr>
                                                <th>Punch Datetime</th>
                                                <th>Clinician</th>
                                                <th>Shift Info</th>
                                                <th>Punch Type</th>
                                                <th>Action</th>
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
        </div>
    </div>
</div>
