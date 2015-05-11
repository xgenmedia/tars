
<div class="container-fluid">
	<ol class="breadcrumb" style="margin-top:80px;">
		<li> <a href="<?php echo base_url("dashboard");?>" > Dashboard</a></li>
  		<li> <a href="<?php echo base_url("user");?>" > User</a></li>
  		<li class="active"> Add / Edit User </li>
	</ol>
	<div class="row-fluid">
		 <div class="col-sm-3">
		 		<?php $this->load->view("components/left_side_bar");?>
		 </div>
		 <div class="col-sm-9">
		 			<?php echo validation_errors(); ?>
			 		<form class="form-horizontal" method="POST" action="">
			 		  <div class="form-group">
			 		  	<label for="group" class="col-sm-2 control-label">Group</label>
			 		  	<div class="col-sm-10">
			 		  		<?php echo form_dropdown("group",$groups,$user->group_id,array('class'=>'form-control'));?>
			 		  	</div>	
			 		  </div>	
					  <div class="form-group">
					    <label for="email" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-10">
					      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user->email!=''?$user->email:set_value('email'); ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="password" class="col-sm-2 control-label">Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="confpass" class="col-sm-2 control-label">Confirm Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="confpass" name="confpass" placeholder="Confirm Password">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="name" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $user->name!=''?$user->name:set_value('name'); ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="phone" class="col-sm-2 control-label">Phone</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $user->phone!=''?$user->phone:set_value('phone'); ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="address" class="col-sm-2 control-label">Address</label>
					    <div class="col-sm-10">
					      	<textarea name="address" id="address" class="form-control" placeholder="Address"><?php echo $user->address!=''?$user->address:set_value('address'); ?></textarea>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary">Save</button>
					      <a href="<?php echo site_url("user");?>" class="btn btn-default">Cancel</a>
					    </div>
					  </div>
					</form>
		 </div>
	</div>
</div>