<style type="text/css">
    #createformWrapper{
        margin-top: 80px;
    }
    #formfieldsWrapper h4{
        margin-left: 50px;
    }
</style>
<?php
    echo form_open("", array('class' => 'form-horizontal'));
?>
<div id="createformWrapper">
    <div class="form-group" style="margin-top:30px">
        
        <div class="form-group">
            <label for="formName" class="col-sm-2 control-label">Name:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="formName" name= "name" placeholder="Enter the Name of the form" />
            </div>
        </div>
     
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>