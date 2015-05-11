<style type="text/css">
#assignfieldsWrapper{
	margin-top:80px;
	margin-left: 100px;
}
.checkbox{
	margin-left: 50px;
}
h4{
	margin-bottom: 30px;
}
</style>
<?php //echo '<pre>'; print_r($fields);?>
<div id="assignfieldsWrapper" >
	<a href="<?php echo base_url('formfields/createfield') ;?>">Create a field</a>
	<h4>Please Select the fields for <?php echo $form_name ;?></h4>
	<?php echo form_open("",array('class' => 'form-horizontal')); 
	foreach($fields as $field){ ?>
		<div class="checkbox">
  			<label>
    			<input type="checkbox" name="fieldList[]" value="<?php echo $field->id; ?>">
    		Field Name: <strong><?php echo $field->name; ?></strong> | Field Type: <strong><?php echo $field->type; ?></strong>   
  			</label>
		</div>		
	<?php } ?>
	
    <button type="submit" class="btn btn-primary">Submit</button>
    <?php echo form_close(); ?> 
</div>
