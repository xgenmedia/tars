<div class="list-group">
      <a href="<?php echo base_url("task");?>" class="list-group-item <?php echo $this->uri->segment(1)=='task'?'active':'none';?>">Resource</a>
      <a href="<?php echo base_url("group");?>" class="list-group-item <?php echo $this->uri->segment(1)=='group'?'active':'none';?>">Group</a>
      <a href="<?php echo base_url("formbuilder");?>" class="list-group-item <?php echo $this->uri->segment(1)=='formbuilder'?'active':'none';?>	">Form Manage</a>
      <a href="<?php echo base_url("formfield");?>" class="list-group-item <?php echo $this->uri->segment(1)=='formfield'?'active':'none';?>	">Form Field Manage</a>
	  <a href="#" class="list-group-item">Settings</a>
</div>