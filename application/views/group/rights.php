<div class="container-fluid">
	<ol class="breadcrumb" style="margin-top:80px;">
		<li> <a href="<?php echo base_url("dashboard");?>" > Dashboard</a></li>
  		<li> <a href="<?php echo base_url("group");?>" > Group</a></li>
  		<li class="active"> Rights </li>
	</ol>
	<div class="row-fluid">
		 <div class="col-sm-3">
		 		<?php $this->load->view("components/left_side_bar");?>
		 </div>
		 <div class="col-sm-9">
		 		Permission Edit of Group : <?php echo $group_details[0]->title;?>
		 			 <!--   Success and Error Message --> 
                <?php if($this->session->flashdata('success_message')) {?>
                    <p class="bg-primary"> <?php echo $this->session->flashdata('success_message');?> </p>
                <?php } ?>
                <?php if($this->session->flashdata('error_message')) {?>
                    <p class="bg-danger"> <?php echo $this->session->flashdata('error_message');?> </p>
                <?php } ?>
                <!--   -->
                <?php
                echo form_open('');
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($values as $value){
                        ?>
                        <tr>
                            <td><input type="checkbox" name="<?php echo 'task_id[]'; ?>" value="<?php echo $value->id; ?>" <?php if(isset($value->group_id)) echo "checked='true'";?>></td>
                            <td> <?php echo $value->code ?></td>
                            <td><?php echo $value->title; ?></td>
                            <td><?php echo $value->description; ?></td>
                            <td><?php echo $value->is_active; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                <!-- <input type="submit" name="submit" value="save" class="form"> -->
                <?php echo form_close(); ?>
                <div class="box-footer clearfix">
              
                </div><!-- /.box-footer-->
		 </div>
	</div>
</div>