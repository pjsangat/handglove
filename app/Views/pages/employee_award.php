<div id="employee-award" class="page-container">
    <div class="container">
        <h1>Employee Award</h1>
        <div class="page-form">
            <div class="row">
                <div class="col-md-12">
                    <div id="awardFormContainer">
                        <form action="" id="awardForm" class="pl-5">
                            <h4>Tell us about the Person you are referring to work at</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select name="company_name" id="company_name" class="selectpicker form-control required" data-title="Select Company name.." data-live-search="true">
                                            <?php foreach($providers as $provider){ ?>
                                                <option value="<?php echo $provider['name']; ?>"><?php echo $provider['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" placeholder="Company Address" class="form-control required" id="company_address" name="company_address">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" placeholder="Zip Code" class="form-control required" id="zip_code" name="zip_code">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" placeholder="Supervisor Name" class="form-control required" id="supervisor_name" name="supervisor_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" placeholder="Supervisor Email" class="form-control required" id="supervisor_email" name="supervisor_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Supervisor Contact Number" class="form-control required" id="supervisor_contact_number" name="supervisor_contact_number">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="buttons text-right">
                        <button class="thm-btn" id="submit-award">Submit <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>