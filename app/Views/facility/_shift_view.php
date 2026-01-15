<div class="shift-view" id="shift_view-<?php echo $id; ?>">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <a href="javascript:;" class="view-shift" data-id="<?php echo $id; ?>" style="font-size: 20px; font-weight: bold;">Shift # <?php echo $id; ?></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Date</label>
                <div class="form-details" id="shift-details-date"><?php echo date("M d, Y", strtotime($start_date)); ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Time</label>
                <div class="form-details" id="shift-details-time"><?php echo date("h:i A", strtotime($shift_start_time)) . ' - ' . date("h:i A", strtotime($shift_end_time)); ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Unit</label>
                <div class="form-details" id="shift-details-unit"><?php echo $unit_name; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Role/Type</label>
                <div class="form-details" id="shift-details-role"><?php echo $type_name; ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Open Positions</label>
                <div class="form-details" id="shift-details-slot"><?php echo $accepted > 0 ? $accepted : 0; ?>/<?php echo $slots; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Applicants</label>
                <div class="form-details">
                    <?php 
                    if(!empty($requests)){
                        foreach($requests as $request){
                            echo '<div>'.$request['clinician_name'].'</div>';
                        }    
                    }else{
                        echo 'None';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Accepted</label>
                
                <div class="form-details">
                    <?php 
                    if(!empty($accepted_arr)){
                        foreach($accepted_arr as $request){
                            echo '<div>'.$request['clinician_name'].'</div>';
                        }    
                    }else{
                        echo 'None';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
