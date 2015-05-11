<style type="text/css">
    #formfieldsWrapper{
        margin-top: 150px;
        margin-left: 100px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        var optionNumber = 1;
       $('#fieldType').change(function(){
          var fieldtype = $('#fieldType').val();
          if(fieldtype=='select'){
              
            var optiontext= '<div class="form-group" id="optiondiv'+optionNumber+'">'
                +'<label for="optionValue" class="col-sm-2 control-label">Option:</label>'
                +'<div class="col-sm-3">'
                    +'<input type="text" class="form-control" id="option'+optionNumber+'" name= "option[]" placeholder="Enter the option" />'
                +'<a href="javascript:void(0)" id="addmoreOption">Add More</a></div>'
            +'</div>';
             $(optiontext).insertAfter("#fieldTypediv");
             optionNumber +=1; 
            }
       }); 
       $(document).on('click','#addmoreOption',function(){
         // var check = 
            var optionId = "#optiondiv"+(optionNumber-1);
            //var optionIdNext = "#"+(optionNumber+1);
            var optiontext= '<div class="form-group" id="optiondiv'+optionNumber+'">'
                +'<label for="optionValue" class="col-sm-2 control-label">Option:</label>'
                +'<div class="col-sm-3">'
                    +'<input type="text" class="form-control" id="option'+optionNumber+'" name= "option[]" placeholder="Enter the option" />'
                +'<a href="javascript:void(0)" id="addmoreOption">Add More</a></div>'
            +'</div>';
            $(optiontext).insertAfter(optionId);
            optionNumber +=1;
        });
    });
    
</script>
<div id="formfieldsWrapper">
    <h3><?php echo validation_errors(); ?></h3>
    <h3>Enter Field Details</h3>
    <?php
    echo form_open("", array('class' => 'form-horizontal'));
    ?>

    <div class="form-group" style="margin-top:30px">
        <div class="form-group">
            <label for="fieldName" class="col-sm-2 control-label">Field Name:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="fieldName" name= "name" placeholder="Enter the Name of the field" />
            </div>
        </div>
        
        <div class="form-group" id="fieldTypediv">
            <label for="fieldType" class="col-sm-2 control-label">Field Type:</label>
            <div class="col-sm-5" id="fieldTypediv">
                <select class="form-control" name="type" id="fieldType">
                    <option value="">--SELECT--</option>
                    <option value="text">text</option>
                    <option value="password">password</option>
                    <option value="textarea">textarea</option>
                    <option value="select">select</option>
                    <option value="checkbox">checkbox</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="required" class="col-sm-2 control-label">Mandatory:</label>
            <div class="col-sm-5">
                <select class="form-control" name="required" id="fieldMandatory">
                    <option value="">--Select--</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </div>
    <?php form_close() ?>
</div>    