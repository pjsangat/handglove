<div id="facility_jobs">
    <div class="card">
        <div class="card-body">
            <div class="heading">
                <h2>Shifts</h2>
                <div class="buttons">
                    <select id="shiftUnit" class="selectpicker">
                        <?php foreach($units as $unit){ ?>
                            <option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control datepicker" id="shiftDate" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>
            </div>

            <div id="formConfirmation"></div>

            <div id="facilityShifts">
                
            </div>
        </div>
    </div>
</div>