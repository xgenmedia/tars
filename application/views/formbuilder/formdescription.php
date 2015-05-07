<style type="text/css">
    #formbuilderWrapper{
        margin-top:150px;
    }   
    
</style>
<?php echo form_open("",array('class'=>'form-horizontal')); ?>
<div id="formbuilderWrapper">
    <div class="form-group">
        <label for="formName" class="col-sm-2 control-label">Form Name:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="formName" name= "formName" placeholder="Enter Form Name" />
        </div>
    </div>

    <div class="form-group">
        <label for="page_url" class="col-sm-2 control-label">Display URL: </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="page_url" name="url" placeholder="Enter the URL where the form will be displayed" />
        </div>
    </div>

    <div class="form-group">
        <label for="numberOfFields" class="col-sm-2 control-label">Enter Number of Fields:</label>
        <div class="col-sm-5">
            <input type="number" class="form-control" id="numOfFields" name="nof" placeholder="Enter Number of Fields ">
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Proceed</button>
        </div>
    </div>
</div>

<?php form_close(); ?>