
<div class="container-fluid">
	<ol class="breadcrumb" style="margin-top:80px;">
		<li> <a href="<?php echo base_url("dashboard");?>" > Dashboard</a></li>
  		<li> <a href="<?php echo base_url("user");?>" > User</a></li>
  		<li class="active"> Rights </li>
	</ol>
	<div class="row-fluid">
		 <div class="col-sm-3">
		 		<?php $this->load->view("components/left_side_bar");?>
		 </div>
		 <div class="col-sm-9">
		 	 <!--   Success and Error Message --> 
                <?php if($this->session->flashdata('success_message')) {?>
                    <p class="bg-primary"> <?php echo $this->session->flashdata('success_message');?> </p>
                <?php } ?>
                <?php if($this->session->flashdata('error_message')) {?>
                    <p class="bg-danger"> <?php echo $this->session->flashdata('error_message');?> </p>
                <?php } ?>
             <!--                             -->

                <?php echo form_open('',array('class'=>'form-inline')); ?>
	                <table class="table table-condensed">
	                    <thead>
	                        <tr>
	                            <th width="6%">Sl. No.</th>
	                            <th>Code</th>
	                            <th>Title</th>
	                            <th width="40%">Description</th>
	                            <th width="5%">Active</th>
	                            <th width="10%">Assign</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                      <?php $i=1; ?>  
	                      <?php foreach($values as $value) { ?>
	                        <tr>
	                            <td><?php echo $i++; ?> </td>        
	                            <td> <?php echo $value->code ?></td>
	                            <td><?php echo $value->title; ?></td>
	                            <td><?php echo $value->description; ?></td>
	                            <td><?php echo $value->is_active; ?></td>
	                            <td>
	                                <select name="assign[]" class="form-control">
	                                    <option value="">choose</option>
	                                    <?php if(isset($value->group_id)){
	                                      ?>
	                                    <option value="inherited" selected>Inherited</option>
	                                    <?php
	                                    }
	                                    ?>
	                                    <option value="Y" <?php if(isset($value->user_id) && $value->user_rights_active == 'Y') echo "selected";?>>Yes</option>
	                                    <option value="N" <?php if(isset($value->user_id) && $value->user_rights_active == 'N') echo "selected";?>>No</option>
	                                </select>
	                                <input type="hidden" name="task_id[]" value="<?php echo $value->id; ?>">
	                            </td>
	                        </tr>
	                        <?php } ?>
	                    </tbody>
	                </table>
	                <div class="form-group">
	                    <div class="col-sm-offset-10 col-sm-7">
	                      <button type="submit" class="btn btn-default">Save</button>
	                    </div>
	                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="box-footer clearfix">
		 	</div>
	</div>
</div>