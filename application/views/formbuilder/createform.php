<style type="text/css">
    #formfieldsWrapper{
        margin-top: 80px;
    }
    #formfieldsWrapper h4{
        margin-left: 50px;
    }
</style>
<?php
    echo form_open("", array('class' => 'form-horizontal'));
?>
<div id="formfieldsWrapper">
    <?php for ($i = 1; $i <= $nof; $i++) { ?>
    <div class="form-group" style="margin-top:30px">
        <h4>Field number: <?php echo $i ;?></h4>
        <div class="form-group">
            <label for="fieldName" class="col-sm-2 control-label">Field Name:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="fieldName" name= "name<?php echo '-'.$i?>" placeholder="Enter the Name of the field" />
            </div>
        </div>
     
        <div class="form-group">
            <label for="fieldType" class="col-sm-2 control-label">Field Type: </label>
            <div class="col-sm-5">
                
                <input type="text" class="form-control" id="fieldType" name="type<?php echo '-'.$i?>" placeholder="Enter the type of the field. e.g text, password etc" />
            </div>
        </div>

        <div class="form-group">
            <label for="required" class="col-sm-2 control-label">Mandatory:</label>
            <div class="col-sm-5">
                <select class="form-control" name="required<?php echo '-'.$i?>" id="fieldMandatory">
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
            </div>
        </div>
    </div>
    <?php } ?> 
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</div>
<?php form_close(); ?>