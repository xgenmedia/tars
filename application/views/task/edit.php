<div class="container-fluid">
	<ol class="breadcrumb" style="margin-top:80px;">
		<li> <a href="<?php echo base_url("dashboard");?>" > Dashboard</a></li>
  		<li> <a href="<?php echo base_url("task");?>" > Resource</a></li>
  		<li class="active"> Add / Edit Resource</li>
	</ol>
	<div class="row-fluid">
		 <div class="col-sm-3">
		 		<?php $this->load->view("components/left_side_bar");?>
		 </div>
		 <div class="col-sm-9">
		 	<?php echo validation_errors(); ?>
		 	<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                  echo form_open('', $attributes); 
              ?>
			 <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">Code</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="code" name="code" value="<?php if(isset($values[0]->code)) echo $values[0]->code;?>" placeholder="Enter Code">
                  </div>
              </div>
              <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($values[0]->title)) echo $values[0]->title;?>" placeholder="Enter Title">
                  </div>
              </div>    
              <div class="form-group">
                  <label for="description" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" id="description" name="description" placeholder="Enter Description"><?php if(isset($values[0]->description)) echo $values[0]->description;?></textarea>
                  </div>
              </div>  
           
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <?php echo anchor(site_url('task'),'Cancel','class="btn btn-default"');?>
                  </div>
              </div>
              <?php echo form_close();?>
		 </div>
	</div>
</div>